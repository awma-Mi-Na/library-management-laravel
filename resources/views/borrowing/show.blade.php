<x-layout>
    <x-section>
        <main class="space-y-1.5 text-lg">
            <a
                href="/borrowings"
                class="hover:text-blue-700 hover:underline text-blue-500 text-sm"
            >{{ '<- Go Back' }}</a>
            <p class="text-center">Current time: <span id="clock"></span></p>
            <h2 class="text-2xl font-bold">Title: {{ $borrowing->borrows->title }}</h2>
            <h4 class="italic text-md">Author: {{ $borrowing->borrows->author->name }} </h4>
            <p>Borrowed Date: {{ $borrowing->created_at->format('d/m/Y H:i:s') }} </p>
            <p>Due Date: {{ $borrowing->due_date->format('d/m/Y H:i:s') }} </p>
            <p>Dues: Rs. {{ App\Http\Controllers\FeeController::findLateFee($borrowing) }} </p>
            <div class="space-x-5">
                <button class="bg-blue-600 border border-blue-200 px-4 py-2 rounded-xl text-gray-200 text-sm">
                    Pay Dues</button>
                <button
                    class="bg-blue-600 borderborder-blue-200 px-4 py-2 rounded-xl text-gray-200 text-sm"
                    x-data="{}"
                    @click.prevent="document.querySelector('#deleteBorrowing').submit()"
                >
                    Return Book</button>
            </div>
        </main>
    </x-section>
</x-layout>

<script>
    document.addEventListener("DOMContentLoaded", function startClock() {
        const timeNow = new Date();
        document.getElementById('clock').innerHTML = timeNow.toLocaleString('en-GB');;
        setTimeout(() => {
            startClock();
        }, 1000);
    })
</script>

<form
    action="/borrowings/{{ $borrowing->id }}"
    method="post"
    class="hidden"
    id="deleteBorrowing"
>
    @csrf
    @method('DELETE')
</form>
