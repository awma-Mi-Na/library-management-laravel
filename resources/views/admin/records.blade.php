<x-layout>
    <x-section>
        <x-dashboard.admin-nav />
        <main class="my-6">
            <table class="bg-gray-100 border-2 border-gray-200 text-left w-full my-6">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Returned Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->borrows->title }}</td>
                            <td>{{ $record->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $record->due_date->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $record->returned_date ? $record->returned_date->format('d/m/Y H:i:s') : '---' }}
                            </td>
                            <td class="{{ $record->status == 0 ? 'text-red-500' : 'text-blue-500' }} text-xs">
                                {{ $record->status == 0 ? 'Borrowing' : 'Returned' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </x-section>
</x-layout>
<x-dashboard.table-style />
