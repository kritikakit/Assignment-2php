<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace with your authentication logic
    if ($username === "Kriti" && $password === "1234") {
        $_SESSION['loggedin'] = true;
        header("Location: AddProduct.html");
        exit();
    } else {
        echo "Invalid username or password entered";
    }
}
?>
