<?php

class Pengunjung {

    public static $jumlah = 0;

    public function __construct() {
        self::$jumlah++;
    }

    public static function reset() {
        self::$jumlah = 0;
    }
}

// buat 5 object
$p1 = new Pengunjung();
$p2 = new Pengunjung();
$p3 = new Pengunjung();
$p4 = new Pengunjung();
$p5 = new Pengunjung();

// sebelum reset
echo "Jumlah sebelum reset: " . Pengunjung::$jumlah . "<br>";

// reset
Pengunjung::reset();

// sesudah reset
echo "Jumlah sesudah reset: " . Pengunjung::$jumlah;

?>