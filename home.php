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
										<li><a class="dropdown-item" href="change_password.php">Wachtwoord wijzigen</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Uitloggen</a></li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <a href="#" class="user-account for-buy"><i class="icon icon-user"></i><span>Account</span></a>
                            <?php endif; ?>
							<a href="#" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart:(0
									$)</span></a>

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
									<li class="menu-item active"><a href="#home">Home</a></li>
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

	<section id="quotation" class="align-center" style="background-color:#EDEBE4; justify-content:center; display:flex; padding:40px 0;">
		
		<div class="inner-content">
			<h2 class="section-title divider">Quote of the day</h2>
			<blockquote data-aos="fade-up">
				   <q>He who thinks he can, and he who thinks he can't are both usually right.</q>
				<div class="author-name">Confucius</div>
			</blockquote>
		</div>
	</section>

	
	

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

					<ul class="tabs">
						<?php 
						$categories = [
							'all' => 'All Genre',
							'OCD' => 'OCD',
							'Panic & Anxiety' => 'Panic & Anxiety',
							'Productivity' => 'Productivity',
							'Stress tolerance' => 'Stress tolerance'
						];
						$active_cat = isset($_GET['cat']) ? $_GET['cat'] : 'all';
						foreach ($categories as $cat_key => $cat_label): ?>
							<li class="tab<?php if($active_cat === $cat_key) echo ' active'; ?>">
								<a href="#" class="cat-tab-link" data-cat="<?= htmlspecialchars($cat_key) ?>"><?= htmlspecialchars($cat_label) ?></a>
							</li>
						<?php endforeach; ?>
					</ul>

					<div class="tab-content">
						<div id="all-genre" data-tab-content class="active">
							<div class="row" id="ebooks-list">
							<?php
							$cat_filter = isset($_GET['cat']) ? $_GET['cat'] : 'all';
							if ($cat_filter === 'all') {
								$stmt = $db->query('SELECT * FROM ebooks ORDER BY id DESC LIMIT 10');
							} else {
								$stmt = $db->prepare('SELECT * FROM ebooks WHERE category = ? ORDER BY id DESC LIMIT 10');
								$stmt->execute([$cat_filter]);
							}
							$ebooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
							if (empty($ebooks)) {
								echo '<div class="col-12 text-center py-4">Geen eBooks gevonden in deze categorie.</div>';
							}
							foreach ($ebooks as $ebook): ?>
								<div class="col-md-3">
								   <div class="product-item">
									   <figure class="product-style">
										   <img src="<?= htmlspecialchars($ebook['cover_image']) ?>" alt="<?= htmlspecialchars($ebook['title']) ?>" class="product-item" style="width:270px;height:380px;object-fit:cover;">
										   <a href="uploads/<?= htmlspecialchars($ebook['pdf_path']) ?>" target="_blank" class="add-to-cart" style="display:block;text-align:center;margin-top:10px;">Bekijk/download</a>
										   <?php if ($is_admin): ?>
											 <form method="post" style="margin-top:10px;text-align:center;">
											   <input type="hidden" name="delete_ebook_id" value="<?= $ebook['id'] ?>">
											   <button type="submit" onclick="return confirm('Weet je zeker dat je dit eBook wilt verwijderen?');" style="background:#c0392b;color:#fff;border:none;padding:6px 16px;border-radius:6px;cursor:pointer;font-size:0.95rem;">Verwijder</button>
											 </form>
										   <?php endif; ?>
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


	<footer id="footer">

	<section id="subscribe">
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-md-8">
					<div class="row">

						<div class="col-md-6">

							<div class="title-element">
								<h2 class="section-title divider">Subscribe to our newsletter</h2>
							</div>

						</div>
						<div class="col-md-6">

							<div class="subscribe-content" data-aos="fade-up">
								<p>Stay up to date with our latest news and products.</p>
								<form id="form">
									<input type="text" name="email" placeholder="Enter your email addresss here">
									<button class="btn-subscribe">
										<span>send</span>
										<i class="icon icon-send"></i>
									</button>
								</form>
							</div>

						</div>

					</div>
				</div>

			</div>
		</div>
	</section>

	</footer>
		<script>
		// AJAX filtering voor ebooks per categorie
		document.addEventListener('DOMContentLoaded', function() {
			const tabLinks = document.querySelectorAll('.cat-tab-link');
			const ebooksList = document.getElementById('ebooks-list');
			const isAdmin = <?= $is_admin ? '1' : '0' ?>;
			tabLinks.forEach(function(link) {
				link.addEventListener('click', function(e) {
					e.preventDefault();
					tabLinks.forEach(l => l.parentElement.classList.remove('active'));
					link.parentElement.classList.add('active');
					const cat = link.getAttribute('data-cat');
					fetch('ajax/filter_ebooks.php?cat=' + encodeURIComponent(cat) + '&admin=' + isAdmin)
						.then(res => res.text())
						.then(html => {
							ebooksList.innerHTML = html;
						});
				});
			});
		});
		</script>


		<script src="js/jquery-1.11.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
				crossorigin="anonymous"></script>
		<script src="js/plugins.js"></script>
		<script src="js/script.js"></script>

		<script>
		// Scroll automatisch naar #popular-books na filteren, maar alleen als er een categorie is gekozen
		document.addEventListener('DOMContentLoaded', function() {
			const urlParams = new URLSearchParams(window.location.search);
			if(urlParams.has('cat')) {
				const section = document.getElementById('popular-books');
				if(section) {
					section.scrollIntoView({behavior: 'smooth'});
				}
			}
		});
		</script>

</body>

</html>