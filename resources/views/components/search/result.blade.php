@props(['result', 'directToTasting' => false])

@switch($result['type'])
    @case('bottle')
        <x-search.bottle-result :result="$result" :direct-to-tasting="$directToTasting" />
        @break
    @case('entity')
        <x-search.entity-result :result="$result" />
        @break
    @case('user')
        <x-search.user-result :result="$result" />
        @break
@endswitch
