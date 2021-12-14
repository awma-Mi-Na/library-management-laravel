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
                        class="border border-gray-400 focus:outline-none mb-4 p-2 w-full text-xs"
                    >
                        @foreach ($authors as $author)
                            <option
                                value="{{ $author->id }}"
                                {{ old('author_id') === "$author->id" ? 'selected' : '' }}
                            >{{ $author->name }}</option>
                        @endforeach
                        <option
                            value="34"
                            {{ old('author_id') === '34' ? 'selected' : '' }}
                        >John Doe</option>
                    </select>
                    @error('author_id')
                        <p class="text-xs text-red-500 mb-2 -mt-2">{{ $message }}</p>
                    @enderror
                    <x-form.input field="isbn" />
                    <x-form.input field="slug" />
                    <x-form.textarea-input field="summary" />
                    <x-form.checkbox-input title='category[]'>
                        @foreach ($categories as $category)

                            <label for="{{ $category->id }}"><input
                                    type="checkbox"
                                    name="category[]"
                                    id="{{ $category->id }}"
                                    value="{{ $category->id }}"
                                > {{ ucwords($category->title) }}</label>
                        @endforeach
                        <label for="55"><input
                                type="checkbox"
                                name="category[]"
                                id="55"
                                value="55"
                            > Mai</label>

                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        @error('category.*')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </x-form.checkbox-input>
                    <x-form.input field="copies" />
                    <x-form.submit-button text='Add Book' />

                </form>
            </div>
        </main>
    </x-section>
</x-layout>
{{-- @php
dump($errors);
@endphp --}}
