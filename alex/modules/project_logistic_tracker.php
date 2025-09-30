<?php
$page_title = "Project Logistic Tracker";
require_once '../includes/config.php';
require_once '../includes/auth.php';
$auth->redirectIfNotLoggedIn();

$page = $_GET['page'] ?? 'projects';
$pdo = get_pdo_connection(DB_NAME_PROJECT);
?>

<?php include '../includes/header.php'; ?>

<div class="flex min-h-screen">
    <?php include '../includes/sidebar.php'; ?>

    <main class="flex-1 p-6">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
             <h1 class="text-2xl font-bold text-gray-800 mb-4">Project Logistic Tracker</h1>
            <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg w-fit">
                <a href="?page=projects" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'projects' ? 'bg-green-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">
                    Project Management
                </a>
                <a href="?page=shipments" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'shipments' ? 'bg-green-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">
                    Shipment Tracking
                </a>
                <a href="?page=routes" class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'routes' ? 'bg-green-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'; ?>">
                    Route Optimization
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 animate-fadeUp">
            <?php
            $submodule_path = __DIR__ . "/project/{$page}.php";
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