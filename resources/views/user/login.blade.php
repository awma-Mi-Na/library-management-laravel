<x-layout>
    <x-section class="w-1/2">
        <div class="bg-gray-50 border p-6">
            <h1 class="font-bold mb-2 text-xl uppercase">Login</h1>
            <form
                action="login"
                method="POST"
            >
                @csrf
                <x-form.input field='email' />
                <x-form.password-show />
                <x-form.submit-button text="Login" />
            </form>
        </div>
    </x-section>
</x-layout>
