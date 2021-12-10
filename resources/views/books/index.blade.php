<x-layout>
    <x-section>

        <nav
            class="grid grid-cols-5 items-center justify-items-center text-sm"
            style="height: 5em"
        >
            {{-- <div
                class="col-span-1 border-b border-gray-400 pb-2 relative"
                x-data="{ show: false }"
                @click.away="show = false"
            >
                <button @click="show = !show">
                    Select Categories
                </button>
                <div
                    x-show="show"
                    class="absolute bg-white z-50"
                >
                    @foreach ($categories as $category)
                        <a
                            style="min-width: 50px"
                            href="?category={{ $category->title }}&{{ http_build_query(request()->except('category', 'page')) }}"
                            class="block w-full"
                        >{{ $category->title }}</a>
                    @endforeach
                </div>
            </div> --}}
            <div class="col-span-1 space-y-1.5 text-center w-full">
                <label
                    for="category"
                    style="display: block"
                >Select category</label>
                <select
                    name="category"
                    id="category"
                    onchange="location=this.value;"
                    class="border border-gray-300 focus:border-gray-500 px-2 py-1 rounded-lg focus:outline-none"
                >
                    @foreach ($categories as $category)

                        <option
                            value="?category={{ $category->title }}&{{ http_build_query(request()->except('category', 'page')) }}"
                        >
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </nav>

        @if ($books->count() > 0)
            <div class="grid grid-cols-12">
                @foreach ($books as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
        @else
            <p>No books found</p>
        @endif
        {{ $books->links() }}
    </x-section>
</x-layout>

<style>
    .line-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

</style>
