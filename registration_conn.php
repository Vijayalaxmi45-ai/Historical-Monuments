<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $Usename = $_POST['Usename'];
    $UserMob = $_POST['UserMob'];
    $UserEmail = $_POST['UserEmail'];
    $UserAddres = $_POST['UserAddres'];
    $UserPassword = $_POST['UserPassword'];

    if (empty($Usename) || empty($UserMob) || empty($UserEmail) || empty($UserAddres) || empty($UserPassword)) {
        echo "Please fill in all fields.";
    } else {
        
        // Hash the password before saving it
        $hashedPassword = password_hash($UserPassword, PASSWORD_DEFAULT);

        $conn = new mysqli('localhost', 'root', '', 'fort_project');

        if ($conn->connect_error) {
            die('Connection Failed....Try Again!!' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO registration (Username, UserMob, UserEmail, UserAddres, UserPassword) VALUES (?, ?, ?, ?, ?)");
            
            if ($stmt === false) {
                die('MySQL prepare error: ' . $conn->error);
            } else {
                $stmt->bind_param("sssss", $Usename, $UserMob, $UserEmail, $UserAddres, $hashedPassword); 
              
                if ($stmt->execute()) {
                    header("Location: login_page.html");
                    exit(); 
                } else {
                    echo "Error: " . $stmt->error;
                } 
                $stmt->close();
                $conn->close();
            }
        }
    }
}
?>
