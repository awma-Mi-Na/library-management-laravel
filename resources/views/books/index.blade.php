<x-layout>
    <x-section>

        <div class="grid grid-cols-12">

            @foreach ($books as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
    </x-section>
</x-layout>
