<?php
// Database installation script
$host = 'localhost';
$port = '3306';
$user = 'root';
$pass = '';

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MerchFlow Pro - Installation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">MerchFlow Pro Installation</h1>
            <p class="text-gray-600">Setting up your logistics management system</p>
        </div>';

try {
    $pdo = new PDO("mysql:host=$host;port=$port", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo '<div class="bg-white rounded-lg shadow-lg p-6 mb-6">';
    
    // Read and execute all SQL files
    $sqlFiles = [
        'sql/logistic_db.sql' => 'Main Database',
        'sql/logistic_smart_warehousing.sql' => 'Smart Warehousing',
        'sql/logistic_procurement_sourcing.sql' => 'Procurement & Sourcing',
        'sql/logistic_project_logistic_tracker.sql' => 'Project Tracker',
        'sql/logistic_asset_lifecycle_maintenance.sql' => 'Asset Management',
        'sql/logistic_document_tracking_logistic_record.sql' => 'Document Tracking'
    ];
    
    foreach ($sqlFiles as $file => $name) {
        if (file_exists($file)) {
            $sql = file_get_contents($file);
            $pdo->exec($sql);
            echo "<div class='flex items-center p-3 mb-2 bg-green-50 text-green-700 rounded-lg'>
                    <i class='fas fa-check-circle mr-3 text-green-500'></i>
                    <div>
                        <div class='font-semibold'>✅ Created: $name</div>
                        <div class='text-sm text-green-600'>Database initialized successfully</div>
                    </div>
                  </div>";
        } else {
            echo "<div class='flex items-center p-3 mb-2 bg-red-50 text-red-700 rounded-lg'>
                    <i class='fas fa-exclamation-circle mr-3 text-red-500'></i>
                    <div>
                        <div class='font-semibold'>❌ Missing: $file</div>
                        <div class='text-sm text-red-600'>Required database file not found</div>
                    </div>
                  </div>";
        }
    }
    
    echo '</div>';
    
    echo '<div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-500 text-xl mr-3"></i>
                <div>
                    <h3 class="font-semibold text-blue-900 text-lg">Installation Complete!</h3>
                    <p class="text-blue-700 mt-1">Your MerchFlow Pro system is ready to use.</p>
                </div>
            </div>
          </div>';
    
    echo '<div class="bg-green-50 border border-green-200 rounded-lg p-6">
            <h3 class="font-semibold text-green-900 text-lg mb-3">Login Credentials</h3>
            <div class="space-y-2">
                <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                    <span class="font-medium">Admin Email:</span>
                    <code class="bg-gray-100 px-2 py-1 rounded">admin@merchflow.com</code>
                </div>
                <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                    <span class="font-medium">Admin Password:</span>
                    <code class="bg-gray-100 px-2 py-1 rounded">password</code>
                </div>
            </div>
            <div class="mt-4 text-center">
                <a href="login.php" class="inline-block bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition-colors">
                    <i class="fas fa-sign-in-alt mr-2"></i>Go to Login Page
                </a>
            </div>
          </div>';
    
} catch(PDOException $e) {
    echo "<div class='bg-red-50 border border-red-200 rounded-lg p-6'>
            <div class='flex items-center'>
                <i class='fas fa-exclamation-triangle text-red-500 text-xl mr-3'></i>
                <div>
                    <h3 class='font-semibold text-red-900 text-lg'>Installation Failed</h3>
                    <p class='text-red-700 mt-1'>Error: " . $e->getMessage() . "</p>
                </div>
            </div>
          </div>";
}

echo '</div></body></html>';
?>