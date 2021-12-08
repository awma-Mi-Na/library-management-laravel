<x-layout>
    <x-section>
        <x-dashboard.user-nav />

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
                    @foreach ($histories as $history)
                        <tr>
                            <td>{{ $history->borrows->title }}</td>
                            <td>{{ $history->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $history->due_date->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $history->returned_date ? $history->returned_date->format('d/m/Y H:i:s') : '---' }}
                            </td>
                            <td class="{{ $history->status == 0 ? 'text-red-500' : 'text-blue-500' }} text-xs">
                                {{ $history->status == 0 ? 'Borrowing' : 'Returned' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </x-section>
</x-layout>
<x-dashboard.table-style />
