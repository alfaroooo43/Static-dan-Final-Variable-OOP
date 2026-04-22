<?php
session_start();

class Produk {

    public static $jumlahProduk = 0;

    public $nama;
    public $harga;

    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }
}

class Transaksi {

    final public function prosesTransaksi($produk) {
        echo "Transaksi diproses: " . $produk->nama . 
             " - Rp" . $produk->harga . "<br>";
    }
}

// inisialisasi session
if (!isset($_SESSION['produk'])) {
    $_SESSION['produk'] = [];
}

// 👉 HANDLE POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $produk = new Produk($nama, $harga);

    $_SESSION['produk'][] = $produk;

    // 🔥 REDIRECT biar gak double submit
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Praktikum 3</title>
</head>
<body>

<h2>Input Produk</h2>

<form method="post">
    Nama Barang: <input type="text" name="nama" required><br><br>
    Harga: <input type="number" name="harga" required><br><br>
    <button type="submit">Tambah Produk</button>
</form>

<hr>

<?php

echo "<h3>Daftar Produk:</h3>";

$t = new Transaksi();

// hitung total dari session (bukan static)
$total = count($_SESSION['produk']);

foreach ($_SESSION['produk'] as $p) {
    $t->prosesTransaksi($p);
}

echo "<br><b>Total Produk: $total</b>";

?>

</body>
</html>