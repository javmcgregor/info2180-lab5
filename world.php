<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Connect to database
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Read GET variable
$country = $_GET['country'] ?? "";

// Prepare SQL query
$sql = "SELECT * FROM countries WHERE name LIKE :country";
$stmt = $conn->prepare($sql);
$stmt->execute(['country' => "%$country%"]);

// Fetch results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<ul>
<?php if (count($results) > 0): ?>
    <?php foreach ($results as $row): ?>
        <li>
            <?= htmlspecialchars($row['name']) ?> 
            is ruled by 
            <?= htmlspecialchars($row['head_of_state']) ?>
        </li>
    <?php endforeach; ?>
<?php else: ?>
    <li>No matching countries found.</li>
<?php endif; ?>
</ul>
