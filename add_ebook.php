<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add eBook</title>
</head>
<body>
    
<form action="add_ebook.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="author" placeholder="Author">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="file" name="ebook_file" accept=".pdf" required>
    <input type="file" name="cover_image" accept="image/*">
    <button type="submit">Add eBook</button>
</form>
    
</body>
</html>