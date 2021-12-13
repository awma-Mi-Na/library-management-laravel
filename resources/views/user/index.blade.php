<x-layout>
    <x-section>
        <x-dashboard.user-nav />

        <main>
            <x-dashboard.table>
                <x-slot name='headings'>
                    <tr>
                        <th>
                            Book Title
                        </th>
                        <th>
                            Author
                        </th>
                        <th>
                            Borrowed Date <br /> (DD/MM/YYYY hh:mm:ss)
                        </th>
                        <th>
                            Due Date<br /> (DD/MM/YYYY hh:mm:ss)
                        </th>
                        <th>
                            Late Fee (Rs.)
                        </th>
                    </tr>
                </x-slot>
                <x-slot name='rows'>
                    @if ($borrowings->count() > 0)
                        @foreach ($borrowings as $borrowing)
                            <tr>
                                <td><a
                                        href="/books/{{ $borrowing->borrows->slug }}">{{ $borrowing->borrows->title }}</a>
                                </td>
                                <td>{{ $borrowing->borrows->author->name }}</td>
                                <td>{{ $borrowing->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $borrowing->due_date->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    {{ App\Http\Controllers\FeeController::findLateFee($borrowing) }}
                                    <br />
                                    <a
                                        href="/borrowings/{{ $borrowing->id }}"
                                        class="hover:text-red-700 text-red-500 text-xs"
                                    >Pay/Return Book</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>No books borrowed.</td>
                        </tr>
                    @endif
                </x-slot>
            </x-dashboard.table>
        </main>
    </x-section>
</x-layout>

<x-dashboard.table-style />
