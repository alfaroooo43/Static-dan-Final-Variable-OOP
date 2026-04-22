<?php

final class Database {

    public function koneksi() {
        echo "Koneksi database berhasil";
    }
}

// ERROR jika dicoba
// class MyDB extends Database {}

$db = new Database();
$db->koneksi();

?>