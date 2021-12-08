<x-layout>
    <x-section>
        <x-dashboard.admin-nav />

        <main>
            <div class="bg-blue-50 border border-gray-300 mt-6 mx-auto px-12 py-6 w-1/2">
                <h1 class="text-2xl font-semibold mb-3">Add Author</h1>
                <form
                    action="/admin/add-author"
                    method="post"
                >
                    @csrf
                    <x-form.input field="name" />
                    <div class="mb-4">
                        <label
                            class="block mb-2 font-bold text-xs text-gray-700"
                            for="username"
                        >USERNAME (if user exists)</label>
                        <input
                            class="border border-gray-400 p-2 w-full focus:outline-none text-xs"
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                        >
                    </div>
                    @error('username')
                        <p class="text-xs text-red-500 mb-1">{{ $message }}</p>
                    @enderror
                    <x-form.submit-button text='Add Author' />
                </form>
            </div>
        </main>
    </x-section>
</x-layout>
