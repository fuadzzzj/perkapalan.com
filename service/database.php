<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "data_anggota_perkapalan";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>