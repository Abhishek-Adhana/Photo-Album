<?php
// Get all image files from the images directory
$imageDirectory = 'images/';
$images = array_diff(scandir($imageDirectory), array('..', '.')); // Get images from the directory

// Pagination settings
$imagesPerPage = 3;
$totalImages = count($images);
$totalPages = ceil($totalImages / $imagesPerPage);

// Get current page from query parameters, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($page - 1) * $imagesPerPage;

// Slice the images array for current page
$imagesOnPage = array_slice($images, $startIndex, $imagesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Album</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="album-container">
        <?php if (count($imagesOnPage) > 0): ?>
            <div class="main-image">
                <img src="<?= $imageDirectory . $imagesOnPage[0]; ?>" alt="Main Image">
            </div>
            <div class="small-images">
                <?php for ($i = 1; $i < count($imagesOnPage); $i++): ?>
                    <img src="<?= $imageDirectory . $imagesOnPage[$i]; ?>" alt="Small Image <?= $i; ?>">
                <?php endfor; ?>
            </div>
        <?php else: ?>
            <p>No images available.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination Links -->
    <div class="pagination">
        <!-- Previous Button - Visible but disabled on the first page -->
        <a href="?page=<?= $page > 1 ? $page - 1 : 1; ?>" class="prev <?= $page == 1 ? 'disabled' : ''; ?>">Previous</a>

        <span>Page <?= $page; ?> of <?= $totalPages; ?></span>

        <!-- Next Button -->
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1; ?>" class="next">Next</a>
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
