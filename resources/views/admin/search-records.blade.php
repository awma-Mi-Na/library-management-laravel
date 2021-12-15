<x-layout>
    <x-section>
        <x-dashboard.admin-nav />
        <main>
            <div class="bg-blue-50 border border-gray-300 mt-6 mx-auto px-12 py-6 w-1/2">
                <h1 class="text-2xl font-semibold mb-3">Search Records</h1>
                <form
                    action="/admin/search-results"
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
                        title="borrowed date [dd/mm/yyyy]"
                    />
                    <x-form.submit-button text="Search" />
                </form>
            </div>

    </x-section>
</x-layout>

<x-dashboard.table-style />
