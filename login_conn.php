<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserEmail = $_POST['UserEmail'];
    $UserPass = $_POST['UserPass'];

    if (empty($UserEmail) || empty($UserPass)) {
        echo "Please fill in all fields.";
    } else {
        $conn = new mysqli('localhost', 'root', '', 'fort_project');

        if ($conn->connect_error) {
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
