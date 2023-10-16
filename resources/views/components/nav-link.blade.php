@props(['active'])

<li>
    <a {{ $attributes->merge(['class' => ($active ?? false) ? 'active' : null]) }}>
        {{ $slot }}
    </a>

</li>
