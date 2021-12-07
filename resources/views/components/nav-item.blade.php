@props(['title', 'uri'])
<a
    href="{{ $uri }}"
    class="border duration-100 ease-in hover:bg-green-500 px-4 py-2 rounded-md transition"
>{{ $title }}</a>
