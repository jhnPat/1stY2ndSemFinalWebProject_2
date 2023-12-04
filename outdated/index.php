<?php
// Assuming you have a database connection here

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $search = $_GET["search"];

    // Perform a database query based on the provided context
    $sql = "SELECT * FROM users WHERE context LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Display the results
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>{$row['name']} - {$row['email']} - {$row['context']}</p>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>