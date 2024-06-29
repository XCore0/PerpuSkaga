<?php
session_start();
include "koneksi.php"; // Pastikan file ini mencakup koneksi ke database

if (!isset($_SESSION['user'])) {
    // Jika pengguna tidak masuk, kembalikan respon dengan pesan error
    echo json_encode(array('success' => false, 'message' => 'Unauthorized'));
    exit;
}

// Pastikan data POST yang diterima tidak kosong
if (!empty($_POST['BukuID'])) {
    $BukuID = $_POST['BukuID'];

    // Tambahkan produk ke dalam keranjang (misalnya, simpan dalam session atau database)
    // Di sini Anda dapat memodifikasi logika sesuai dengan kebutuhan Anda

    // Contoh: Menambahkan produk ke dalam session keranjang
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$BukuID])) {
        $_SESSION['cart'][$BukuID]++;
    } else {
        $_SESSION['cart'][$BukuID] = 1;
    }

    // Setelah menambahkan produk ke keranjang, alihkan pengguna ke halaman cart.php
    header('Location: cart.php');
    exit();
} else {
    // Jika data POST kosong, kembalikan respon dengan pesan error
    echo json_encode(array('success' => false, 'message' => 'Invalid product ID'));
    exit;
}
?>
