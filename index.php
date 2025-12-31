<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searchbar</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div style="position: relative;">
        <form action="search.php" method="POST" class="input-search-container">
            <input type="text" name="search" id="search" class="search-input"
                placeholder="Search by Title, Company or any jobs keyword" required>

            <div class="search-container">
                <button type="submit" name="submit" class="search-button">Search</button>
                <img src="styles/search.png" class="search-icon">
            </div>
        </form>
        <div id="suggestion-container" class="suggestion-container"></div>
        <!-- Receiving Results from search.php -->
        <!-- <?php
        if (isset($_GET['results'])) {
            $results = unserialize(base64_decode($_GET['results']));
            echo "<p class=\"search-results\">Search Results:</p>";
            echo "<ul>";
            foreach ($results as $index) {
                echo "<li>" . htmlspecialchars($index['name']) . "</li>";
            }
            echo "</ul>";
        }
        ?> -->
        <script src="extra-files/autocomplete.js"></script>
    </div>
</body>

</html>