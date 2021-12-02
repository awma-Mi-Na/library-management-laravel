@props(['text'])
<button
    type="submit"
    class="bg-gray-400 px-4 py-2 rounded-md text-sm"
>{{ ucwords($text) }}</button>
