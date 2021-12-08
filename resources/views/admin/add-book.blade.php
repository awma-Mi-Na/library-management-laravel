<x-layout>
    <x-section>
        <x-dashboard.admin-nav />

        <main>
            <div class="bg-blue-50 border border-gray-300 mt-6 mx-auto px-12 py-6 w-1/2">
                <h1 class="text-2xl font-semibold mb-3">Add Book</h1>
                <form
                    action="/admin/add-book"
                    method="post"
                >
                    @csrf
                    <x-form.input field="title" />
                    <label
                        class="block uppercase mb-2 font-bold text-xs text-gray-700 "
                        for="author_id"
                    >Author</label>
                    <select
                        name="author_id"
                        id="author_id"
                        class="border border-gray-400 focus:outline-none mb-4 px-2 py-1 w-full"
                    >
                        @foreach ($authors as $author)
                            <option
                                value="{{ $author->id }}"
                                {{ old('author_id') ? 'selected' : '' }}
                            >{{ $author->name }}</option>
                        @endforeach
                    </select>
                    <x-form.input field="isbn" />
                    <x-form.input field="slug" />
                    <x-form.input field="summary" />
                    <x-form.submit-button text='Add Book' />
                </form>
            </div>
        </main>
    </x-section>
</x-layout>
