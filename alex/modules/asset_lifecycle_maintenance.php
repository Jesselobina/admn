<?php
$page_title = "Asset Management";
require_once '../includes/config.php';
require_once '../includes/auth.php';
$auth->redirectIfNotLoggedIn();

$page = $_GET['page'] ?? 'register';
$pdo = get_pdo_connection(DB_NAME_ASSET);
?>

<?php include '../includes/header.php'; ?>

<div class="flex min-h-screen">
    <?php include '../includes/sidebar.php'; ?>

    <main class="flex-1 p-6">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Asset Lifecycle Management</h1>
            <div class="flex flex-wrap gap-1 bg-gray-100 p-1 rounded-lg w-fit">
                <a href="?page=register" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'register' ? 'bg-purple-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">Asset Register</a>
                <a href="?page=maintenance" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'maintenance' ? 'bg-purple-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">Maintenance</a>
                <a href="?page=lifecycle" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'lifecycle' ? 'bg-purple-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">Lifecycle Tracking</a>
                <a href="?page=depreciation" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'depreciation' ? 'bg-purple-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">Depreciation</a>
                <a href="?page=reports" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'reports' ? 'bg-purple-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">Reports</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 animate-fadeUp">
            <?php
            $submodule_path = __DIR__ . "/asset/{$page}.php";
            if (file_exists($submodule_path)) {
                include $submodule_path;
            } else {
                echo '<div class="text-center py-8"><i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i><h3 class="text-xl font-semibold">Page Not Found</h3></div>';
            }
            ?>
        </div>
    </main>
</div>

<?php include '../includes/footer.php'; ?>