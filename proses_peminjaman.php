<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tanggal_pinjam']) && isset($_POST['tanggal_kembali'])) {
    // Ambil tanggal peminjaman dan pengembalian dari form
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Ambil ID pengguna dari sesi login sebelumnya
    $id_pengguna = $_SESSION['user'];

    // Simpan informasi peminjaman ke dalam tabel peminjaman di database
    $query = "INSERT INTO peminjaman (id_user, TanggalPinjam, TanggalKembali) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "iss", $id_pengguna, $tanggal_pinjam, $tanggal_kembali);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Peminjaman berhasil disimpan ke dalam database

        // Dapatkan ID peminjaman yang baru saja dimasukkan
        $peminjaman_id = mysqli_insert_id($koneksi);

        // Simpan detail buku yang dipinjam ke dalam tabel detail_peminjaman
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $buku_id => $jumlah) {
                // Anda harus mengganti nama-nama kolom di bawah sesuai dengan struktur tabel Anda
                $query_detail = "INSERT INTO detail_peminjaman (PeminjamanID, BukuID) VALUES (?, ?)";
                $stmt_detail = mysqli_prepare($koneksi, $query_detail);
                mysqli_stmt_bind_param($stmt_detail, "ii", $peminjaman_id, $buku_id);
                $result_detail = mysqli_stmt_execute($stmt_detail);
                if (!$result_detail) {
                    echo "Error: " . mysqli_error($koneksi);
                    exit; // Hentikan proses jika terjadi kesalahan
                }
            }
        }

        // Hapus session cart setelah peminjaman berhasil
        unset($_SESSION['cart']);

        // Redirect ke halaman sukses atau tampilkan pesan sukses
        header("Location: bukti_peminjaman.php?id=$peminjaman_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Jika halaman ini diakses secara langsung, redirect ke halaman index
    header("Location: index.php");
    exit();
}
