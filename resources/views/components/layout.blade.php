<!DOCTYPE html>
<html lang="en">

<head>
    <title>Library</title>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    />
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >
    <script
        src="//unpkg.com/alpinejs"
        defer
    ></script>
    <script
        src="https://kit.fontawesome.com/3e5ca32977.js"
        crossorigin="anonymous"
    ></script>
</head>

<body>
    <div class="w-full lg:h-28 bg-gray-600">
        <header class="max-w-6xl mx-auto pt-8 text-white">
            <div class="grid grid-cols-10 items-center">
                <a
                    href="/"
                    class="col-span-2 justify-self-center text-xl"
                >
                    <h1 class="text-2xl uppercase tracking-wider">Library</h1>
                </a>

                <form
                    action="/"
                    method="GET"
                    class="bg-white col-span-4 rounded-md"
                >

                    <i class="border-r-2 fa-search fas h-full pl-2.5 py-1 text-black w-1/12"></i>
                    <input
                        type="hidden"
                        name="author"
                        value="{{ request('author') }}"
                    >
                    <input
                        type="hidden"
                        name="category"
                        value="{{ request('category') }}"
                    >
                    <input
                        type="search"
                        name="search"
                        id="search"
                        class="focus:outline-none px-2 py-1 text-black text-sm w-10/12"
                        placeholder="Search for books,authors..."
                        value="{{ request('search') }}"
                    >

                </form>

                <div class="col-span-2 col-start-9 flex gap-4 items-center justify-around text-sm">
                    @guest
                        <x-nav-item
                            title='Register'
                            uri='/register'
                        />
                        <x-nav-item
                            title='Login'
                            uri='/login'
                        />

                    @endguest
                    @auth
                        @admin
                        <x-nav-item
                            title='Admin'
                            uri='/admin/books'
                        />
                    @else
                        <x-nav-item
                            title='{{ auth()->user()->name }}'
                            uri='/borrowings'
                        />
                        @endadmin
                        <form
                            action="/logout"
                            method="POST"
                            class="border duration-100 ease-in hover:bg-green-500 rounded-md transition"
                        >
                            @csrf
                            <button
                                type="submit"
                                class="px-4 py-2"
                            >Logout</button>
                        </form>
                    @endauth
                </div>
                </d>
        </header>
    </div>
    {{ $slot }}

    @if (session()->has('success'))
        <div
            x-data="{show:true}"
            x-init="setTimeout(()=>show=false,4000)"
            x-show="show"
            class="bg-yellow-200 bottom-0 fixed m-4 px-4 py-2 right-0 rounded-lg text-gray-600 text-sm shadow-md"
        >
            <p> {{ session('success') }} </p>
        </div>
    @endif
    <footer class="h-60 bg-gray-600 mt-6">
    </footer>
</body>
{{-- <style>
    .aaa {
        margin=left: -15px
    }

</style> --}}
