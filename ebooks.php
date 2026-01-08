<?php
session_start();
include_once('classes/Db.php');
$db = Db::getConnection();
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
   .search-box {
	   position: relative;
   }
   .search-box .form-control {
	   height: 48px;
	   padding-left: 2.2rem !important;
   }
   .search-box .search-icon {
	   position: absolute;
	   left: 16px;
	   top: 0;
	   height: 100%;
	   display: flex;
	   align-items: center;
	   color: #3ea3c7;
	   font-size: 1.3rem;
	   pointer-events: none;
   }
		
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

	   /* Custom search bar styling */
	   .search-box .form-control {
		   border-radius: 10px 0 0 10px !important;
		   border: 2px solid #b3e6fb !important;
		   background: #fffbe6 !important;
		   color: #000 !important;
		   box-shadow: none;
		   font-size: 1.1rem;
	   }
	   .search-box .form-control:focus {
		   border-color: #3ea3c7 !important;
		   background: #fff !important;
		   color: #000 !important;
		   box-shadow: 0 0 0 2px #b3e6fb33;
	   }
	   .search-box .btn-primary {
		   border-radius: 0 10px 10px 0 !important;
		   background-color: #b3e6fb !important;
		   border-color: #b3e6fb !important;
		   color: #000 !important;
		   font-weight: 600;
		   transition: background 0.2s, color 0.2s;
	   }
	   .search-box .btn-primary:hover, .search-box .btn-primary:focus {
		   background-color: #3ea3c7 !important;
		   border-color: #3ea3c7 !important;
		   color: #fff !important;
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
										<li><a class="dropdown-item" href="profile.php">Profile</a></li>
										<li><a class="dropdown-item" href="change_password.php">Reset Password</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
									</ul>
								</div>
							<?php else: ?>
								<a href="#" class="user-account for-buy"><i class="icon icon-user"></i><span>Account</span></a>
							<?php endif; ?>
							<?php
							// Toon totaal uitgegeven units aan bestelde eBooks
							$total_spent = 0;
							if (isset($_SESSION['username'])) {
								require_once 'classes/Db.php';
								$db = Db::getConnection();
								$stmt = $db->prepare('SELECT SUM(total) as total_spent FROM orders o JOIN users u ON o.user_id = u.id WHERE u.username = ?');
								$stmt->execute([$_SESSION['username']]);
								$row = $stmt->fetch(PDO::FETCH_ASSOC);
								if ($row && $row['total_spent'] !== null) {
									$total_spent = (int)$row['total_spent'];
								}
							}
							?>
							<a href="#" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart:(<?php echo $total_spent; ?> units spent)</span></a>
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
				   <div class="row mb-4 align-items-center">
					   <div class="col-md-6 d-flex align-items-center">
						   <?php if ($is_admin): ?>
							   <a href="add_ebook.php" class="btn btn-primary add-btn-custom me-2" style="width:220px;border-radius:10px;background-color:#b3e6fb !important;border-color:#b3e6fb !important;color:#000 !important;font-weight:600;">Add eBook</a>
						   <?php endif; ?>
					   </div>
					   <div class="col-md-6 d-flex justify-content-end align-items-center">
						   <form role="search" method="get" class="search-box ms-auto d-flex position-relative" action="ebooks.php" style="width:100%;max-width:400px; top: 40px;">
							   <input class="form-control ps-5" placeholder="Search by title..." type="search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="border-radius:10px !important;">
							   <span class="search-icon" style="position:absolute; left:10px; top:35%; transform:translateY(-50%); color:#3ea3c7;font-size:1.3rem;pointer-events:none;">
								   <i class="icon icon-search"></i>
							   </span>
						   </form>
					   </div>
				   </div>

					<div class="tab-content">
						<div id="all-genre" data-tab-content class="active">
							<?php
							 $categoryFilter = $selectedCategory;
							 $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
							 if ($categoryFilter === 'all') {
								 if ($searchTerm !== '') {
									 $statement = $db->prepare('SELECT * FROM ebooks WHERE title LIKE ? ORDER BY id DESC LIMIT 10');
									 $statement->execute(['%' . $searchTerm . '%']);
								 } else {
									 $statement = $db->query('SELECT * FROM ebooks ORDER BY id DESC LIMIT 10');
								 }
							 } else {
								 if ($searchTerm !== '') {
									 $statement = $db->prepare('SELECT * FROM ebooks WHERE category = ? AND title LIKE ? ORDER BY id DESC LIMIT 10');
									 $statement->execute([$categoryFilter, '%' . $searchTerm . '%']);
								 } else {
									 $statement = $db->prepare('SELECT * FROM ebooks WHERE category = ? ORDER BY id DESC LIMIT 10');
									 $statement->execute([$categoryFilter]);
								 }
							 }
							$ebooks = $statement->fetchAll(PDO::FETCH_ASSOC);
							if (!empty($ebooks)) {
								echo '<div class="row" id="ebooks-list">';
								foreach ($ebooks as $ebook) {
									echo '<div class="col-md-3">';
									echo '<div class="product-item">';
									echo '<figure class="product-style">';
						echo '<img src="'.htmlspecialchars($ebook['cover_image']).'" alt="'.htmlspecialchars($ebook['title']).'" class="product-item" style="width:270px;height:380px;object-fit:cover;border-radius:16px;box-shadow:0 4px 24px rgba(62,163,199,0.18);background:#fff;padding:12px;border:3px solid #6f4929ff;">';
							echo '<div class="d-flex justify-content-between align-items-center" style="margin-top:10px;">';
							if ($is_admin) {
								echo '<button type="button" class="btn btn-primary ebook-delete-btn" data-id="'.htmlspecialchars($ebook['id']).'" style="border-radius:10px;background-color:#ecd17b !important;border-color:#ecd17b !important;color:#000 !important;">Delete</button>';
								echo '<a href="ebook_detail.php?id='.htmlspecialchars($ebook['id']).'" target="_blank" style="text-decoration:underline;color:#3ea3c7;">See more</a>';
							} else {
								echo '<a href="ebook_detail.php?id='.htmlspecialchars($ebook['id']).'" target="_blank" style="text-decoration:underline;color:#3ea3c7;">See more</a>';
								echo '<form method="post" action="order.php" style="display:inline;">';
								echo '<input type="hidden" name="ebook_id" value="'.htmlspecialchars($ebook['id']).'">';
								echo '<input type="hidden" name="redirect" value="profile.php">';
								echo '<button type="submit" class="btn btn-primary ebook-btn ms-2" style="width:44px;height:44px;border-radius:10px;background-color:#b3e6fb !important;border-color:#b3e6fb !important;color:#000 !important;display:inline-flex;align-items:center;justify-content:center;" title="Order eBook"><i class="icon icon-clipboard"></i></button>';
								echo '</form>';
							}
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
    

	<footer class="custom-footer">
  <div class="container text-center py-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h4 class="footer-title mb-3">eBookStore &copy; 2026</h4>
        <p class="footer-text mb-2">Thank you for visiting our website. Enjoy reading!</p>
        <div class="footer-social mb-2">
          <a href="#" class="me-2"><i class="icon icon-facebook"></i></a>
          <a href="#" class="me-2"><i class="icon icon-twitter"></i></a>
          <a href="#" class="me-2"><i class="icon icon-youtube-play"></i></a>
          <a href="#"><i class="icon icon-behance-square"></i></a>
        </div>
        <div class="footer-contact">
          <span>Email: <a href="mailto:info@ebookstore.com">zaidsoufi@hotmail.com</a></span>
        </div>
      </div>
    </div>
  </div>
</footer>
<style>
/* Footer kleuren consistent met site */
	.custom-footer {
		background: #EDEBE4;
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
  $('.ebook-delete-btn').on('click', function() {
    if(confirm('Are you sure you want to delete this eBook?')) {
      var ebookId = $(this).data('id');
      $.post('delete_ebook.php', {id: ebookId}, function(response) {
        if($.trim(response) === 'success') {
          location.reload();
        } else {
          alert('Delete failed: ' + response);
        }
      });
    }
  });
});
</script>
</body>
</html>