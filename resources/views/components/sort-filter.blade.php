{{-- @props(['items']) --}}
<div class="col-span-1 space-y-1.5 text-center w-full">
    <label
        for="sortBy"
        style="display: block"
    >Sort by</label>
    <select
        name="sortBy"
        id="sortBy"
        onchange="location=this.value;"
        class="w-2/3 border border-gray-300 focus:border-gray-500 px-2 py-1 rounded-lg focus:outline-none transition duration-300"
    >
        <option
            value="/?{{ http_build_query(request()->except(['sortBy', 'page'])) }}"
            {{ request()->is(http_build_query(request()->except(['sortby', 'page']))) ? 'selected' : '' }}
        >All</option>
        {{ $slot }}
    </select>
</div>
