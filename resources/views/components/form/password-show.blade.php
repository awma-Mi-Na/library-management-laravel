<div class="mb-4">
    <label
        class="block uppercase mb-2 font-bold text-xs text-gray-700"
        for="password"
    >Password</label>
    <input
        class="border border-gray-400 p-2 w-full focus:outline-none text-xs"
        type="password"
        name="password"
        id="password"
    >
    <i
        class="text-xs font-light"
        style="margin-left: -60px; cursor: pointer;"
        id="togglePassword"
    >Show</i>
</div>
<script>
    const password = document.getElementById('password');
    const togglePassword = document.querySelector('#togglePassword');

    togglePassword.addEventListener('click', function(e) {
        const type = password.getAttribute('type') == 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        if (togglePassword.innerHTML === "Show")
            togglePassword.innerHTML = "Hide";
        else
            togglePassword.innerHTML = "Show";
    });
</script>
@error('password')
    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
@enderror
