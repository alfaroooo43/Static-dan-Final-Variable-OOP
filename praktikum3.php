<?php

class Produk {

    public static $jumlahProduk = 0;

    public $nama;
    public $harga;

    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
        self::$jumlahProduk++;
    }
}

class Transaksi {

    final public function prosesTransaksi($produk) {
        echo "Transaksi diproses: " . $produk->nama . 
             " - Rp" . $produk->harga . "<br>";
    }
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

// simpan produk dalam array (sementara)
session_start();

if (!isset($_SESSION['produk'])) {
    $_SESSION['produk'] = [];
}

// jika form disubmit
if (isset($_POST['nama'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $produk = new Produk($nama, $harga);

    $_SESSION['produk'][] = $produk;
}

// tampilkan semua produk
echo "<h3>Daftar Produk:</h3>";

$t = new Transaksi();

foreach ($_SESSION['produk'] as $p) {
    $t->prosesTransaksi($p);
}

// tampilkan total produk
echo "<br><b>Total Produk: " . Produk::$jumlahProduk . "</b>";

?>

</body>
</html>