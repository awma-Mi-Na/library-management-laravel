<x-layout>
    <x-section>

        <div class="grid grid-cols-12">

            @foreach ($books as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
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
