<?php
session_start();
if(!isset($_SESSION['username'])) {
     header("Location: login.php");
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>User profile</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

<style>
    body.account-page, body.account-page * { color: #000 !important; }
		body.account-page a, body.account-page a * { color: #000 !important; }
		body.account-page a:hover, body.account-page a:hover * { color: #ecd17b !important; }
		body.account-page i, body.account-page .icon { color: #3ea3c7 !important; }
</style>
</head>
<body class="account-page" style="background-color:#fff !important; font-family: 'Times New Roman', Times, serif !important;" data-bs-spy="scroll" data-bs-target="#header" tabindex="0">
	<div id="header-wrap" style="background:#fff !important;">
        <div class="top-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="social-links">
                            <ul style="background-color:#fff !important;">
                                <li><a href="#"><i class="icon icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon icon-youtube-play"></i></a></li>
                                <li><a href="#"><i class="icon icon-behance-square"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-element">
                            <?php if(isset($_SESSION['username'])): ?>
                                <div class="dropdown d-inline-block">
                                    <a href="#" class="user-account for-buy dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="icon icon-user"></i>
                                        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="change_password.php">Reset Password</a></li>
										<li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <a href="#" class="user-account for-buy"><i class="icon icon-user"></i><span>Account</span></a>
                            <?php endif; ?>
                            <a href="#" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart:(0 $)</span></a>
                            <div class="action-menu">
                                <div class="search-bar">
                                    <a href="#" class="search-button search-toggle" data-selector="#header-wrap">
                                        <i class="icon icon-search"></i>
                                    </a>
                                    <form role="search" method="get" class="search-box">
                                        <input class="search-field text search-input" placeholder="Search" type="search">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header id="header" style="background:#fff !important; box-shadow:none !important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <div class="main-logo">
                            <a href="index.html"><img src="images/LOGO_ZaidSoufi.png" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-md-10">
                       <nav id="navbar">
							<div class="main-menu stellarnav">
								<ul class="menu-list" style="background-color:#fff !important;">
									<li class="menu-item active"><a href="home.php">Home</a></li>
									<li class="menu-item"><a href="ebooks.php" class="nav-link">eBooks</a></li>
									<li class="menu-item"><a href="#featured-books" class="nav-link">New Arrivals</a></li>
									<li class="menu-item"><a href="#popular-books" class="nav-link">Blog</a></li>
									<li class="menu-item"><a href="#special-offer" class="nav-link">About Us</a></li>
								</ul>

								<div class="hamburger">
									<span class="bar"></span>
									<span class="bar"></span>
									<span class="bar"></span>
								</div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    </div><!--header-wrap-->


    <?php
    // Haal currency_units op voor de ingelogde gebruiker
    require_once 'classes/Db.php';
    $db = Db::getConnection();
    $stmt = $db->prepare('SELECT currency_units FROM users WHERE username = ?');
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $currency = $user ? (int)$user['currency_units'] : 0;
    ?>

    <div class="container mt-4">
      <div class="alert alert-info text-center">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! This is your profile page.</div>
      <div class="alert alert-success text-center">Your digital balance: <strong><?php echo $currency; ?> units</strong></div>

      <?php
      // Toon bestelde eBooks
  $orders = [];
  $cart_ebooks = [];
      // Haal user_id op
      $stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
      $stmt->execute([$_SESSION['username']]);
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
      $user_id = $userRow ? (int)$userRow['id'] : 0;
      if ($user_id) {
          // Bestelde eBooks
          $stmt = $db->prepare('
            SELECT ebooks.title, ebooks.pdf_path
            FROM orders
            JOIN order_items ON orders.id = order_items.order_id
            JOIN ebooks ON order_items.ebook_id = ebooks.id
            WHERE orders.user_id = ?
            ORDER BY orders.created_at DESC, order_items.id DESC
          ');
          $stmt->execute([$user_id]);
          $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Ebooks in cart (winkelwagen) tonen
          if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            // Haal alle ebook info op uit de cart
            $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
            $stmt = $db->prepare('SELECT title, pdf_path FROM ebooks WHERE id IN (' . $placeholders . ')');
            $stmt->execute(array_values($_SESSION['cart']));
            $cart_ebooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
          }
      }
      ?>
      <div class="card mt-4">
        <div class="card-header bg-info text-white">Your Ordered eBooks</div>
        <div class="card-body">
          <?php if (count($orders) > 0): ?>
            <ul class="list-group">
              <?php foreach ($orders as $order): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span><?php echo htmlspecialchars($order['title']); ?></span>
                  <a href="ebooks/<?php echo htmlspecialchars($order['pdf_path']); ?>" class="btn btn-primary btn-sm" target="_blank">Download</a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <?php if (count($cart_ebooks) > 0): ?>
              <div class="text-info">You have not ordered any eBooks yet, but you have eBooks in your cart. Click 'Order' on an eBook to order it.</div>
              <ul class="list-group mt-2">
                <?php foreach ($cart_ebooks as $cart): ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo htmlspecialchars($cart['title']); ?></span>
                    <a href="ebooks.php" class="btn btn-success btn-sm">Order</a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <div class="text-muted">You have not ordered any eBooks yet.</div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
        <?php if (count($cart_ebooks) > 0): ?>
        <div class="card mt-4">
          <div class="card-header bg-warning text-dark">eBooks in your Cart</div>
          <div class="card-body">
            <ul class="list-group">
              <?php foreach ($cart_ebooks as $cart): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span><?php echo htmlspecialchars($cart['title']); ?></span>
                  <span class="badge bg-secondary">In cart</span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>
    </div>

  
	<footer class="custom-footer">
  <div class="container text-center py-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h4 class="footer-title mb-3">eBookStore &copy; 2026</h4>
        <p class="footer-text mb-2">Thank you for visiting our webshop. Enjoy reading!</p>
        <div class="footer-social mb-2">
          <a href="#" class="me-2"><i class="icon icon-facebook"></i></a>
          <a href="#" class="me-2"><i class="icon icon-twitter"></i></a>
          <a href="#" class="me-2"><i class="icon icon-youtube-play"></i></a>
          <a href="#"><i class="icon icon-behance-square"></i></a>
        </div>
        <div class="footer-contact">
          <span>Email: <a href="mailto:info@ebookstore.com">info@ebookstore.com</a></span>
        </div>
      </div>
    </div>
  </div>
</footer>
<style>
.custom-footer {
  background: #3ea3c7;
  color: #fff;
  margin-top: 0;
  width: 100%;
  box-shadow: 0 -2px 12px rgba(62,163,199,0.08);
}
.custom-footer .footer-title {
  font-size: 1.3rem;
  font-weight: 700;
  letter-spacing: 1px;
}
.custom-footer .footer-text {
  font-size: 1rem;
}
.custom-footer .footer-social a {
  color: #fff;
  font-size: 1.3rem;
  margin-right: 8px;
  transition: color 0.2s;
}
.custom-footer .footer-social a:hover {
  color: #ecd17b;
}
.custom-footer .footer-contact {
  margin-top: 8px;
  font-size: 0.98rem;
}
.custom-footer .footer-contact a {
  color: #ecd17b;
  text-decoration: underline;
}
@media (max-width: 600px) {
  .custom-footer .footer-title {
    font-size: 1.05rem;
  }
  .custom-footer .footer-text {
    font-size: 0.95rem;
  }
}
</style>

	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>
</body>
</html>
