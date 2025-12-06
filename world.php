<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Connect to database
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? "";
$lookup = $_GET['lookup'] ?? "";

// --- Lookup Cities ---
if ($lookup === "cities") {
    $sql = "SELECT cities.name AS city_name, cities.district, cities.population
            FROM cities
            INNER JOIN countries ON cities.country_code = countries.code
            WHERE countries.name LIKE :country
            ORDER BY cities.name ASC";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['country' => "%$country%"]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>District</th>
                        <th>Population</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['city_name']) . "</td>
                    <td>" . htmlspecialchars($row['district']) . "</td>
                    <td>" . htmlspecialchars($row['population']) . "</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No cities found for this country.</p>";
    }

// --- Lookup Countries ---
} else {
    $sql = "SELECT * FROM countries WHERE name LIKE :country";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['country' => "%$country%"]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>
                <thead>
                    <tr>
                        <th>Country Name</th>
                        <th>Continent</th>
                        <th>Independence Year</th>
                        <th>Head of State</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['continent']) . "</td>
                    <td>" . htmlspecialchars($row['independence_year']) . "</td>
                    <td>" . htmlspecialchars($row['head_of_state']) . "</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No matching countries found.</p>";
    }
}
