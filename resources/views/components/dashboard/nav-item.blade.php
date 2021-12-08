@props(['uri' => '', 'title' => ''])
<div
    class="{{ request()->is(substr($uri, 1)) ? 'text-green-500 border-b-2 border-green-500 border-t-2' : '' }} h-full flex items-center justify-center">

    <a href="{{ $uri }}">{{ $title }}</a>
</div>
