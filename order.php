<?php
session_start();
include_once('classes/Db.php');
$db = Db::getConnection();

// Check login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$orderSuccess = false;
$orderError = '';
$ebook = null;
$new_balance = null;
if (isset($_GET['ebook_id']) && is_numeric($_GET['ebook_id'])) {
    // Haal eBook info
    $stmt = $db->prepare('SELECT * FROM ebooks WHERE id = ?');
    $stmt->execute([$_GET['ebook_id']]);
    $ebook = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ebook) {
        // Haal user info
        $stmt = $db->prepare('SELECT currency_units FROM users WHERE username = ?');
        $stmt->execute([$_SESSION['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $balance = $user ? (int)$user['currency_units'] : 0;
        $price = (int)$ebook['price'];
        if ($balance >= $price) {
            // Trek prijs af en update saldo
            $new_balance = $balance - $price;
            $stmt = $db->prepare('UPDATE users SET currency_units = ? WHERE username = ?');
            $stmt->execute([$new_balance, $_SESSION['username']]);
            $orderSuccess = true;
        } else {
            $orderError = 'You do not have enough units to order this eBook.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order eBook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body, body * { font-family: 'Times New Roman', Times, serif !important; }
        .order-card { background: #fffbe6; border-radius: 18px; box-shadow: 0 2px 12px rgba(62,163,199,0.08); border: 1px solid #b3e6fb; padding: 2.5rem 2rem 2rem 2rem; margin-top: 60px; }
        .order-card h2 { color: #3ea3c7; font-weight: 700; }
        .ebook-cover { width: 180px; height: 250px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 24px rgba(62,163,199,0.18); background: #fff; padding: 8px; border: 2px solid #6f4929ff; }
    </style>
</head>
<body>
<div class="container" style="max-width:600px;">
    <div class="order-card">
        <h2 class="mb-4 text-center">Order eBook</h2>
        <?php if ($ebook): ?>
            <?php if ($orderSuccess): ?>
                <div class="alert alert-success text-center mb-4">Order successful!<br>Your new balance: <strong><?php echo $new_balance; ?> units</strong></div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-5 text-center">
                        <img src="<?php echo htmlspecialchars($ebook['cover_image']); ?>" alt="Cover" class="ebook-cover mb-3">
                    </div>
                    <div class="col-md-7 text-center">
                        <h4><?php echo htmlspecialchars($ebook['title']); ?></h4>
                        <p style="font-size:1.2rem;"><strong>Price:</strong> <?php echo intval($ebook['price']); ?> units</p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($ebook['category']); ?></p>
                        <a href="ebooks.php" class="btn btn-secondary mt-3">Go back</a>
                    </div>
                </div>
            <?php elseif ($orderError): ?>
                <div class="alert alert-danger text-center mb-4"><?php echo htmlspecialchars($orderError); ?></div>
                <div class="text-center"><a href="ebooks.php" class="btn btn-secondary">Go back</a></div>
            <?php else: ?>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-5 text-center">
                        <img src="<?php echo htmlspecialchars($ebook['cover_image']); ?>" alt="Cover" class="ebook-cover mb-3">
                    </div>
                    <div class="col-md-7 text-center">
                        <h4><?php echo htmlspecialchars($ebook['title']); ?></h4>
                        <p style="font-size:1.2rem;"><strong>Price:</strong> <?php echo intval($ebook['price']); ?> units</p>
                        <form method="get" action="order.php">
                            <input type="hidden" name="ebook_id" value="<?php echo intval($ebook['id']); ?>">
                            <button type="submit" class="btn btn-success mt-3">Confirm Order</button>
                        </form>
                        <a href="ebooks.php" class="btn btn-secondary mt-3">Go back</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-warning text-center">No eBook selected or eBook not found.</div>
            <div class="text-center"><a href="ebooks.php" class="btn btn-secondary">Go back</a></div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
