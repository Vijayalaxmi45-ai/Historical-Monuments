<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Only expect the fields currently present in the form
    $Username = isset($_POST['Username']) ? trim($_POST['Username']) : '';
    $UserEmail = isset($_POST['UserEmail']) ? trim($_POST['UserEmail']) : '';
    $UserPassword = isset($_POST['UserPassword']) ? $_POST['UserPassword'] : '';

    if (empty($Username) || empty($UserEmail) || empty($UserPassword)) {
        echo "Please fill in all required fields (Name, Email, Password).";
    } else {
        $hashedPassword = password_hash($UserPassword, PASSWORD_DEFAULT);

        try {
            $conn = new mysqli('localhost', 'root', 'root', 'fort_project');
            if ($conn->connect_error) {
                throw new Exception('Connection Failed: ' . $conn->connect_error);
            }
        } catch (Exception $e) {
            echo "<h3>Database Connection Error</h3>";
            echo "<p>Your project is live, but your local XAMPP database is not accessible from Vercel.</p>";
            echo "<p>Please click 'Explore Directly' to see the monuments without logging in.</p>";
            echo "<a href='../FortInfo.html' style='display:inline-block;padding:10px 20px;background:#FFD700;color:#000;text-decoration:none;border-radius:5px;font-weight:bold;'>Explore Directly Now</a>";
            exit();
        }

        // DB insertion disabled by default (safer for local testing without DB).
        // If you want to enable insertion, remove the following comment and adjust DB credentials and table.
        /*
        $stmt = $conn->prepare("INSERT INTO registration (Username, UserEmail, UserPassword) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die('MySQL prepare error: ' . $conn->error);
        }
        $stmt->bind_param("sss", $Username, $UserEmail, $hashedPassword);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: ../login_page.html");
            exit();
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
        */
    }
}
ob_end_flush();
?>
