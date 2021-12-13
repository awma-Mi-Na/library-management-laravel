<x-layout>
    <x-section>
        <x-dashboard.admin-nav />
        <main>
            <x-dashboard.table>
                <x-slot name="headings">
                    <th>Title</th>
                    <th>Author</th>
                    <th>Borrowed by</th>
                    <th>Borrowed at</th>
                    <th>Due Date</th>
                </x-slot>
                <x-slot name="rows">
                    @foreach ($borrowings as $borrowing)
                        <tr>
                            <td>{{ $borrowing->borrows->title }}</td>
                            <td>{{ $borrowing->borrows->author->name }}</td>
                            <td>{{ $borrowing->borrower->name }}</td>
                            <td>{{ $borrowing->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $borrowing->due_date->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-dashboard.table>
        </main>
    </x-section>
</x-layout>
<x-dashboard.table-style />
