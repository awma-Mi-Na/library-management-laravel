<x-layout>
    <x-section>

        <x-dashboard.admin-nav />

        <main>
            <table class="bg-gray-100 border-2 border-gray-200 text-left w-full my-6">
                <thead>
                    <th>Title</th>
                    <th>Author</th>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>
                                <form
                                    action="/admin/books/{{ $book->id }}"
                                    method="post"
                                    x-data="{conf:false}"
                                    @submit.prevent="if(conf==false)return; $el.submit()"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <input
                                        type="hidden"
                                        name="book_id"
                                        value="{{ $book->id }}"
                                    >
                                    <button
                                        type="submit"
                                        class="text-xs text-red-500 hover:text-red-700"
                                        @click="conf = confirm('Are you sure you want to delete: {{ $book->title }}?');"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>

    </x-section>
</x-layout>

<style>
    th,
    td {
        padding: 10px;
    }

</style>
