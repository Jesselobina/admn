<?php
// --- Database Configuration & Connection ---
$host = 'localhost';
$port = '3306';
$user = 'root';
$pass = '';
$dbname = 'logisticdb'; // Main database for users

try {
    // This line creates the $pdo variable that everything else needs.
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// --- Session & Authentication Check ---
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// This logic prevents redirect loops on public pages like login.php
if (!isset($is_public_page) || $is_public_page !== true) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /alex/login.php");
        exit;
    }
}
?>