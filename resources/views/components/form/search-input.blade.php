@props(['field', 'type' => 'text', 'title'])

<div class="mb-4">
    <label
        class="block uppercase mb-2 font-bold text-xs text-gray-700 "
        for="{{ $field }}"
    >{{ $title }}</label>
    <input
        class="border border-gray-400 p-2 w-full focus:outline-none text-xs"
        type="{{ $type }}"
        name="{{ $field }}"
        id="{{ $field }}"
        value="{{ old($field) }}"
    >
</div>
@error($field)
    <p class="text-xs text-red-500 mb-2 -mt-2">{{ $message }}</p>
@enderror
