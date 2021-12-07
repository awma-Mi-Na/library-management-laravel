<x-layout>
    <x-section>
        <x-dashboard.top-nav>
            <x-dashboard.nav-item
                title="Borrowings"
                uri="/borrowings"
            />
            <x-dashboard.nav-item
                title="History"
                uri='/borrowings-history'
            />
        </x-dashboard.top-nav>

        <main>
            <table class="text-left">
                <thead>
                    <tr>
                        <th>
                            Book Title
                        </th>
                        <th>
                            Author
                        </th>
                        <th>
                            Borrowed Date (DD/MM/YYYY hh:mm:ss)
                        </th>
                        <th>
                            Due Date<br /> (DD/MM/YYYY hh:mm:ss)
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <td>{{ $history->borrows->title }}</td>
                            <td>{{ $history->borrows->author->name }}</td>
                            <td>{{ $history->created_at->format('d/m/Y H:m:s') }}</td>
                            <td>{{ $history->due_date->format('d/m/Y H:m:s') }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </x-section>
</x-layout>
