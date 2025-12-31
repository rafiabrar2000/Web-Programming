<?php
if (isset($_POST['query'])) {
    $search = $_POST['query'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sample";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn2 = $conn;

    // Check connection - conn
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Check connection - conn2
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }

    // Search query table 1
    $sql = "SELECT * FROM items WHERE name LIKE '%$search%' or id LIKE '%$search%'";
    $result = $conn->query($sql);

    echo "<p class=\"category-text\">Search results in Marketplace (Job) ------------------------------------------------</p>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<a href=\"http://google.com\" target=\"blank\" class=\"search-result-text\">" . $row['name'] . "</a>";
        }
    } else {
        echo "<p class=\"search-result-text\">No search results found.</p>";
    }

    // Search query table 2
    $sql1 = "SELECT * FROM vegetables WHERE name LIKE '%$search%' or id LIKE '%$search%'";
    $result1 = $conn->query($sql1);

    echo "<p class=\"category-text\">Search results in Marketplace (Contest) --------------------------------------------</p>";
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            echo "<a class=\"search-result-text\">" . $row1['name'] . "</a>";
        }
    } else {
        echo "<p class=\"search-result-text\">No search results found.</p>";
    }

    $conn->close();
} else if (isset($_POST['submit'])) {
    $search = $_POST['search'];

    // Search query
    $sql = "SELECT * FROM items WHERE name LIKE '%$search%' or id LIKE '%$search%'";
    $temp_result = $conn2->query($sql);

    $sql1 = "SELECT * FROM vegetables WHERE name LIKE '%$search%' or id LIKE '%$search%'";
    $temp_result1 = $conn2->query($sql1);

    $results = [];

    if ($temp_result->num_rows > 0) {
        while ($row = $temp_result->fetch_assoc()) {
            $results[] = $row;
        }
    }

    if ($temp_result1->num_rows > 0) {
        while ($row = $temp_result1->fetch_assoc()) {
            $results[] = $row;
        }
    }

    $conn2->close();

    // Redirect back to index.php with search results
    header('Location: index.php?results=' . base64_encode(serialize($results)));
} else {
    header('Location: index.php');
}