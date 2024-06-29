  <?php
  session_start();
  include "koneksi.php";

  if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
  }

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>Daftar Buku PerpuSkaga</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="images/logoperpuskaga.jpg" />

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
      }

      .navbar-brand {
        font-weight: bold;
      }

      .navbar-brand span:last-child {
        color: #ffae42;
      }

      .empty-cart-message {
        text-align: center;
        margin-top: 100px;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img src="images/perpuskaga.png" style="width: 50px; height: 50px" />PERPU<span>SKAGA</span></a>
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


    <section class="ftco-section ftco-cart">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
            <div class="cart-list">
              <?php
              $totalPrice = 0;
              if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                // Validasi BukuID yang ada dalam session dengan yang ada di database
                $validBukuIDs = array_intersect(array_keys($_SESSION['cart']), array_column(mysqli_fetch_all(mysqli_query($koneksi, "SELECT BukuID FROM daftarbuku"), MYSQLI_ASSOC), 'BukuID'));

                if (!empty($validBukuIDs)) {
                  $productIds = implode(",", $validBukuIDs);
                  $query = "SELECT * FROM daftarbuku WHERE BukuID IN ($productIds)";
                  $result = mysqli_query($koneksi, $query);
                  if ($result) {
              ?>
                    <table class="table">
                      <thead class="thead-primary">
                        <tr class="text-center">
                          <th scope="col">Aksi</th>
                          <th scope="col">Gambar Buku</th>
                          <th scope="col">Nama Buku</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Deskripsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                          $itemTotal = $_SESSION['cart'][$row['BukuID']];
                        ?>
                          <tr class="text-center">
                            <td class="product-remove">
                              <a href="hapus_item.php?BukuID=<?php echo $row['BukuID']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');"><span class="ion-ios-close"></span></a>
                            </td>
                            <td class="image-prod">
                              <div class="img" style="background-image: url(images/<?php echo $row['GambarBuku']; ?>)"></div>
                            </td>
                            <td class="product-name">
                              <h3><?php echo $row['NamaBuku']; ?></h3>
                            </td>
                            <td class="price">
                              <p><?php echo $row['KategoriBuku']; ?></p>
                            </td>
                            <td class="quantity">
                              <p><?php echo $row['DeskripsiBuku']; ?></p>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
              <?php
                  } else {
                    echo "Error: " . mysqli_error($koneksi);
                  }
                } else {
                  echo "<p>Keranjang Buku Anda mengandung BukuID yang tidak valid.</p>";
                }
              } else {
                echo "<p>Keranjang Buku Anda Kosong. <a href='index.php'>Klik untuk Menambahkan Buku</a></p>";
              }
              ?>
            </div>
          </div>
        </div>
        <form action="proses_peminjaman.php" method="POST">
          <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Peminjaman:</label>
            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
          </div>
          <div class="form-group">
            <label for="tanggal_kembali">Tanggal Pengembalian:</label>
            <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <?php if (!empty($_SESSION['cart'])) : ?>
                <button type="submit" class="btn btn-primary">Pinjam Sekarang</button>
              <?php endif; ?>
            </div>
          </div>
        </form>
      </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4"></div>
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
                    <span class="icon icon-map-marker"></span><span class="text">Jalan Dr. Subandi, No. 31, Patrang, Jl. DR. Soebandi,
                      Kreongan Atas, Jemberlor, Kec. Patrang, Kabupaten Jember,
                      Jawa Timur 68118</span>
                  </li>
                  <li>
                    <a href="#"><span class="icon icon-phone"></span><span class="text">0331-488069 Monday - Friday 07:00 am - 04:00 pm</span></a>
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
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script>
            </p>
          </div>
        </div>
      </div>
    </footer>

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
  </body>

  </html>