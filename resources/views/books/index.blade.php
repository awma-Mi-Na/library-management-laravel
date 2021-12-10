<x-layout>
    <x-section>


        @if ($books->count() > 0)
            <div class="grid grid-cols-12">
                @foreach ($books as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
        @else
            <p>No books found</p>
        @endif
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
