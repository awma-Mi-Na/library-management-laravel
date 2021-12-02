<x-layout>
    <x-section>
        <div class="space-y-2.5">

            <h1 class="font-semibold italic text-3xl">
                {{ $book->title }}
            </h1>
            <span class="text-sm italic">
                - {{ $book->author->name }}
            </span>

            <p>
                {{ $book->summary }}
            </p>
        </div>
    </x-section>
</x-layout>
