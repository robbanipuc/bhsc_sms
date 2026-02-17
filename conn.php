<?php

//$conn = mysqli_connect('localhost','root','','bhsc_sms');

<?php
// db.php or config.php or database.php

$host     = getenv('DB_HOST');
$dbname   = getenv('DB_NAME');
$username = getenv('DB_USER');   // remember: prefix.username format
$password = getenv('DB_PASSWORD');

// ✅ New connection (TiDB Cloud)
try {
    $pdo = new PDO(
        "mysql:host=$host;port=4000;dbname=$dbname;sslmode=verify-ca",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    echo "Connected successfully!"; // remove after testing
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


?>