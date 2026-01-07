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
	
	body.home-page, body.home-page * { color: #000 !important; }
	body.home-page a, body.home-page a * { color: #000 !important; }
	body.home-page a:hover, body.home-page a:hover * { color: #ecd17b !important; }
	body.home-page i, body.home-page .icon { color: #3ea3c7 !important; }
</style>
</head>

<body class="home-page" style="background-color:#fff !important; font-family: 'Times New Roman', Times, serif !important;" data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

	<div id="header-wrap" style="background:#fff !important;">
	

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

					<button class="prev slick-arrow">
						<i class="icon icon-arrow-left"></i>
					</button>

					<div class="main-slider pattern-overlay">

						 

					</div><!--slider-->

					<button class="next slick-arrow">
						<i class="icon icon-arrow-right"></i>
					</button>

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
					
					</ul>

					<div class="tab-content">
						<div id="all-genre" data-tab-content class="active">
							<div class="row" id="ebooks-list">
							
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
	


		<script src="js/jquery-1.11.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
				crossorigin="anonymous"></script>
		<script src="js/plugins.js"></script>
		<script src="js/script.js"></script>

		

</body>

</html>