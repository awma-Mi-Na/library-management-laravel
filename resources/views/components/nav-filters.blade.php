@props(['field', 'items'])
<div class="col-span-1 space-y-1.5 text-center w-full">
    <label
        for="{{ $field }}"
        style="display: block"
    >Select {{ $field }}</label>
    <select
        name="{{ $field }}"
        id="{{ $field }}"
        onchange="location=this.value;"
        class="w-2/3 border border-gray-300 focus:border-gray-500 px-2 py-1 rounded-lg focus:outline-none transition duration-300"
    >
        <option value="/">All</option>
        {{ $slot }}
    </select>
</div>
