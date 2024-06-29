<?php

include('koneksi.php');
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

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 mb-5 text-center">
					<ul class="product-category">
						<li><a href="#" class="active">All</a></li>
						<li><a href="#">Genre</a></li>
						<li><a href="#">Genre</a></li>
						<li><a href="#">Genre</a></li>
						<li><a href="#">Genre</a></li>
						<li><a href="#">Genre</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<?php
				$query = "SELECT * FROM daftarbuku ORDER BY BukuID ASC";
				$result = mysqli_query($koneksi, $query);
				if (!$result) {
					die("Query Error: " . mysqli_error($koneksi) . " - " . mysqli_error($koneksi));
				}

				while ($row = mysqli_fetch_assoc($result)) {
				?>
					<div class="col-lg-3 col-md-4 col-6 ftco-animate">
						<div class="product">
							<a href="#" class="img-prod"><img class="img-fluid" src="images/<?php echo $row['GambarBuku']; ?>" alt="Gambar Buku" />
								<span class="status"><?php echo $row['KategoriBuku'] ?></span>
								<div class="overlay"></div>
							</a>
							<div class="text py-3 pb-4 px-3 text-center">
								<h3><a href="#"> <?php echo $row['NamaBuku']; ?></a></h3>
								<div class="bottom-area d-flex px-3">
									<div class="m-auto d-flex">
										<button class="custom-button buy-now mx-1" data-product-id="<?php echo $row['BukuID']; ?>" onclick="addToCart(this)">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
												<path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
											</svg>
										</button>
									</div>

								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
			<div class="row mt-5">
				<div class="col text-center">
					<div class="block-27">
						<ul>
							<li><a href="#">&lt;</a></li>
							<li class="active"><span>1</span></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">&gt;</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		function addToCart(button) {
			// Mendapatkan ID buku dari atribut data-product-id tombol yang diklik
			var BukuID = $(button).data('product-id');

			// Kirimkan permintaan AJAX untuk menambahkan buku ke dalam keranjang
			$.ajax({
				url: 'add_to_cart.php', // Lokasi file PHP yang akan memproses permintaan
				method: 'POST',
				data: {
					BukuID: BukuID
				}, // Kirimkan ID buku sebagai data POST
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
		}
	</script>


</body>

</html>