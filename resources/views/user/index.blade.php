<x-layout>
    <x-section>
        <x-dashboard.user-nav />

        <main>
            <table class="bg-gray-100 border-2 border-gray-200 text-left w-full my-6">
                <thead>
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
                </thead>
                <tbody>
                    @if ($borrowings->count() > 0)
                        @foreach ($borrowings as $borrowing)
                            <tr>
                                <td>{{ $borrowing->borrows->title }}</td>
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
                </tbody>
            </table>
        </main>
    </x-section>
</x-layout>

<x-dashboard.table-style />
