<?php

namespace App\Livewire;

use App\Models\Bottle;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchPanel extends Component
{
    public string $query = '';
    public bool $loading = false;
    public bool $directToTasting = false;
    public Collection $results;

    public function mount($initialValue = '')
    {
        $this->query = $initialValue;
        $this->results = collect([]);
        $this->search();
    }

    public function updatedQuery()
    {
        $this->loading = true;
        $this->search();
        $this->loading = false;
    }

    protected function search()
    {
        if (empty($this->query)) {
            $this->results = collect([]);
            return;
        }

        $isUserQuery = str_contains($this->query, '@') && auth()->check();
        $results = collect();

        // Search bottles if direct to tasting or not a user query
        if ($this->directToTasting || !$isUserQuery) {
            $bottles = Bottle::search($this->query)
                ->with(['distillers'])
                ->take(50)
                ->get()
                ->map(fn($bottle) => [
                    'type' => 'bottle',
                    'ref' => $bottle
                ]);
            $results = $results->concat($bottles);
        }

        // Search users if authenticated and (is user query or has query)
        if (!$this->directToTasting && auth()->check() && ($isUserQuery || $this->query)) {
            $users = User::search($this->query)
                ->take(50)
                ->get()
                ->map(fn($user) => [
                    'type' => 'user',
                    'ref' => $user
                ]);
            $results = $results->concat($users);
        }

        // Search entities if not direct to tasting
        if (!$this->directToTasting) {
            $entities = Entity::search($this->query)
                ->take(50)
                ->get()
                ->map(fn($entity) => [
                    'type' => 'entity',
                    'ref' => $entity
                ]);
            $results = $results->concat($entities);
        }

        $this->results = $results;
    }

    public function render()
    {
        return view('livewire.search-panel');
    }
}
