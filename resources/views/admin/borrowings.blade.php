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
                            <td>{{ $borrowing->created_at->format('d/m/Y H:m:s') }}</td>
                            <td>{{ $borrowing->due_date->format('d/m/Y H:m:s') }}</td>
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
        border-bottom: 1px solid rgb(209, 213, 219);
        /* border-bottom-color: rgba(229, 231, 235, var(--tw-border-opacity)); */
    }

</style>
