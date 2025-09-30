<?php
$page_title = "Smart Warehousing";
require_once '../includes/config.php';
require_once '../includes/auth.php';
$auth->redirectIfNotLoggedIn();

// Get current page from URL, default to 'inventory'
$page = $_GET['page'] ?? 'inventory';

// Connect to the module-specific database
$pdo = get_pdo_connection(DB_NAME_WAREHOUSE);
?>

<?php include '../includes/header.php'; ?>

<div class="flex min-h-screen">
    <?php include '../includes/sidebar.php'; ?>

    <main class="flex-1 p-6">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
             <h1 class="text-2xl font-bold text-gray-800 mb-4">Smart Warehousing</h1>
            <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg w-fit">
                <a href="?page=inventory" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'inventory' ? 'bg-red-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">
                    Inventory Management
                </a>
                <a href="?page=storage" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'storage' ? 'bg-red-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">
                    Storage Optimization
                </a>
                <a href="?page=tracking" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'tracking' ? 'bg-red-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">
                    Real-time Tracking
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 animate-fadeUp">
            <?php
            // Include the appropriate sub-module view
            $submodule_path = __DIR__ . "/warehousing/{$page}.php";
            if (file_exists($submodule_path)) {
                include $submodule_path;
            } else {
                echo '<div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Page Not Found</h3>
                        <p class="text-gray-600">The requested sub-module does not exist.</p>
                      </div>';
            }
            ?>
        </div>
    </main>
</div> <?php include '../includes/footer.php'; ?>