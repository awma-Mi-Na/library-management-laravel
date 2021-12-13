<x-layout>
    <x-section>
        <x-dashboard.admin-nav />
        <main>
            <div class="bg-blue-50 border border-gray-300 mt-6 mx-auto px-12 py-6 w-1/2">
                <h1 class="text-2xl font-semibold mb-3">Search Records</h1>
                <form
                    action="/admin/search-records"
                    method="post"
                >
                    @csrf
                    <x-form.search-input
                        field='title'
                        title="book title"
                    />
                    <x-form.search-input
                        field="name"
                        title="borrower's name"
                    />
                    <x-form.search-input
                        field="borrowed_date"
                        title="borrowed date [yyyy-mm-dd]"
                    />
                    <x-form.submit-button text="Search" />
                </form>
            </div>

            @if (isset($results))
                <div class="my-6">
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
                            @foreach ($results as $record)
                                <x-slot name='rows'>

                                    <tr>
                                        <td>{{ $record->borrows->title }}</td>
                                        <td>{{ $record->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $record->due_date->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $record->returned_date ? $record->returned_date->format('d/m/Y H:i:s') : '---' }}
                                        </td>
                                        <td>{{ $record->borrower->name }}</td>
                                        <td
                                            class="{{ $record->status == 0 ? 'text-red-500' : 'text-blue-500' }} text-xs">
                                            {{ $record->status == 0 ? 'Borrowing' : 'Returned' }}</td>
                                    </tr>
                                </x-slot>
                            @endforeach
                        @endif
                    </x-dashboard.table>
                </div>
            @else
                <p class="my-6 text-xl font-semibold">No results found.</p>
            @endif
        </main>
    </x-section>
</x-layout>

<x-dashboard.table-style />
