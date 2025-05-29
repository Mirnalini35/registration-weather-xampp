<?php
session_start();
$servername = "localhost";
$username = "root"; // Update if needed
$password = "";
$dbname = "googleform";

// Create a connection
$conn = new mysqli('localhost', 'root', '','googleform');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["email"]) || !isset($_POST["password"])) {
        die("Email or password not provided.");
    }

    $email = $_POST["email"];
    $pass = $_POST["password"];

    // Use a prepared statement for security
    $sql = $conn->prepare("SELECT * FROM details WHERE email='user@example.com'");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($pass, $row["password"])) {
            $_SESSION["email"] = $email; // Store email instead of username
            echo "Login successful! Welcome.";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    $sql->close();
}

$conn->close();
?>
