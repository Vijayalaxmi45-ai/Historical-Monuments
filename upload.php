<?php
if (isset($_POST['submit'])) {
    // Get the image file and heading
    $image = $_FILES['image'];
    $heading = $_POST['heading'];

    // Define the target directory for storing the image
    $target_dir = "img/"; // Changed to "img/" folder
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the uploaded file is an actual image
    if (getimagesize($image["tmp_name"]) === false) {
        echo "File is not an image.";
        exit();
    }

    // Check if the file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        exit();
    }

    // Check file size (limit to 5MB)
    if ($image["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        exit();
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        // Redirect back to the admin panel with success status
        header("Location: index.php?status=success&image=" . urlencode($image["name"]));
        exit();
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit();
    }
}
?>
