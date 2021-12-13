<x-layout>
    <x-section>

        <x-dashboard.admin-nav />

        <main>
            <x-dashboard.table>
                <x-slot name='headings'>
                    <th>S.no</th>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>No. Copies</th>
                    <th>No. Borrowed Copies</th>
                </x-slot>
                <x-slot name='rows'>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration + ((request()->input('page') ?? 1) - 1) * 20 }}.</td>
                            <td><a href="/books/{{ $book->slug }}">{{ $book->title }}</a></td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>{{ $book->copies }}</td>
                            <td>{{ App\Http\Controllers\AvailableCopiesController::borrowedCopies($book) }}</td>
                            <td><a
                                    href="/admin/edit-book/{{ $book->id }}"
                                    class="text-xs text-blue-500 hover:text-blue-700"
                                >Edit</a></td>
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
                </x-slot>
            </x-dashboard.table>
            {{ $books->links() }}
        </main>

    </x-section>
</x-layout>

<x-dashboard.table-style />
