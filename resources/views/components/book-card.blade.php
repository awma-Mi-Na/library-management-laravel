@props(['book'])

<div class="bg-gray-100 col-span-4 mx-2 my-3 p-4 rounded-md hover:shadow-2xl transition duration-300 ease-in space-y-4 ">
    <a href="/books/{{ $book->slug }}">
        <p class="font-semibold mb-2 text-lg">{{ $book->title }}</p>
    </a>
    <a href="?author={{ $book->author->username }}&{{ http_build_query(request()->except('page', 'author')) }}">
        <span class="bg-green-300 px-2 py-1 rounded-full text-sm"> {{ $book->author->name }} </span>
    </a>
    <p class="line-clamp-5">
        {{ $book->summary }}
    </p>
</div>
