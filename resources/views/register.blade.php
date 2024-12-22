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
     
    <main class="flex flex-col items-center justify-center py-16">
        <h1 class="text-4xl font-medium mb-8">Sign Up</h1>
        <form action="{{ route('user.store') }}" method="POST" id="signupform" class="flex flex-col items-center gap-6">
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
                <img src="{{ asset('storage/assets/invisible.png') }}" alt="" id="passicon" class="absolute right-4 w-4 top-4 cursor-pointer">
                <input type="checkbox" id="triggerpass" class="hidden">
            </div>
            <div class="w-96 relative">
                <input type="password" id="password_confirmation" placeholder="Konfirmasi Password" required
                    class="w-full h-14 bg-yellow-50 rounded-md px-6 shadow-md border-none focus:outline-none focus:ring-2 focus:ring-yellow-300">
                <img src="{{ asset('storage/assets/invisible.png') }}" alt="" id="confirmicon" class="absolute right-4 w-4 top-4 cursor-pointer">
                <input type="checkbox" id="triggerconfirm" class="hidden">
                <img src="{{ asset('storage/assets/exclamation.png') }}" alt="" id="exclamation" class="absolute right-12 top-4 hidden">
            </div>
            <button type="submit" class="w-80 h-14 bg-yellow-600 hover:bg-yellow-700 text-white rounded-md shadow-lg transform hover:scale-105 transition duration-300">
                Register
            </button>
        </form>
        <p class="text-center text-sm mt-4">
            Sudah Punya Akun? <a href="{{ route('login') }}" class="text-yellow-600 hover:text-yellow-800">Login Here!</a>
        </p>
    </main>

    <!-- <script src="{{ url('js/signup.js') }}"></script> -->
    <script>const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('password_confirmation');
const mismatchIcon = document.getElementById('exclamation')
const showConfirm = document.getElementById('triggerconfirm')
const showPass = document.getElementById('triggerpass')


confirmPasswordInput.addEventListener('input', function(){
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if(password !== confirmPassword){
        mismatchIcon.style.display = 'inline';
    }else{
        mismatchIcon.style.display = 'none';
    }
})

showPass.addEventListener('change', function(){
    const imagePass = document.getElementById('passicon')

    if(passwordInput.type === "password"){
        passwordInput.type = "text"
        imagePass.src = "storage/assets/show.png"
    }else{
        passwordInput.type = "password"
        imagePass.src = "storage/assets/invisible.png"
    }

})
showConfirm.addEventListener('change', function(){
    const imagePass = document.getElementById('confirmicon')

    if(confirmPasswordInput.type === "password"){
        confirmPasswordInput.type = "text"
        imagePass.src = "storage/assets/show.png"
    }else{
        confirmPasswordInput.type = "password"
        imagePass.src = "storage/assets/invisible.png"
    }

})
document.getElementById('signupform').addEventListener("submit", function(event) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;


    if (password !== confirmPassword) {
        alert("Error: Passwords do not match.");
        event.preventDefault(); // Prevent form submission
    }
});</script>
</body>
</html>
