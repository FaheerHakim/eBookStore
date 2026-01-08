<?php
session_start();
include_once('classes/Db.php');
$db = Db::getConnection();
$is_admin = !empty($_SESSION['is_admin']);

$ebook_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$ebook_id) {
    die('Geen geldig eBook geselecteerd.');
}

// Admin: verwerken van bewerken
$edit_success = '';
if ($is_admin && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_ebook'])) {
    $stmt = $db->prepare("UPDATE ebooks SET title=?, description=?, price=?, category=? WHERE id=?");
    $stmt->execute([
        $_POST['title'] ?? '',
        $_POST['description'] ?? '',
        $_POST['price'] ?? '',
        $_POST['category'] ?? '',
        $ebook_id
    ]);
    $edit_success = "eBook updated successfully!";
}

// Haal eBook info op
$stmt = $db->prepare("SELECT * FROM ebooks WHERE id = ?");
$stmt->execute([$ebook_id]);
$ebook = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$ebook) {
    die('eBook niet gevonden.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>eBook Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body, body * { font-family: 'Times New Roman', Times, serif !important; }
        .ebook-detail-card { background: #fffbe6; border-radius: 18px; box-shadow: 0 2px 12px rgba(62,163,199,0.08); border: 1px solid #b3e6fb; padding: 2.5rem 2rem 2rem 2rem; margin-top: 60px; }
        .ebook-detail-card h2 { color: #3ea3c7; font-weight: 700; }
        .btn-primary { background-color: #b3e6fb !important; border-color: #b3e6fb !important; color: #000 !important; }
        .btn-primary:hover, .btn-primary:focus { background-color: #3ea3c7 !important; border-color: #3ea3c7 !important; color: #fff !important; }
        .ebook-cover { width: 270px; height: 380px; object-fit: cover; border-radius: 16px; box-shadow: 0 4px 24px rgba(62,163,199,0.18); background: #fff; padding: 12px; border: 3px solid #6f4929ff; }
    </style>
</head>
<body>
<div class="container" style="max-width:700px;">
    <div class="ebook-detail-card">
        <h2 class="mb-4 text-center"><?php echo htmlspecialchars($ebook['title']); ?></h2>
        <?php if ($edit_success): ?>
            <div class="alert alert-success text-center"><?php echo $edit_success; ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-5 text-center">
                <img src="<?php echo htmlspecialchars($ebook['cover_image']); ?>" alt="Cover" class="ebook-cover mb-3">
                <a href="ebooks/<?php echo htmlspecialchars($ebook['pdf_path']); ?>" target="_blank" class="btn btn-primary w-100 mb-2">Bekijk/download PDF</a>
            </div>
            <div class="col-md-7">
                <?php if ($is_admin && isset($_GET['edit'])): ?>
                    <!-- Admin edit formulier -->
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($ebook['title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($ebook['description']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" min="0" step="0.01" value="<?php echo htmlspecialchars($ebook['price']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($ebook['category']); ?>" required>
                        </div>
                        <button type="submit" name="edit_ebook" class="btn btn-primary">Save</button>
                        <a href="ebook_detail.php?id=<?php echo $ebook_id; ?>" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                <?php else: ?>
                    <!-- Overzicht -->
                    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($ebook['description'])); ?></p>
                    <p><strong>Price:</strong> units <?php echo number_format($ebook['price'], 2, ',', '.'); ?></p>
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($ebook['category']); ?></p>
                    <p><strong>Added on:</strong> <?php echo htmlspecialchars($ebook['created_at']); ?></p>
                <?php endif; ?>
                <div class="mt-4">
                    <a href="ebooks.php" class="btn btn-secondary">Go back</a>
                    <?php if ($is_admin && !isset($_GET['edit'])): ?>
                        <a href="ebook_detail.php?id=<?php echo $ebook_id; ?>&edit=1" class="btn btn-primary ms-2">Edit</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>