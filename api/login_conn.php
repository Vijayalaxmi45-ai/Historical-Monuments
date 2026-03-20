<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserEmail = $_POST['UserEmail'];
    $UserPass = $_POST['UserPass'];

    if (empty($UserEmail) || empty($UserPass)) {
        echo "Please fill in all fields.";
    } else {
        try {
            mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);
            $conn = new mysqli('localhost', 'root', 'root', 'fort_project');
        } catch (Exception $e) {
            echo "<h3>Database Connection Error</h3>";
            echo "<p>Your project is live, but your local XAMPP database is not accessible from Vercel.</p>";
            echo "<p>Please click 'Explore Directly' to see the monuments without logging in.</p>";
            echo "<a href='../FortInfo.html' style='display:inline-block;padding:10px 20px;background:#FFD700;color:#000;text-decoration:none;border-radius:5px;font-weight:bold;'>Explore Directly Now</a>";
            exit();
        }

        if (false) { // Never reached but keeping structure
            die('Connection Failed....Try Again!!' . $conn->connect_error);
        } else {
            // Query to fetch the user based on email
            $stmt = $conn->prepare("SELECT UserPassword FROM registration WHERE UserEmail = ?");
            $stmt->bind_param("s", $UserEmail);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // User exists, fetch password hash
                $user = $result->fetch_assoc();
                $storedPasswordHash = $user['UserPassword'];

                // Verify password
                if (password_verify($UserPass, $storedPasswordHash)) {
                    // Password matches, redirect to the main page
                    header("Location: FortInfo.html");
                    exit();
                } else {
                    echo "Invalid email or password.";
                }
            } else {
                echo "Invalid email or password.";
            }

            $stmt->close();
            $conn->close();
        }
    }
}
?>
