
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="one.css"> <!-- Link to your custom CSS file -->
</head>
<header> <!-- Header section -->
        <div class="container">
            <div class="logo">
                <img src="vaselinelogo.avif" alt="Vaseline Logo"> <!-- Vaseline logo image -->
            </div>
            <nav> 
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
<body>
    <div class="container">
        <h1>View Products</h1>
        <div class="products">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "filee";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$product_number = $_POST['product-number'];
$image = $_FILES['image']['name'];

// Move uploaded file to desired directory
$target_dir = "advertize/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$sql = "INSERT INTO mineinfo (name, description, price, product_number, image) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdss", $name, $description, $price, $product_number, $image);

if ($stmt->execute()) {
    echo "Product added successfully";
} else {
    echo "Error adding product: " . $conn->error;
}

$stmt->close();

// Fetch stored products
$sql_fetch = "SELECT * FROM mineinfo";
$result = $conn->query($sql_fetch);

if ($result->num_rows > 0) {
    // Display products in a table
    echo "<h2>Stored Products</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Product Number</th><th>Image</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["product_number"] . "</td>";
        echo "<td><img src='" . $row["image"] . "' alt='Product Image' style='width: 100px;'></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}

$conn->close();
?>

</div>
<footer> <!-- Footer section -->
        <div class="container">
            <p>&copy; 2024 Vaseline Corporation</p> <!-- Copyright information -->
        </div>
    </footer>

</body>
</html>
