<x-layout>
    <x-section class="w-1/3">
        <div class="bg-gray-50 border p-6">
            <h1 class="font-bold mb-2 text-xl uppercase">Register</h1>
            <form
                action="/register"
                method="POST"
            >
                @csrf
                <x-form.input field="username" />
                <x-form.input field="name" />
                <x-form.input
                    field="email"
                    type="email"
                />
                <x-form.password-show />

                <x-form.submit-button text='Submit' />
            </form>
        </div>
    </x-section>

</x-layout>
