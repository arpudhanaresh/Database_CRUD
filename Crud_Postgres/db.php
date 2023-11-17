<?php
$host = "localhost";
$dbname = "naresh";
$username = "datab";
$password = "datab";

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>
