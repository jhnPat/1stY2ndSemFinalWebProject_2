<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login & Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #4caf50;
            text-decoration: none;
        }
    </style>


</head>

<body>
    <h2>User Registration</h2>

    <?php
    include 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        // Handle image upload
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Specify the correct path to the "uploads" directory
        $uploadsDirectory = __DIR__ . '/uploads/';
        move_uploaded_file($image_tmp, $uploadsDirectory . $image);

        // Get the total number of registered rows
        $result = mysqli_query($con, "SELECT COUNT(*) as total FROM repairshops");
        $row = mysqli_fetch_assoc($result);
        $totalRows = $row['total'];

        // Increment the 'ID'
        $nextID = $totalRows + 1;

        // Insert data into the database with the incremented 'ID'
        $sql = "INSERT INTO repairshops (ID, Name, Address, Contact_No, Image) 
                VALUES ('$nextID', '$name', '$address', '$contact', '$image')";

        if (mysqli_query($con, $sql)) {
            echo "<p>Registration successful!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($con) . "</p>";
        }
    }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="contact">Contact No.:</label>
        <input type="text" id="contact" name="contact" required><br>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <button type="submit" name="submit">Register</button>
    </form>
    <a href="RepairShop.php">Back!</a>

</body>

</html>