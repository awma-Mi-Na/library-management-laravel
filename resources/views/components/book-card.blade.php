@props(['book', 'categories'])

<div class="bg-gray-100 col-span-4 mx-2 my-3 p-4 rounded-md hover:shadow-2xl transition duration-300 ease-in  relative">
    <a href="/books/{{ $book->slug }}">
        <p class="font-semibold mb-2 text-lg">{{ $book->title }}</p>
    </a>
    <a href="?author={{ $book->author->name }}&{{ http_build_query(request()->except('page', 'author')) }}">
        <span class="bg-green-300 px-2 py-1 rounded-full text-sm"> {{ $book->author->name }} </span>
    </a>
    <div class="mt-1">
        @foreach ($categories as $category)
            <a
                href="?category={{ $category }}&{{ http_build_query(request()->except('page', 'category')) }}"
                class="text-blue-500 hover:underline hover:text-blue-700 text-sm uppercase"
            >{{ $category . ' ' }}</a>
        @endforeach
    </div>
    <p class="line-clamp mt-4 mb-12">
        {{ $book->summary }}
    </p>
    <div class="absolute bottom-4">
        <span class="bg-green-300 px-2 py-1 rounded-xl text-sm">Available copies:
            {{ App\Http\Controllers\AvailableCopiesController::findCopies($book) }}</span>
    </div>
</div>
