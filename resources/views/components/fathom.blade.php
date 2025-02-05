@props(['siteId', 'includedDomains'])

@once
    @push('scripts')
        <script src="https://cdn.usefathom.com/script.js" data-site="{{ $siteId }}" data-included-domains="{{ implode(',', $includedDomains) }}" defer></script>
    @endpush
@endonce
