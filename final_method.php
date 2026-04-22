<?php

class User {

    final public function login() {
        echo "Login berhasil";
    }
}

class Admin extends User {

    // ERROR jika override
    // public function login() {}
}

$a = new Admin();
$a->login();

?>