@props(['uri' => '', 'title' => ''])
<a
    href="{{ $uri }}"
    class="{{ request()->is(substr($uri, 1)) ? 'text-green-500' : '' }}"
>{{ $title }}</a>
