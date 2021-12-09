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

            @auth
                @if (!$isBorrowed and $isCopyAvailable)

                    <form
                        action="/borrowings"
                        method="post"
                    >
                        @csrf
                        <x-form.hidden-input
                            field="user_id"
                            value="{{ auth()->user()->id }}"
                        />
                        <x-form.hidden-input
                            field="book_id"
                            value="{{ $book->id }}"
                        />
                        <x-form.submit-button text="Borrow Book" />
                    </form>
                @elseif ($isBorrowed)
                    <div>
                        <span class="bg-blue-600 px-4 py-2 rounded-md text-gray-100 text-sm cursor-default">
                            Book has been borrowed</span>
                    </div>

                @else
                    <div>
                        <span class="bg-blue-600 px-4 py-2 rounded-md text-gray-100 text-sm cursor-default">
                            No copy available</span>
                    </div>
                @endif
            @else
                <p><a
                        href="/register"
                        class="hover:text-blue-400 hover:underline text-blue-600"
                    >Register</a> or <a
                        href="/login"
                        class="hover:text-blue-400 hover:underline text-blue-600"
                    >Log in</a> to borrow this book.</p>
            @endauth
        </div>
    </x-section>
</x-layout>
