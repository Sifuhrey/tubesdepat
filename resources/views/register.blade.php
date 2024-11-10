<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Sign Up</title>
</head>
<body class="font-poppins bg-gray-100">
     <!-- Include untuk logo header -->
    <main class="flex flex-col items-center justify-center py-16">
        <h1 class="text-4xl font-medium mb-8">Sign Up</h1>
        <form action="{{ route('store') }}" method="POST" id="signupform" class="flex flex-col items-center gap-6">
            @csrf
            <div class="w-96 relative">
                <input type="email" name="email" placeholder="Email (example: email@oryva.com)" required
                    class="w-full h-14 bg-yellow-50 rounded-md px-6 shadow-md border-none focus:outline-none focus:ring-2 focus:ring-yellow-300">
            </div>
            <div class="w-96 relative">
                <input type="text" name="username" maxlength="25" placeholder="Nama Lengkap"
                    class="w-full h-14 bg-yellow-50 rounded-md px-6 shadow-md border-none focus:outline-none focus:ring-2 focus:ring-yellow-300">
            </div>
            <div class="w-96 relative">
                <input type="password" name="password" id="password" placeholder="Password (minimal 8 karakter)" minlength="8" required
                    class="w-full h-14 bg-yellow-50 rounded-md px-6 shadow-md border-none focus:outline-none focus:ring-2 focus:ring-yellow-300">
                <img src="{{ asset('assets/invisible.png') }}" alt="" id="passicon" class="absolute right-4 top-4 cursor-pointer">
                <input type="checkbox" id="triggerpass" class="hidden">
            </div>
            <div class="w-96 relative">
                <input type="password" id="confirmPassword" placeholder="Konfirmasi Password" required
                    class="w-full h-14 bg-yellow-50 rounded-md px-6 shadow-md border-none focus:outline-none focus:ring-2 focus:ring-yellow-300">
                <img src="{{ asset('assets/invisible.png') }}" alt="" id="confirmicon" class="absolute right-4 top-4 cursor-pointer">
                <input type="checkbox" id="triggerconfirm" class="hidden">
                <img src="{{ asset('assets/exclamation.png') }}" alt="" id="exclamation" class="absolute right-12 top-4 hidden">
            </div>
            <button type="submit" class="w-80 h-14 bg-yellow-600 hover:bg-yellow-700 text-white rounded-md shadow-lg transform hover:scale-105 transition duration-300">
                Register
            </button>
        </form>
        <p class="text-center text-sm mt-4">
            Sudah Punya Akun? <a href="{{ route('product.index') }}" class="text-yellow-600 hover:text-yellow-800">Login Here!</a>
        </p>
    </main>

    <script>
        document.getElementById('signupform').addEventListener("submit", function(event) {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const mismatchIcon = document.getElementById('exclamation');

            if (passwordInput.value !== confirmPasswordInput.value) {
                alert("Error: Passwords do not match.");
                event.preventDefault(); // Prevent form submission
                mismatchIcon.style.display = 'inline';
            }
        });

        document.getElementById('triggerpass').addEventListener('change', function() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('passicon');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.src = "{{ asset('assets/show.png') }}";
            } else {
                passwordInput.type = "password";
                icon.src = "{{ asset('assets/invisible.png') }}";
            }
        });

        document.getElementById('triggerconfirm').addEventListener('change', function() {
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const icon = document.getElementById('confirmicon');
            if (confirmPasswordInput.type === "password") {
                confirmPasswordInput.type = "text";
                icon.src = "{{ asset('assets/show.png') }}";
            } else {
                confirmPasswordInput.type = "password";
                icon.src = "{{ asset('assets/invisible.png') }}";
            }
        });
    </script>
</body>
</html>
