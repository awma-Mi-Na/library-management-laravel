<x-layout>
    <x-section>

        <main>
            <p>
                <x-goback />
            </p>
            <div class="bg-blue-50 border border-gray-300 mt-6 mx-auto px-12 py-6 w-1/2">
                <h1 class="text-2xl font-semibold mb-3">Edit Book</h1>
                <form
                    action="/admin/edit-book/{{ $book->id }}"
                    method="post"
                >
                    @csrf
                    @method('PATCH')
                    <x-form.input
                        field="title"
                        value="{{ $book->title }}"
                    />
                    <label
                        class="block uppercase mb-2 font-bold text-xs text-gray-700 "
                        for="author_id"
                    >Author</label>
                    <select
                        name="author_id"
                        id="author_id"
                        class="border border-gray-400 focus:outline-none mb-4 p-2 w-full text-xs"
                    >
                        @foreach ($authors as $author)
                            <option
                                value="{{ $author->id }}"
                                {{ $author->id === $book->author_id ? 'selected' : '' }}
                            >{{ $author->name }}</option>
                        @endforeach
                    </select>
                    <x-form.input
                        field="isbn"
                        value="{{ $book->isbn }}"
                    />
                    <x-form.input
                        field="slug"
                        value="{{ $book->slug }}"
                    />
                    <x-form.textarea-input
                        field="summary"
                        text="{{ $book->summary }}"
                    />
                    <x-form.input
                        field="copies"
                        value="{{ $book->copies }}"
                    />
                    <x-form.submit-button text='Add Book' />
                </form>
            </div>
        </main>
    </x-section>
</x-layout>
