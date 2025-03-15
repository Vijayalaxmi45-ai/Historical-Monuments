<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            color: white;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex; /* Use flexbox to center the content */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Make sure the body takes full viewport height */
        }

        .container {
            padding: 20px;
            background-color: black;
            width: 30%;
            height: auto; /* Adjust height based on content */
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3); /* Optional: Add shadow for better visibility */
        }

        h1 {
            color: gold;
            text-align: center;
        }

        label {
            font-size: 18px;
            color:gold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"], input[type="file"], textarea, button {
            width: 96%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }

        textarea {
            height: 150px; /* Set a specific height for the textarea */
            resize: vertical; /* Allows users to resize the textarea vertically */
        }

        button {
            background-color: green;
            color: white;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: darkgreen;
        }

        .uploaded-image {
            margin-top: 20px;
            text-align: center;
        }

        .uploaded-image img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="image">Upload Image</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <label for="heading">Heading of the Monument</label>
            <input type="text" id="heading" name="heading" required>

            <label for="description">Description of the Monument</label>
            <textarea id="description" name="description" required></textarea>

            <button type="submit" name="submit">Upload</button>
        </form>

        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
            echo "<div class='uploaded-image'>";
            echo "<h2>Uploaded Image:</h2>";
            echo "<img src='img/" . $_GET['image'] . "' alt='Historical Monument'>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
