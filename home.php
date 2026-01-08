<!DOCTYPE html>
<html lang="en">

<head>
	<title>eBook webshop</title>
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
#ebookCarousel .carousel-item .d-flex {
	flex-direction: row;
}
@media (max-width: 991.98px) {
	#ebookCarousel .carousel-item .d-flex {
		flex-direction: column;
		align-items: center !important;
	}
	#ebookCarousel .banner-content {
		margin-right: 0 !important;
		margin-bottom: 1.5rem;
		max-width: 100% !important;
		min-width: 0 !important;
		text-align: center !important;
	}
	#ebookCarousel .banner-image {
		margin-left: 0 !important;
		width: 90vw !important;
		max-width: 340px !important;
		height: auto !important;
	}
	#ebookCarousel .carousel-control-prev {
		left: 0;
	}
	#ebookCarousel .carousel-control-next {
		right: 0;
	}
}
@media (max-width: 575.98px) {
	#ebookCarousel .banner-image {
		max-width: 95vw !important;
		width: 95vw !important;
		height: auto !important;
	}
	#ebookCarousel .banner-title {
		font-size: 1.2rem !important;
	}
	#ebookCarousel .carousel-control-prev,
	#ebookCarousel .carousel-control-next {
		width: 40px;
		height: 40px;
	}
	#ebookCarousel .carousel-control-prev-icon,
	#ebookCarousel .carousel-control-next-icon {
		width: 32px;
		height: 32px;
	}
}
/* Carousel controls altijd zichtbaar en goed zichtbaar */
#ebookCarousel .carousel-control-prev, #ebookCarousel .carousel-control-next {
	width: 60px;
	height: 60px;
	top: 50%;
	transform: translateY(-50%);
	opacity: 1 !important;
	z-index: 10;
}
#ebookCarousel .carousel-control-prev-icon, #ebookCarousel .carousel-control-next-icon {
	background-color: #3ea3c7;
	border-radius: 50%;
	width: 48px;
	height: 48px;
	background-size: 60% 60%;
	background-position: center;
	background-repeat: no-repeat;
	box-shadow: 0 2px 8px rgba(62,163,199,0.18);
}
#ebookCarousel .carousel-control-prev {
	left: -40px;
}
#ebookCarousel .carousel-control-next {
	right: -40px;
}
	/* Alleen kleurregels, geen font-family hier zodat iconen werken */
	body.home-page, body.home-page * { color: #000 !important; }
	body.home-page a, body.home-page a * { color: #000 !important; }
	body.home-page a:hover, body.home-page a:hover * { color: #ecd17b !important; }
	body.home-page i, body.home-page .icon { color: #3ea3c7 !important; }
	</style>
</head>

<?php
session_start();
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
$admin_name = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Verwijder eBook als admin en formulier is verzonden
if ($is_admin && isset($_POST['delete_ebook_id'])) {
	$delete_id = intval($_POST['delete_ebook_id']);
	$stmt = $db->prepare('DELETE FROM ebooks WHERE id = ?');
	$stmt->execute([$delete_id]);
	// Optioneel: redirect om herladen te voorkomen
	header('Location: home.php');
	exit;
}
?>
<body class="home-page" style="background-color:#fff !important; font-family: 'Times New Roman', Times, serif !important;" data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

	<div id="header-wrap" style="background:#fff !important;">
		<?php if ($is_admin && $admin_name): ?>
			<div style="background:#ecd17b;padding:8px 0;text-align:center;font-weight:600;color:#6f4929;letter-spacing:1px;">
				Ingelogd als admin: <?= htmlspecialchars($admin_name) ?>
			</div>
		<?php endif; ?>

		<div class="top-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="social-links">
							<ul style="background-color:#fff !important;">
								<li>
									<a href="#"><i class="icon icon-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-youtube-play"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-behance-square"></i></a>
								</li>
							</ul>
						</div><!--social-links-->
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
                                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <a href="#" class="user-account for-buy"><i class="icon icon-user"></i><span>Account</span></a>
                            <?php endif; ?>
							<a href="#" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart:(0
									units)</span></a>

							<div class="action-menu">

								<div class="search-bar">
									<a href="#" class="search-button search-toggle" data-selector="#header-wrap">
										<i class="icon icon-search"></i>
									</a>
									<form role="search" method="get" class="search-box">
										<input class="search-field text search-input" placeholder="Search"
											type="search">
									</form>
								</div>
							</div>

						</div><!--top-right-->
					</div>

				</div>
			</div>
		</div><!--top-content-->

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

	<section id="billboard">
		<div class="container" style="display:flex;flex-direction:column;justify-content:center;min-height:250px;">
			<div class="row">
				<div class="col-md-12">
					<?php
					require_once 'classes/Db.php';
					$db = Db::getConnection();
					$stmt = $db->query('SELECT * FROM ebooks ORDER BY id DESC LIMIT 10');
					$slider_ebooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
					?>
					<div id="ebookCarousel" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner">
							<?php foreach ($slider_ebooks as $i => $ebook): ?>
								<div class="carousel-item<?php if ($i === 0) echo ' active'; ?>">
									<div class="d-flex flex-row align-items-center justify-content-center" style="min-height:540px;">
										<div class="banner-content text-start me-5" style="min-width:320px;max-width:400px;">
											<h2 class="banner-title mb-3"><?= htmlspecialchars($ebook['title']) ?></h2>
											<p class="mb-4"><?= htmlspecialchars(mb_strimwidth($ebook['category'], 0, 60, '...')) ?></p>
											<div class="btn-wrap">
												<a href="uploads/<?= htmlspecialchars($ebook['pdf_path']) ?>" target="_blank" class="btn btn-outline-accent btn-accent-arrow">Bekijk eBook<i class="icon icon-ns-arrow-right"></i></a>
											</div>
										</div>
										<img src="<?= htmlspecialchars($ebook['cover_image']) ?>" alt="<?= htmlspecialchars($ebook['title']) ?>" class="banner-image ms-4" style="width:370px;height:520px;object-fit:cover;border-radius:18px;box-shadow:0 4px 24px rgba(116, 81, 46, 0.12);background:#f6f8fa;border:4px solid #6f4929ff;padding:8px;">
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#ebookCarousel" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#ebookCarousel" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>

<!-- Nieuwe quote sectie met eigen stijl -->
	<section class="custom-quote-section">
		<div class="custom-quote-inner">
			<h2 class="custom-quote-title">Inspiration</h2>
			<blockquote class="custom-quote-block">
				<q>He who thinks he can, and he who thinks he can't are both usually right.</q>
				<div class="custom-quote-author">Confucius</div>
			</blockquote>
		</div>
	</section>
	<style>
	.custom-quote-section {
		background: #f9f6f1;
		padding: 48px 0 36px 0;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.custom-quote-inner {
		max-width: 600px;
		margin: 0 auto;
		text-align: center;
		background: #fffbe9;
		border-radius: 18px;
		box-shadow: 0 2px 16px rgba(116,81,46,0.08);
		padding: 32px 24px 24px 24px;
	}
	.custom-quote-title {
		font-size: 1.5rem;
		color: #3ea3c7;
		margin-bottom: 18px;
		font-weight: 700;
		letter-spacing: 1px;
	}
	.custom-quote-block q {
		color: #000;
		font-size: 1.25rem;
		font-style: italic;
		line-height: 1.6;
	}
	.custom-quote-author {
		color: #6f4929;
		font-weight: 600;
		margin-top: 14px;
		font-size: 1rem;
		letter-spacing: 0.5px;
	}
	@media (max-width: 600px) {
		.custom-quote-inner {
			padding: 18px 8px 16px 8px;
		}
		.custom-quote-title {
			font-size: 1.1rem;
		}
		.custom-quote-block q {
			font-size: 1rem;
		}
	}
	</style>

	
	

	<section id="popular-books" class="bookshelf py-5 my-5">
	<style>
				#popular-books .product-item img {
						width: 270px;
						height: 380px;
						object-fit: cover;
						background: #f6f8fa;
						border-radius: 12px;
						border: 3px solid #ecd17b;
						box-shadow: 0 4px 24px rgba(116, 81, 46, 0.12);
						padding: 6px;
						display: block;
						margin: 0 auto;
						max-width: 100%;
						height: auto;
				}
				@media (max-width: 600px) {
					#popular-books .product-item img {
						width: 100%;
						height: auto;
						min-width: 0;
						min-height: 0;
						max-width: 100%;
						max-height: 100vw;
						object-fit: contain;
					}
				}
	</style>
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="section-header align-center">
						<div class="title">
							<span>Some quality items</span>
						</div>
						<h2 class="section-title">Popular eBooks</h2>
					</div>



					<div class="tab-content">
						<div id="all-genre" data-tab-content class="active">
							<div class="row" id="ebooks-list">
							<?php
							$stmt = $db->query('SELECT * FROM ebooks ORDER BY id DESC LIMIT 10');
							$ebooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
							foreach ($ebooks as $ebook): ?>
								<div class="col-md-3">
								   <div class="product-item">
									   <figure class="product-style">
										   <img src="<?= htmlspecialchars($ebook['cover_image']) ?>" alt="<?= htmlspecialchars($ebook['title']) ?>" class="product-item" style="width:270px;height:380px;object-fit:cover;">
										   <a href="ebooks/<?= htmlspecialchars($ebook['pdf_path']) ?>" target="_blank" class="add-to-cart" style="display:block;text-align:center;margin-top:10px;">More info</a>
									   </figure>
									   <figcaption>
										   <h3><?= htmlspecialchars($ebook['title']) ?></h3>
										   <span><?= htmlspecialchars($ebook['category']) ?></span>
										   <div class="item-price">€ <?= number_format($ebook['price'], 2, ',', '.') ?></div>
									   </figcaption>
								   </div>
								</div>
							<?php endforeach; ?>
							</div>

								


						</div>
					
						</div>

					
							</div>
						</div>

					</div>

				</div><!--inner-tabs-->

			</div>
		</div>
	</section>


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
/* Footer kleuren consistent met site */
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
	color: #ecd17b;
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
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
				crossorigin="anonymous"></script>
		<script src="js/plugins.js"></script>
		<script src="js/script.js"></script>

</body>

</html>