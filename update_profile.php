<?php
// Start the session to access session variables
session_start();

// Check if user session data exists
if (!isset($_SESSION['user'])) {
    // Redirect user to login page if session data is missing
    header("Location: login.php");
    exit();
}

// Retrieve user data from session
$userData = $_SESSION['user'];

// Establish database connection (assuming $koneksi is already defined)
include "koneksi.php"; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['full_name'];
    $phoneNumber = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $department = $_POST['department'];

    // Prepare SQL query to update user profile
    $query = "UPDATE user SET nama = '$fullName', noHp = '$phoneNumber', jenisKelamin = '$gender', alamat = '$address', jurusan = '$department' WHERE id_user =  '$userData'";

    // Execute the query
    $result = mysqli_query($koneksi, $query);

    // Check if the query was successful
    if ($result) {
        // Redirect user to profile page with success message
        header("Location: profile.php?success=1");
        exit();
    } else {
        // Redirect user to profile page with error message
        header("Location: profile.php?error=1");
        exit();
    }
} else {
    // Redirect user to profile page if form is not submitted
    header("Location: profile.php");
    exit();
}
?>
