<?php
session_start();
include "koneksi.php"; // Pastikan file ini mencakup koneksi ke database

// Pastikan pengguna telah login, jika tidak, alihkan ke halaman login
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit;
}

// Pastikan parameter BukuID telah diset
if (isset($_GET['BukuID'])) {
    $BukuID = $_GET['BukuID'];

    // Periksa apakah BukuID ada dalam session keranjang belanja
    if (isset($_SESSION['cart']) && array_key_exists($BukuID, $_SESSION['cart'])) {
        // Hapus item dari keranjang belanja berdasarkan BukuID
        unset($_SESSION['cart'][$BukuID]);
        $_SESSION['success_message'] = "Item berhasil dihapus dari keranjang.";
    } else {
        // Jika BukuID tidak ada dalam session keranjang belanja, beri pesan error
        $_SESSION['error_message'] = "Item tidak ditemukan dalam keranjang belanja.";
    }

    // Redirect kembali ke halaman keranjang
    header('Location: cart.php');
    exit;
} else {
    // Jika BukuID tidak diset, kembalikan ke halaman keranjang dengan pesan error
    $_SESSION['error_message'] = "Product ID tidak valid.";
    header('Location: cart.php');
    exit;
}
