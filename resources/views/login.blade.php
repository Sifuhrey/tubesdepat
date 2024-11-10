<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <title>Log-in</title>
</head>

<body class="bg-white flex items-center justify-center min-h-screen">


    <!-- Logo Header -->
    <main class="flex flex-col md:flex-row gap-96 items-left justify-left md:space-x-1 space-y-30 md:space-y-0">
        
        <!-- Left Section - Information -->
        <div class="text-center md:text-left space-y-4">
            <h1 class="text-3xl font-semibold">Sign in to</h1>
            <h2 class="text-xl text-gray-600">Oryva Marketplace</h2>
            <p class="text-sm text-gray-500">Jika anda tidak mempunyai akun</p>
            <p id="register" class="text-green-500">
                <a href="{{ url('signup') }}">Register Here!</a>
            </p>
            <div class="mt-8">
                <img src="{{ asset('assets/Maskot.png') }}" alt="maskot" class="w-20 mx-auto md:mx-0">
            </div>
        </div>

        <!-- Right Section - Form -->
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <p class="text-xl font-medium mb-6 text-center">Sign in</p>
            <form action="{{ htmlspecialchars($_SERVER['PHP_SELF']) }}" method="post" class="space-y-4">
                @csrf
                <div>
                    <input type="text" name="email" placeholder="Enter email or username" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <input type="password" name="password" placeholder="Password" required minlength="8" id="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <p class="text-right text-sm text-gray-500">
                    <a href="{{ url('forgotpassword') }}" class="text-green-500">Forgot password?</a>
                </p>
                <div>
                    <input type="submit" value="Login" name="login"
                        class="w-full py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition duration-300 cursor-pointer">
                </div>
            </form>
        </div>

    </main>

    <script src="{{ asset('script/signin.js') }}"></script>
</body>
</head>

</html>