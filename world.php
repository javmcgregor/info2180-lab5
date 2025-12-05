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

<?php if (count($results) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Country Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['continent']) ?></td>
                    <td><?= htmlspecialchars($row['independence_year']) ?></td>
                    <td><?= htmlspecialchars($row['head_of_state']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No matching countries found.</p>
<?php endif; ?>
