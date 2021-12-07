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
                                @php
                                    $now = now()->addDays(52);
                                    $late_days = $borrowing->due_date->diffInDays($now);
                                    $late_fees = 0;
                                    if ($late_days > 0) {
                                        if ($late_days <= 10) {
                                            $late_fees += 2 * $late_days;
                                        }
                                        if ($late_days > 10 and $late_days <= 20) {
                                            $late_days -= 10;
                                            $late_fees += 5 * $late_days + 20;
                                        }
                                        if ($late_days > 20) {
                                            $late_days -= 20;
                                            $late_fees += 10 * $late_days + 70;
                                        }
                                    }
                                @endphp
                                {{ $late_fees }}
                                <br />
                                <a
                                    href="/borrowings/{{ $borrowing->id }}"
                                    class="hover:text-red-700 text-red-500 text-xs"
                                >Show Details</a>
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
