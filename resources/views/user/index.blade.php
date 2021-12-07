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
                    @foreach ($borrowings as $borrowing)
                        <tr>
                            <td>{{ $borrowing->borrows->title }}</td>
                            <td>{{ $borrowing->borrows->author->name }}</td>
                            <td>{{ $borrowing->created_at->format('d/m/Y H:m:s') }}</td>
                            <td>{{ $borrowing->due_date->format('d/m/Y H:m:s') }}</td>
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
                </tbody>
            </table>
        </main>
    </x-section>
</x-layout>

<style>
    td,
    th {
        border: 1px solid black;
        padding: 10px;
    }

</style>
