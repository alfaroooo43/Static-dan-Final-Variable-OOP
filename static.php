<?php

class ContohStatic {

    public static $jumlah = 0;

    public function tambah() {
        self::$jumlah++;
    }
}

$obj1 = new ContohStatic();
$obj2 = new ContohStatic();

$obj1->tambah();
$obj2->tambah();

echo ContohStatic::$jumlah; // output: 2

?>