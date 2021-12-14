<x-layout>
    <x-section>

        <nav
            class="grid grid-cols-4 items-center justify-items-center text-sm"
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
            <x-nav-filters field='category'>
                @foreach ($categories as $category)

                    <option
                        value="?category={{ $category->title }}&{{ http_build_query(request()->except('category', 'page')) }}"
                        {{ request()->input(['category']) === $category->title ? 'selected' : '' }}
                    >
                        {{ $category->title }}
                    </option>
                @endforeach
            </x-nav-filters>
            <x-nav-filters field='author'>
                @foreach ($authors as $author)

                    <option
                        value="?author={{ $author->name }}&{{ http_build_query(request()->except('author', 'page')) }}"
                        {{ request()->input(['author']) === $author->name ? 'selected' : '' }}
                    >
                        {{ $author->name }}
                    </option>
                @endforeach
            </x-nav-filters>
            <x-sort-filter>
                @foreach ($sort_options as $sortBy)
                    <option
                        value="?sortBy={{ $sortBy }}&{{ http_build_query(request()->except('sortBy', 'page')) }}"
                        {{ request()->input(['sortBy']) === $sortBy ? 'selected' : '' }}
                    >
                        {{ ucwords($sortBy) }}
                    </option>
                @endforeach
            </x-sort-filter>
        </nav>

        @if ($books->count() > 0)
            <div class="grid grid-cols-12">
                @foreach ($books as $book)
                    <x-book-card
                        :book="$book"
                        :categories="App\Http\Controllers\BookController::findCategories($book)"
                    />
                @endforeach
            </div>
        @else
            <p>No books found</p>
        @endif
        {{ $books->appends(request()->all())->links() }}
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
