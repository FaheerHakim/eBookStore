<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add eBook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, body * { font-family: 'Times New Roman', Times, serif !important; }
        .add-ebook-card { background: #fffbe6; border-radius: 18px; box-shadow: 0 2px 12px rgba(62,163,199,0.08); border: 1px solid #b3e6fb; padding: 2.5rem 2rem 2rem 2rem; margin-top: 60px; }
        .add-ebook-card h2 { color: #3ea3c7; font-weight: 700; }
        .btn-primary { background-color: #b3e6fb !important; border-color: #b3e6fb !important; color: #000 !important; }
        .btn-primary:hover, .btn-primary:focus { background-color: #3ea3c7 !important; border-color: #3ea3c7 !important; color: #fff !important; }
    </style>
</head>
<body>
 <div class="container" style="max-width:500px;">
        <div class="add-ebook-card">
            <h2 class="mb-4 text-center">Add eBook</h2>
            
            <form method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price (in units)</label>
                    <input type="number" id="price" name="price" class="form-control" min="0" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" id="category" name="category" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="cover_image" class="form-label">Image cover</label>
                    <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="pdf_file" class="form-label">eBook PDF</label>
                    <input type="file" id="pdf_file" name="pdf_file" class="form-control" accept="application/pdf" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Insert</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <a href="home.php">Back to home</a>
            </div>
        </div>
    </div>
</body>
</html>