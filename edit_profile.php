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

// Prepare SQL query to fetch detailed user information
$query = "SELECT * FROM user WHERE id_user = '$userData'"; // Assuming 'id' is the unique identifier in your 'user' table
$result = mysqli_query($koneksi, $query);

// Check if query was successful
if ($result) {
    // Fetch user details
    $userDetails = mysqli_fetch_assoc($result);
} else {
    // Error handling for database query failure
    echo "Failed to fetch user details.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Buku PerpuSkaga</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="images/logoperpuskaga.jpg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css" />
    <link rel="stylesheet" href="css/animate.css" />

    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />

    <link rel="stylesheet" href="css/aos.css" />

    <link rel="stylesheet" href="css/ionicons.min.css" />

    <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="css/jquery.timepicker.css" />

    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/icomoon.css" />
    <link rel="stylesheet" href="css/style.css" />

    <style>
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add shadow with color and size */
        }

        .navbar-brand {
            font-weight: bold;
            /* Example: Make the brand bold */
        }

        .navbar-brand span:last-child {
            color: #ffae42;
            /* Lighter shade of orange for SKAGA */
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            /* Warna latar belakang putih */
            z-index: 1000;
            color: #000;
            /* Warna teks hitam */
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Transisi untuk efek hover */
        }

        .dropdown-menu a {
            color: #380cc3;
            /* Warna teks link hitam */
        }

        .dropdown-toggle:hover+.dropdown-menu {
            display: block;
        }

        .dropdown-toggle:hover+.dropdown-menu:hover {
            background-color: #ccc;
            /* Warna latar belakang ketika dihover */
            color: #ffae42;
            /* Warna teks ketika dihover */
        }

        .custom-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #380cc3;
            margin: 5px;
            color: #ffae42;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease, border 0.3s ease;
            /* Tambahkan transition untuk efek transisi */
        }

        .custom-button:hover {
            background-color: #fff;
            border: 2px solid #380cc3;
            /* Tambahkan border saat tombol dihover */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="images/perpuskaga.png" style="width: 50px; height: 50px;">PERPU<span>SKAGA</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="wishlist.html" class="nav-link">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php" class="nav-link">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            Profile</a>
                    </li>
                </ul>
            </div>


        </div>
    </nav>
    <!-- END nav -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Edit Profile</h5>
                    </div>
                    <div class="card-body">
                        <form action="update_profile.php" method="POST">
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="full_name">Nama Lengkap</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $userDetails['nama']; ?>">
                            </div>
                            <!-- Phone Number -->
                            <div class="form-group">
                                <label for="phone_number">No Handphone</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?php echo $userDetails['noHp']; ?>">
                            </div>
                            <!-- Gender -->
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Laki-Laki" <?php if ($userDetails['jenisKelamin'] == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?php if ($userDetails['jenisKelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                            <!-- Address -->
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" class="form-control"><?php echo $userDetails['alamat']; ?></textarea>
                            </div>
                            <!-- Department -->
                            <div class="form-group">
                                <label for="department">Jurusan</label>
                                <input type="text" name="department" id="department" class="form-control" value="<?php echo $userDetails['jurusan']; ?>">
                            </div>
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                    <a href="profile.php" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light mt-5">
        <div class="container py-4">
        </div>
    </section>
    <footer class="ftco-footer ftco-section">
        <div class="container">
            <div class="row">
                <div class="mouse">
                    <a href="#" class="mouse-icon">
                        <div class="mouse-wheel">
                            <span class="ion-ios-arrow-up"></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">PerpuSkaga</h2>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate">
                                <a href="https://www.youtube.com/channel/UCRQ_6DKMY3JKZKCjmExULkA"><span class="icon-youtube"></span></a>
                            </li>
                            <li class="ftco-animate">
                                <a href="https://twitter.com/smktigajember"><span class="icon-twitter"></span></a>
                            </li>
                            <li class="ftco-animate">
                                <a href="https://www.facebook.com/smktigajember/"><span class="icon-facebook"></span></a>
                            </li>
                            <li class="ftco-animate">
                                <a href="https://www.instagram.com/smknegeri3jember/"><span class="icon-instagram"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li>
                                    <span class="icon icon-map-marker"></span><span class="text">Jalan Dr. Subandi, No.
                                        31, Patrang, Jl. DR. Soebandi,
                                        Kreongan Atas, Jemberlor, Kec. Patrang, Kabupaten Jember,
                                        Jawa Timur 68118</span>
                                </li>
                                <li>
                                    <a href="#"><span class="icon icon-phone"></span><span class="text">0331-488069
                                            Monday - Friday 07:00 am - 04:00 pm</span></a>
                                </li>
                                <li>
                                    <a href="#"><span class="icon icon-envelope"></span><span class="text">smktigajember@gmail.com 24 X 7 online support</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('.add-to-cart-btn').click(function() {
                var BukuID = $(this).data('product-id');
                $.ajax({
                    url: 'add_to_cart.php',
                    method: 'POST',
                    data: {
                        BukuID: BukuID
                    },
                    dataType: 'json', // Mengharapkan respons JSON dari server
                    success: function(response) {
                        // Tangani respons sukses
                        if (response.success) {
                            alert(response.message); // Tampilkan pesan sukses
                        } else {
                            alert(response.message); // Tampilkan pesan kesalahan
                        }
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan AJAX
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>