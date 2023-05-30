<?php
// Database connection details
$servername = "localhost";
$username = "raynex";
$password = "testdaw0@";
$dbname = "voyage";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to retrieve data from the database
function retrieveData() {
    global $conn;

    // SQL query to fetch data from a table
    $sql = "SELECT * FROM your_table";
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output the data in an HTML table
        echo "<table>";
        echo "<tr><th>Column 1</th><th>Column 2</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["column1"] . "</td>";
            echo "<td>" . $row["column2"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }

    // Close the database connection
    $conn->close();
}

// Call the retrieveData() function to display the data
retrieveData();
?>
