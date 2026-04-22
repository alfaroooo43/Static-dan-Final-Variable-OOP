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

// inisialisasi
$_SESSION['keranjang'] = $_SESSION['keranjang'] ?? [];
$_SESSION['diproses']  = $_SESSION['diproses'] ?? [];
$_SESSION['selesai']   = $_SESSION['selesai'] ?? [];

#tambahh produk dan keranjang 
if (isset($_POST['tambah'])) {
    $_SESSION['keranjang'][] = new Produk($_POST['nama'], $_POST['harga']);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

#mwnghapu produk dari kernajng
if (isset($_GET['hapus'])) {
    unset($_SESSION['keranjang'][$_GET['hapus']]);
    $_SESSION['keranjang'] = array_values($_SESSION['keranjang']);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

#buat transaksi = alur nya (keranjang → diproses)
if (isset($_POST['buat_transaksi'])) {
    if (!empty($_SESSION['keranjang'])) {
        $_SESSION['diproses'][] = $_SESSION['keranjang'];
        $_SESSION['keranjang'] = [];
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

#menyelesaikan transaksi = alurnyaa(diproses → selesai)
if (isset($_GET['selesaikan'])) {
    $index = $_GET['selesaikan'];

    $_SESSION['selesai'][] = $_SESSION['diproses'][$index];

    unset($_SESSION['diproses'][$index]);
    $_SESSION['diproses'] = array_values($_SESSION['diproses']);

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Transaksi</title>
</head>
<body>

<h2>Tambah Produk</h2>
<form method="post">
    Nama: <input type="text" name="nama" required><br><br>
    Harga: <input type="number" name="harga" required><br><br>
    <button name="tambah">Tambah</button>
</form>

<hr>

<h3>Keranjang</h3>
<?php
if (!empty($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $i => $p) {
        echo ($i+1).". $p->nama - Rp$p->harga ";
        echo "<a href='?hapus=$i'></a><br>";
    }

    echo "
    <form method='post'>
        <button name='buat_transaksi'>Buat Transaksi</button>
    </form>";
} else {
    echo "Keranjang kosong";
}
?>

<hr>

<h3>Transaksi Diproses</h3>
<?php
if (!empty($_SESSION['diproses'])) {
    foreach ($_SESSION['diproses'] as $i => $trx) {

        echo "<b>Transaksi #".($i+1)."</b><br>";

        foreach ($trx as $p) {
            echo "- $p->nama - Rp$p->harga<br>";
        }

        echo "<a href='?selesaikan=$i'>Selesaikan</a><br><br>";
    }
} else {
    echo "Tidak ada transaksi diproses";
}
?>

<hr>

<h3>Transaksi Selesai</h3>
<?php
if (!empty($_SESSION['selesai'])) {
    foreach ($_SESSION['selesai'] as $i => $trx) {

        echo "<b>Transaksi #".($i+1)."</b><br>";

        foreach ($trx as $p) {
            echo "- $p->nama - Rp$p->harga<br>";
        }

        echo "<br>";
    }
} else {
    echo "Belum ada transaksi selesai";
}
?>

</body>
</html>