{{-- {{ dd($results) }} --}}
<x-layout>
    <x-section>
        <div class="my-6">
            <x-goback />
            <h1 class="text-xl font-semibold mb-4">Search results:</h1>
            <x-dashboard.table>
                <x-slot name="headings">
                    <tr>
                        <th>Title</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Returned Date</th>
                        <th>Borrowed By</th>
                        <th>Status</th>
                    </tr>
                </x-slot>
                @if ($results->count() < 1)
                    <x-slot name='rows'>
                        <tr>
                            <td>No records found</td>
                        </tr>
                    </x-slot>
                @else
                    <x-slot name='rows'>
                        @foreach ($results as $record)

                            <tr>
                                <td>{{ $record->borrows->title }}</td>
                                <td>{{ $record->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $record->due_date->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $record->returned_date ? $record->returned_date->format('d/m/Y H:i:s') : '---' }}
                                </td>
                                <td>{{ $record->borrower->name }}</td>
                                <td class="{{ $record->status == 0 ? 'text-red-500' : 'text-blue-500' }} text-xs">
                                    {{ $record->status == 0 ? 'Borrowing' : 'Returned' }}</td>
                            </tr>
                        @endforeach
                    </x-slot>
                @endif
            </x-dashboard.table>
            {{ $results->links() }}
        </div>

    </x-section>
</x-layout>

<x-dashboard.table-style />
