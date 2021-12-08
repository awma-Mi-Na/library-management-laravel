<x-layout>
    <x-section>
        <x-dashboard.admin-nav />
        <main>
            <table class="bg-gray-100 border-2 border-gray-200 text-left w-full my-6">
                <thead>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Borrowed by</th>
                    <th>Borrowed at</th>
                    <th>Due Date</th>
                </thead>
                <tbody>
                    @foreach ($borrowings as $borrowing)
                        <tr>
                            <td class="border-gra">{{ $borrowing->borrows->title }}</td>
                            <td>{{ $borrowing->borrows->author->name }}</td>
                            <td>{{ $borrowing->borrower->name }}</td>
                            <td>{{ $borrowing->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $borrowing->due_date->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </x-section>
</x-layout>
<x-dashboard.table-style />
