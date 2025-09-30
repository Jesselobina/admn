\<?php
// ==================================================================
// == DEBUGGING CODE: Force PHP to show errors. This is the fix. ==
// ==================================================================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Now, we run the rest of the script.
require_once 'includes/config.php';
require_once 'includes/auth.php'; 

$page_title = "Dashboard";
$auth->redirectIfNotLoggedIn();

// For now, let's disable the multi-database connection to ensure the page loads.
$warehouse_count = 0;
$projects_count = 0;
$assets_count = 0;
$procurement_count = 0;
$error = 'Stats are currently being re-calibrated.';

?>

<?php include 'includes/header.php'; ?>

<div class="flex min-h-screen">
    <?php include 'includes/sidebar.php'; ?>

    <div id="main-content" class="flex-1 ml-60 transition-custom min-h-screen bg-gray-50 flex flex-col">
        <div class="flex-1 p-6 lg:p-8">
             <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                    <p class="text-gray-500 mt-1">Welcome back, <?php echo htmlspecialchars($_SESSION['full_name']); ?>! 👋</p>
                </div>
             </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fadeUp">
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div><p class="text-sm font-medium text-gray-600">Warehouse Items</p><p class="text-3xl font-bold text-gray-900"><?php echo $warehouse_count; ?></p></div>
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center"><i class="fas fa-warehouse text-red-500 text-xl"></i></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div><p class="text-sm font-medium text-gray-600">Active Projects</p><p class="text-3xl font-bold text-gray-900"><?php echo $projects_count; ?></p></div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center"><i class="fas fa-project-diagram text-blue-500 text-xl"></i></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div><p class="text-sm font-medium text-gray-600">Managed Assets</p><p class="text-3xl font-bold text-gray-900"><?php echo $assets_count; ?></p></div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center"><i class="fas fa-cogs text-green-500 text-xl"></i></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div><p class="text-sm font-medium text-gray-600">Purchase Orders</p><p class="text-3xl font-bold text-gray-900"><?php echo $procurement_count; ?></p></div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center"><i class="fas fa-shopping-cart text-purple-500 text-xl"></i></div>
                    </div>
                </div>
            </div>

             <?php if (!empty($error)): ?>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mt-6" role="alert">
                    <p class="font-bold">Notice</p>
                    <p><?php echo htmlspecialchars($error); ?></p>
                </div>
             <?php endif; ?>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>