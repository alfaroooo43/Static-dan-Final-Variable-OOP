<?php

class Matematika {
    public static function tambah($a, $b) {
        return $a + $b;
    }
    public static function kurang($a, $b) {
        return $a - $b;
    }
    public static function luasPersegi($sisi) {
        return $sisi * $sisi;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Praktikum 2</title>
</head>
<body>

<h2>Hitung Matematika</h2>

<form method="post">
    Angka 1: <input type="number" name="a"><br><br>
    Angka 2: <input type="number" name="b"><br><br>
    Sisi: <input type="number" name="sisi"><br><br>

    <button type="submit">Hitung</button>
</form>
<?php
if (isset($_POST['a'])) {

    $a = $_POST['a'];
    $b = $_POST['b'];
    $sisi = $_POST['sisi'];

    echo "<h3>Hasil</h3>";
    echo "<h3>Menghitung sebuah hitungan matematika:</h3>";
    echo "Tambah: " . Matematika::tambah($a, $b) . "<br>";
    echo "Kurang: " . Matematika::kurang($a, $b) . "<br>";
    echo "Luas Persegi: " . Matematika::luasPersegi($sisi);
}
?>
</body>
</html>