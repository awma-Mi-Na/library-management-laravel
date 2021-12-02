<x-layout>
    <div class="grid grid-cols-12">

        @foreach ($books as $book)
            <x-book-card :book="$book" />
        @endforeach
    </div>
</x-layout>
