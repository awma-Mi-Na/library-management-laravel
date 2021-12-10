@props(['field', 'type' => 'text', 'text'])

<div class="mb-4">
    <label
        class="block uppercase mb-2 font-bold text-xs text-gray-700 "
        for="{{ $field }}"
    >{{ $field }}</label>
    <textarea
        class="border border-gray-400 p-2 w-full focus:outline-none text-xs"
        rows="6"
        type="{{ $type }}"
        name="{{ $field }}"
        id="{{ $field }}"
    >{{ $text }}
</textarea>
</div>
@error($field)
    <p class="text-xs text-red-500 mb-2 -mt-2">{{ $message }}</p>
@enderror
