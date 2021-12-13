<x-layout>
    <x-section>
        <x-dashboard.admin-nav />
        <main class="my-6">
            <x-dashboard.table>
                <x-slot name="headings">
                    <tr>
                        <th>Title</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Returned Date</th>
                        <th>Status</th>
                    </tr>
                </x-slot>
                <x-slot name="rows">
                    @if ($records->count() < 1)
                        <tr>
                            <td>
                                No records found.
                            </td>
                        </tr>
                    @else
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
                    @endif
                </x-slot>
            </x-dashboard.table>
        </main>
    </x-section>
</x-layout>
<x-dashboard.table-style />
