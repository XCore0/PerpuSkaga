<?php
session_start();

// Ambil daftar buku yang dipilih dari session
$selected_books = isset($_SESSION['selected_books']) ? $_SESSION['selected_books'] : array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Buku</title>
</head>
<body>
    <h2>Form Peminjaman Buku</h2>
    <form action="proses_peminjaman.php" method="post">
        <label for="tanggal_pinjam">Tanggal Peminjaman:</label><br>
        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" required><br>
        
        <label for="tanggal_kembali">Tanggal Pengembalian:</label><br>
        <input type="date" id="tanggal_kembali" name="tanggal_kembali" required><br>

        <!-- Hidden input field for user ID obtained from login -->
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

        <!-- Display selected books from cart -->
        <h3>Daftar Buku yang Dipinjam:</h3>
        <?php
        // Loop through selected books from cart
        foreach ($selected_books as $book) {
            echo "<input type='checkbox' name='buku[]' value='$book[BookID]' checked> $book[judul]<br>";
        }
        ?>
        <br>

        <input type="submit" value="Pinjam">
    </form>
</body>
</html>
