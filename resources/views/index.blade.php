<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Landing Page</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900 font-abeezee">
  <!-- Header -->
  <header class="flex justify-between items-center p-4 bg-custom-coklat">
    <img id="logo" src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="h-16 cursor-pointer" onclick="location.href = '{{ url('/') }}';">
    <div class="flex items-left space-x-2">
      <input type="text" placeholder="Search product" id="general-search" class="border rounded-lg px-16 py-2" />
      <button onclick="location.href = '{{ url('regis') }}'" class="bg-neutral-400 text-white px-4 py-4 rounded-full">
        <img src="{{ asset('storage/assets/search-interface-symbol.png') }}" alt="Search" class="h-4 ">
      </button>
    </div>
    <div class="space-x-4">
      <a href="{{ url('regis') }}" class="border rounded-xl px-4 py-2 border-none shadow-xl font-semibold bg-neutral-400 ">Daftar</a>
      <a href="{{ url('login') }}" class="border  rounded-xl px-4 py-2 border-none shadow-xl font-semibold bg-neutral-400 ">Masuk</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="p-4">
    <!-- Advertisement Section -->
    <div class="advertisement bg-gray-200 h-40 mb-4"></div>

    <!-- Featured Products Section -->
    <section class="mb-8">
      <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Top Product Of This Month</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
          @foreach($products as $product)
            <div class="product bg-white p-4 rounded shadow-md">
              <img src="{{ url($product->imgname) }}" alt="{{ $product->productname }}" class="w-full h-48 object-contain">
              <div class="product-desc mt-2">
                <p class="font-bold">{{ $product->productname }}</p>
                <p>Rp.{{ number_format($product->price, 2, ",", ".") }} /pcs</p>
                <a href="{{ url('signup') }}" class="bg-blue-500 text-white px-4 py-2 mt-2 inline-block rounded">Buy Now</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Categories Section -->
    <section>
      <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Shopping By The Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
          @foreach(['putih','merah','hitam','ketan','aromatik'] as $category)
            <div class="product-categories text-center bg-white p-4 rounded shadow-md">
              <img src="{{ asset('storage/assets/' . $category . '.jpg') }}" alt="{{ ucfirst($category) }}" class="categori-img  object-contain rounded-full cursor-pointer" onclick="location.href = '{{ url('regis') }}'">
              <p class="category-desc mt-2">Beras {{ ucfirst($category) }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-custom-coklat py-8 mt-8 shadow-inner">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Contact Info -->
      <div class="space-y-4">
        <img src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="h-10 mb-4">
        <div class="contact-info flex items-center space-x-2">
          <img src="{{ asset('storage/assets/whatsapp.png') }}" alt="WhatsApp" class="h-6">
          <div>
            <p>Whatsapp</p>
            <p>+62 812-3456-7890</p>
          </div>
        </div>
        <div class="contact-info flex items-center space-x-2">
          <img src="{{ asset('storage/assets/call.png') }}" alt="Call" class="h-6">
          <div>
            <p>Call Us</p>
            <p>+62 812-3456-7890</p>
          </div>
        </div>
        <div class="contact-info flex items-center space-x-2">
          <img src="{{ asset('storage/assets/mail.png') }}" alt="Email" class="h-6">
          <div>
            <p>E-mail</p>
            <p>oryva@gmail.com</p>
          </div>
        </div>
      </div>
      <!-- Customer Services -->
      <div>
        <h3 class="text-lg font-semibold mb-2">Customer Services</h3>
        <div class="line-footer h-px bg-gray-300 mb-4"></div>
        <ul class="space-y-2">
          <li>About Us</li>
          <li>Terms & Conditions</li>
          <li>FAQ</li>
          <li>Privacy Policy</li>
          <li>E-waste Policy</li>
          <li>Cancellation & Return Policy</li>
        </ul>
      </div>
    </div>
  </footer>
</body>
</html>
