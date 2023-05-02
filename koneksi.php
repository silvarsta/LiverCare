<?php
$connect = mysqli_connect("127.0.0.1:3307", "root", "", "probstat");
if (!$connect) {
    echo "Koneksi Gagal";
    die;
};
