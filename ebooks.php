<?php
session_start();
$is_admin = isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] === true || $_SESSION['is_admin'] === 1 || $_SESSION['is_admin'] === '1');

?><!DOCTYPE html>
<html lang="en">
<head>
    <title>View eBooks</title>
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
		.ebook-card {
			background: #fffbe6;
			border-radius: 18px;
			box-shadow: 0 2px 12px rgba(62,163,199,0.08);
			border: 1px solid #b3e6fb;
			transition: box-shadow 0.2s;
		}
		.ebook-card:hover {
			box-shadow: 0 4px 24px rgba(62,163,199,0.18);
		}
		.ebook-card .card-title {
			color: #3ea3c7;
			font-weight: 600;
		}
		.ebook-card .btn-primary {
			background-color: #b3e6fb !important;
			border-color: #b3e6fb !important;
			color: #000 !important;
		}
		.ebook-card .btn-primary:hover, .ebook-card .btn-primary:focus {
			background-color: #3ea3c7 !important;
			border-color: #3ea3c7 !important;
			color: #fff !important;
		}
		.ebook-card img.card-img-top {
			width: 270px;
			height: 380px;
			object-fit: cover;
			background: #fff;
			border-radius: 18px;
			box-shadow: 0 4px 24px rgba(62,163,199,0.18);
			padding: 12px;
		}
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
										<li><a class="dropdown-item" href="change_password.php">Wachtwoord wijzigen</a></li>
										<li><a class="dropdown-item" href="logout.php">Uitloggen</a></li>
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
									<li class="menu-item"><a href="home.php">Home</a></li>
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
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<ul class="tabs">
						<?php 
						$categories = [
							'all' => 'All Genre',
							'OCD' => 'OCD',
							'Panic & Anxiety' => 'Panic & Anxiety',
							'Productivity' => 'Productivity',
							'Stress tolerance' => 'Stress tolerance'
						];
						 $selectedCategory = isset($_GET['cat']) ? $_GET['cat'] : 'all';
						 foreach ($categories as $cat_key => $cat_label): ?>
						 <li class="tab<?php if($selectedCategory === $cat_key) echo ' active'; ?>">
						<a href="?cat=<?= urlencode($cat_key) ?>" class="cat-tab-link" data-cat="<?= htmlspecialchars($cat_key) ?>"><?= htmlspecialchars($cat_label) ?></a>
						 </li>
						<?php endforeach; ?>
					</ul>

					<div class="tab-content">
						<div id="all-genre" data-tab-content class="active">
							<?php
							 $categoryFilter = $selectedCategory;
							 if ($categoryFilter === 'all') {
								 $statement = $db->query('SELECT * FROM ebooks ORDER BY id DESC LIMIT 10');
							 } else {
								 $statement = $db->prepare('SELECT * FROM ebooks WHERE category = ? ORDER BY id DESC LIMIT 10');
								 $statement->execute([$categoryFilter]);
							 }
							$ebooks = $statement->fetchAll(PDO::FETCH_ASSOC);
							if ($is_admin && !empty($ebooks)) {
							echo '<form method="post" id="bulkDeleteForm" style="margin-bottom:16px;">';
							echo '<div class="d-flex justify-content-between align-items-center mb-3">';
							$buttonWidth = '220px';
							echo '<a href="add_ebook.php" class="btn btn-primary" style="width:'.$buttonWidth.';border-radius:10px;background-color:#b3e6fb !important;border-color:#b3e6fb !important;color:#000 !important;">Add eBook</a>';
							echo '<button type="button" id="addToCartBtn" class="btn btn-success" style="width:'.$buttonWidth.';border-radius:10px;background-color:#b3e6fb !important;border-color:#b3e6fb !important;color:#000 !important;">Add to cart</button>';
							echo '</div>';
								echo '<div class="row" id="ebooks-list">';
								foreach ($ebooks as $ebook) {
									echo '<div class="col-md-3">';
									echo '<div class="product-item">';
									echo '<figure class="product-style">';
									// Checkbox voor bulk delete verwijderd
								echo '<input type="checkbox" class="ebook-cart-checkbox" name="selected_ebooks[]" value="'.htmlspecialchars($ebook['id']).'" style="position:absolute;left:8px;top:8px;z-index:2;">';
						echo '<img src="'.htmlspecialchars($ebook['cover_image']).'" alt="'.htmlspecialchars($ebook['title']).'" class="product-item" style="width:270px;height:380px;object-fit:cover;border-radius:16px;box-shadow:0 4px 24px rgba(62,163,199,0.18);background:#fff;padding:12px;border:3px solid #6f4929ff;">';
							echo '<div class="d-flex justify-content-between align-items-center" style="margin-top:10px;">';
							echo '<button type="button" class="btn btn-primary ebook-delete-btn" data-id="'.htmlspecialchars($ebook['id']).'" style="border-radius:10px;background-color:#ecd17b !important;border-color:#ecd17b !important;color:#000 !important;">Delete</button>';
							echo '<a href="uploads/'.htmlspecialchars($ebook['pdf_path']).'" target="_blank" style="text-decoration:underline;color:#3ea3c7;">More info</a>';
							echo '</div>';
									echo '</figure>';
									echo '<figcaption>';
									echo '<h3>'.htmlspecialchars($ebook['title']).'</h3>';
									echo '<span>'.htmlspecialchars($ebook['category']).'</span>';
									echo '<div class="item-price">'.intval($ebook['price']).' units</div>';
									echo '</figcaption>';
									echo '</div>';
									echo '</div>';
								}
							echo '</div>';
							// Add to cart knop verwijderd
							echo '</form>';
							} else {
								echo '<div class="row" id="ebooks-list">';
								if (empty($ebooks)) {
									echo '<div class="col-12 text-center py-4">No eBooks found in this category.</div>';
								}
								foreach ($ebooks as $ebook) {
									echo '<div class="col-md-3">';
									echo '<div class="product-item">';
									echo '<figure class="product-style">';
									echo '<img src="'.htmlspecialchars($ebook['cover_image']).'" alt="'.htmlspecialchars($ebook['title']).'" class="product-item" style="width:270px;height:380px;object-fit:cover;">';
									echo '<a href="uploads/'.htmlspecialchars($ebook['pdf_path']).'" target="_blank" class="add-to-cart" style="display:block;text-align:center;margin-top:10px;">Bekijk/download</a>';
									echo '</figure>';
									echo '<figcaption>';
									echo '<h3>'.htmlspecialchars($ebook['title']).'</h3>';
									echo '<span>'.htmlspecialchars($ebook['category']).'</span>';
									echo '<div class="item-price">€ '.number_format($ebook['price'], 2, ',', '.').'</div>';
									echo '</figcaption>';
									echo '</div>';
									echo '</div>';
								}
								echo '</div>';
							}
							// Bulk delete PHP logica verwijderd
							?>

								


						</div>
					
						</div>

					
							</div>
						</div>

					</div>

				</div><!--inner-tabs-->

			</div>
		</div>
	</section>

	<main>
        
	</main>
    

	<!-- Footer -->
	 <footer id="footer" style="background-color: #fffbe6;">
			<div class="container">
				<div class="row align-items-center align-items-stretch mb-5">
					<div class="col-md-4 py-4 py-md-5 aside-stretch d-flex align-items-center">
						<div class="w-100">
							<span class="subheading">Subscribe to our</span>
							<h3 class="heading-section">Newsletter</h3>
							<form action="#" class="subscribe-form mt-3" style="max-width:400px;">
								<div class="form-group mb-2">
									<input type="text" class="form-control" placeholder="Enter email address" style="border-radius:10px;">
								</div>
								<div>
									<button type="submit" class="btn btn-primary w-100" style="border-radius:10px;"><span>Submit</span></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		 </footer>

	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>
</body>
</html>