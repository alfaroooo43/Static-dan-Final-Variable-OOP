<?php
session_start();

class Produk {
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
             " - Rp" . $produk->harga;
    }
}

// inisialisasi session
if (!isset($_SESSION['produk'])) {
    $_SESSION['produk'] = [];
}

// 👉 TAMBAH PRODUK
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $_SESSION['produk'][] = new Produk($nama, $harga);

    // redirect biar gak double submit
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// 👉 HAPUS PRODUK
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];

    unset($_SESSION['produk'][$index]);

    // reindex array biar rapi
    $_SESSION['produk'] = array_values($_SESSION['produk']);

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

<h3>Daftar Produk:</h3>

<?php

$t = new Transaksi();

if (count($_SESSION['produk']) > 0) {

    foreach ($_SESSION['produk'] as $i => $p) {

        echo ($i+1) . ". ";
        $t->prosesTransaksi($p);

        // tombol hapus
        echo " 
        <a href='?hapus=$i' 
        onclick=\"return confirm('Yakin hapus?')\">
        Hapus</a><br>";
    }

    echo "<br><b>Total Produk: " . count($_SESSION['produk']) . "</b>";

} else {
    echo "Belum ada produk.";
}

?>

</body>
</html>