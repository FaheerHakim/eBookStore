<?php
session_start();
include_once(__DIR__ . '/classes/User.php');

if(!empty($_POST)) {

    $register_Error = null;

    try{
        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->save();
    }
    catch (Exception $e){
        $register_Error = $e->getMessage();
}
}
    $users = User::getAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up - eBookStore</title>
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
    body.register-page {
        min-height: 100vh;
    }
    body.register-page, body.register-page * { color: #000 !important; }
    body.register-page a, body.register-page a * { color: #000 !important; }
    body.register-page a:hover, body.register-page a:hover * { color: #ecd17b !important; }
    body.register-page i, body.register-page .icon { color: #3ea3c7 !important; }
    .register-page .btn-success {
        background-color: #b3e6fb !important;
        border-color: #b3e6fb !important;
        color: #000 !important;
    }
    .register-page .btn-success:hover, .register-page .btn-success:focus {
        background-color: #b3e6fb !important;
        border-color: #b3e6fb !important;
        color: #000 !important;
    }
</style>
</head>
<body class="register-page" style="background-color:#fff !important;" data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <?php if (isset($register_Error) && $register_Error): ?>
        <div class="alert alert-danger text-center"><?php echo htmlspecialchars($register_Error); ?></div>
    <?php endif; ?>

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
                                        <li><a class="dropdown-item" href="logout.php">Log out</a></li>
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

    <main>
        <section class="d-flex align-items-center justify-content-center" style="min-height:60vh;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="card shadow p-4">
                             <h2 class="mb-4 text-center">Sign Up</h2>
                           
                            <!-- Stap 1: Gebruiker vult het formulier in -->
                            <form action="register.php" method="post">
                                <div class="mb-3">
                                    <label for="new_username" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_email" class="form-label">E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" name="register_submit" class="btn btn-success">Sign Up</button>
                                </div>
                                  <div class="text-center mt-3">
                                    <a href="login.php" class="text-decoration-underline">Already have an account? Log in</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>

</body>
</html>