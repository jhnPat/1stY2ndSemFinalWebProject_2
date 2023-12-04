<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Shop Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            padding: 20px 20px;
            margin: 20px auto;
            max-width: 800px;
            max-height: auto;
        }

        img {
            max-width: 500px;
            height: auto;
            margin-bottom: 20px;
        }

        .info {
            flex: 1;
            text-align: left;
            width: 100%;
        }

        p {
            color: #333;
            margin: 10px 0;
        }

        .ratings {
            text-align: left;
            margin-top: 10px;
        }

        .rating-stars {
            display: flex;
            align-items: center;
        }

        .star {
            color: #ffd700;
            font-size: 20px;
            margin-right: 5px;
        }

        .feedback-container {
            margin-top: 20px;
            text-align: left;
            width: 100%;
        }

        .user-feedback {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .overall-rating {
            margin-top: 20px;
        }

        a {
            display: block;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    include 'connect.php';

    $data = $_GET['data'];
    $sql = "SELECT * FROM repairshops WHERE id=$data";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "<div class='container'>";
        echo "<img src='uploads/" . $row['Image'] . "' alt='Uploaded Image'>";
        echo "<div class='info'>";
        echo "<p>Name: " . $row['Name'] . "</p>";
        echo "<p>Address: " . $row['Address'] . "</p>";
        echo "<p>Contact No: " . $row['Contact_No'] . "</p>";

        // 5-Star Ratings
        echo "<div class='ratings'>";
        echo "<p>Rating: </p>";
        $rating = $row['Rating'];
        echo "<div class='rating-stars'>";
        for ($i = 1; $i <= 5; $i++) {
            echo "<span class='star " . ($i <= $rating ? 'rated' : '') . "'>&#9733;</span>";
        }
        echo "</div>";
        echo "</div>"; // Close ratings div
    
        echo "</div>"; // Close info div
    
        // User Feedback
        echo "<div class='feedback-container'>";
        echo "<h3>User Feedback</h3>";
        echo "<div class='user-feedback'>" . nl2br($row['User_Feedback']) . "</div>";
        echo "</div>"; // Close feedback-container div
    
        // Overall Rating
        echo "<div class='overall-rating'>";
        echo "<p>Overall Rating: ";
        if ($row['Total_Accounts'] > 0) {
            $overallRating = $row['Rating'] / ($row['Total_Accounts'] * 5) * 5;
            echo number_format($overallRating, 2) . " / 5";
        } else {
            echo "N/A";
        }
        echo "</p>";
        echo "</div>"; // Close overall-rating div
    
        echo "</div>"; // Close container div
    }
    ?>

    <a href="RepairShop.php">Back to Repair Shops</a>
</body>

</html>