<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
<header class="bg-[#cdb77f] h-[90px] flex items-center gap-8 sticky top-0 border-b border-[#9e8d63] z-10">
    <img id="logo" src="assets/Artboard 1.png" onclick="location.href = 'dashboard.php';" alt="" class="ml-[2vw] transition-transform duration-300 h-[80%] hover:scale-110">
    <p id="usn" class="text-base">{{ $greet }}{{ strtok(ucwords($_SESSION['username']), " ") }}.</p>
    <form method="GET" id="search-box" action="searchresult.php" class="w-[20vw] relative transition-all duration-300 hover:w-[25vw]">
        <input type="search" placeholder="Search essential, groceries, and more..." id="general-search" name="search" class="w-full h-full border-none rounded-lg shadow-md bg-[#f3f9fb] px-[44px] py-[16px] font-sans">
        <button type="submit" class="absolute top-[31%] left-[10px] bg-transparent border-none rounded-full">
            <img src="assets/search-interface-symbol.png" alt="" class="w-5 h-5">
        </button>
    </form>
    <div class="button-box w-[48px] h-[48px] bg-[#d9d9d9] rounded-full mb-[21px] flex justify-center items-center shadow-md transition-transform duration-420ms hover:scale-[1.17] hover:invert">
        <img src="assets/shopping-cart.png" alt="" class="m-auto max-w-[30px]" onclick="location.href = 'keranjang.php'">
    </div>
    <div class="button-box w-[48px] h-[48px] bg-[#d9d9d9] rounded-full mb-[21px] flex justify-center items-center shadow-md transition-transform duration-420ms hover:scale-[1.17] hover:invert">
        <img src="assets/like.png" alt="" class="m-auto max-w-[30px]">
    </div>
    <div class="button-box w-[48px] h-[48px] bg-[#d9d9d9] rounded-full mb-[21px] flex justify-center items-center shadow-md transition-transform duration-420ms hover:scale-[1.17] hover:invert">
        <img src="assets/user.png" alt="" class="m-auto max-w-[30px]" onclick="location.href = 'profile_page.php'">
    </div>
    <div class="button-box w-[48px] h-[48px] bg-[#d9d9d9] rounded-full mb-[21px] flex justify-center items-center shadow-md transition-transform duration-420ms hover:scale-[1.17] hover:invert">
        <img src="assets/clipboard.png" alt="" class="m-auto max-w-[30px]" onclick="location.href = 'userorder.php'">
    </div>
</header>

<main class="flex flex-col">
    <table class="space-x-[80px]">
        <tr>
            <td>
                @isset($_GET['alamat'])
                    @php
                        $sql2 = "SELECT * FROM alamat WHERE id_alamat = $_GET[alamat]";
                        $result = mysqli_query($db, $sql2);
                        if (mysqli_num_rows($result) > 0) {
                            $data = mysqli_fetch_assoc($result)
                        @endphp
                        <div class="card bg-white w-[40vw] min-h-[250px] border border-[#ccc] rounded-[40px] p-5 shadow-md transition-all duration-300 hover:bg-[#ccc]">
                            <div class="card-header bg-[#f0f0f0] p-2.5 border-b border-[#ccc] rounded-[40px]">
                                <h1 class="text-center text-lg mb-2.5">{{ $data['label'] }}</h1>
                            </div>
                            <div class="card-body">
                                <p class="leading-loose">
                                    <b>Alamat: </b>{{ $data['address'] }}
                                </p>
                                <p class="leading-loose">
                                    <b>Kode Postal: </b>{{ $data['postalcode'] }}
                                </p>
                                <p class="leading-loose">
                                    <b>Catatan bagi kurir: </b>{{ $data['courier_note'] }}
                                </p>
                            </div>
                        </div>
                    @endisset
            </td>
            <td>
                <div class="container gap-5 pl-10 flex flex-col items-center text-center">
                    @php
                    $sql3 = "SELECT id_alamat, label FROM alamat WHERE id_user = '$_SESSION[iduser]'";
                    $result = mysqli_query($db, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                        while ($data = mysqli_fetch_assoc($result)) {
                    @endphp
                        <a href="checkout.php?idcart={{ $_GET['idcart'] }}&alamat={{ $data['id_alamat'] }}" class="btn-tambah bg-[#d9d9d9] text-black px-6 py-2 rounded-lg transition-colors duration-300 hover:bg-gray-500 hover:text-white">{{ $data['label'] }}</a>
                    @php
                        }
                    }
                    @endphp
                    <a href="changeaddress.php" class="btn-tambah bg-[#d9d9d9] text-black px-6 py-2 rounded-lg transition-colors duration-300 hover:bg-gray-500 hover:text-white">Tambah Alamat Baru</a>
                </div>
            </td>
        </tr>
        @isset($_GET['idcart'])
        @php
            $sql = "SELECT p.productname, p.price, n.quantity, n.id_keranjang FROM produk p JOIN keranjang n ON p.id_produk = n.id_produk WHERE n.id_keranjang = '$_GET[idcart]'";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result)
        @endphp
            <tr>
                <td colspan="2">
                    <div class="card-2 flex flex-col w-[1000px] min-h-[345px] border border-[#ccc] rounded-[40px] p-5 shadow-md">
                        <div class="card-header bg-[#f0f0f0] p-2.5 border-b border-[#ccc] rounded-[40px]">
                            <h1 class="text-center text-lg mb-2.5">Detail Pesanan</h1>
                        </div>
                        <table>
                            <tr>
                                <td><p>Nama produk</p></td>
                                <td>:</td>
                                <td><p>{{ $data['productname'] }}</p></td>
                            </tr>
                            <tr>
                                <td><p>Jasa pengirim</p></td>
                                <td>:</td>
                                <td>
                                    <div class="card-info-2">
                                        <select name="cars" id="courier" class="border-b-2 border-black">
                                            <option value="jasa-pengirim"></option>
                                            <option value="jasa-pengirim">JNE</option>
                                            <option value="jasa-pengirim-2">JNT</option>
                                            <option value="jasa-pengirim-3">Si Cepat</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><p>Biaya Kirim</p></td>
                                <td>:</td>
                                <td><p>sekian</p></td>
                            </tr>
                            <tr>
                                <td><p>Jumlah Pesanan</p></td>
                                <td>:</td>
                                <td><p>{{ $data['quantity'] }}</p></td>
                            </tr>
                            <tr>
                                <td><p>Harga Total</p></td>
                                <td>:</td>
                                <td><p>Rp. {{ number_format($data['price'] * $data['quantity'], 2, ',', '.') }}</p></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        @php
            }
        }
        @endphp
    </table>
    <a id="continue" href="rincianpembayaran.php?total={{ $subtotal }}&idalamat={{ $_GET['alamat'] }}&idcart={{ $_GET['idcart'] }}" class="flex justify-center items-center self-end bg-[#d9d9d9] text-[#000000] w-[10vw] mr-[10vw] mt-[30px] rounded-lg transition-colors duration-300 hover:bg-gray-500 hover:text-white">Lanjut</a>
</main>
</body>
</html>