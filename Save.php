<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "filee";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if image file is selected
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_type = $_FILES['image']['type'];
    
    // Move uploaded image to a designated folder
    $upload_dir = "advertize";
    $target_file = $upload_dir . basename($image_name);
    move_uploaded_file($image_tmp_name, $target_file);

    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $productNumber = $_POST['product-number'];

    // Prepare and execute the INSERT statement
    $sql = "INSERT INTO mineinfo (name, description, price, product_number, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
    }

    $stmt->bind_param("ssdss", $name, $description, $price, $productNumber, $target_file);

    if ($stmt->execute()) {
        echo "Records inserted successfully";
    }
    else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error uploading image.";
}

$conn->close();
?>
