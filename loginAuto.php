<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = $_POST['myusername'];
    $mypassword = $_POST['mypassword'];

    $conn = new mysqli("localhost", "root", "", "hotel");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT username FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $myusername, $mypassword);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['login_user'] = $myusername;
        header("location: adminMenu.php");
        exit();
    } else {
        echo "Wrong Username or Password. Please try again.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Please submit the form properly.";
}
?>