<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$page_title = "Dashboard";
$auth->redirectIfNotLoggedIn();

// Get dashboard statistics
try {
    // Warehouse items count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM warehouse_items");
    $warehouse_count = $stmt->fetch()['count'];

    // Projects count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM projects");
    $projects_count = $stmt->fetch()['count'];

    // Assets count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM assets");
    $assets_count = $stmt->fetch()['count'];

    // Procurement orders count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM procurement_orders");
    $procurement_count = $stmt->fetch()['count'];

    // Recent activities
    $stmt = $pdo->query("
        (SELECT 'warehouse' as type, item_name as title, date_received as date FROM warehouse_items ORDER BY date_received DESC LIMIT 3)
        UNION ALL
        (SELECT 'project' as type, project_name as title, start_date as date FROM projects ORDER BY start_date DESC LIMIT 3)
        UNION ALL
        (SELECT 'asset' as type, asset_name as title, purchase_date as date FROM assets ORDER BY purchase_date DESC LIMIT 3)
        ORDER BY date DESC LIMIT 5
    ");
    $recent_activities = $stmt->fetchAll();

} catch (PDOException $e) {
    $error = "Error fetching dashboard data: " . $e->getMessage();
}
?>

<?php include 'includes/header.php'; ?>

<div class="flex min-h-screen">
    <?php include 'includes/sidebar.php'; ?>

    <div id="main-content" class="flex-1 ml-60 transition-custom min-h-screen bg-gray-50 flex flex-col">
        <nav class="h-16 bg-white shadow-lg shadow-red-500/10 px-6 flex items-center justify-between sticky top-0 z-40 border-b border-gray-200 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <button id="toggle-sidebar" class="w-9 h-9 bg-red-500 border-none cursor-pointer text-white rounded-lg flex items-center justify-center transition-custom hover:bg-red-600 mr-2">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex items-center gap-2">
                    <img src="assets/logo.svg" alt="MerchFlow Logo" class="w-7 h-7 rounded-lg shadow-md bg-white object-contain" />
                    <span class="text-red-500 font-semibold text-lg tracking-wide">MerchFlow</span>
                </div>
                <h1 class="text-xl font-bold text-gray-900 ml-4">Dashboard Overview</h1>
            </div>
        </nav>

        <div class="flex-1 p-6">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Warehouse Items</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo $warehouse_count; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-warehouse text-red-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Active Projects</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo $projects_count; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-project-diagram text-blue-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Assets</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo $assets_count; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-cogs text-green-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Procurement</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo $procurement_count; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-purple-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activities</h2>
                <div class="space-y-4">
                    <?php if (!empty($recent_activities)): ?>
                        <?php foreach ($recent_activities as $activity): ?>
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                    <?php echo $activity['type'] === 'warehouse' ? 'bg-red-100 text-red-500' : 
                                          ($activity['type'] === 'project' ? 'bg-blue-100 text-blue-500' : 'bg-green-100 text-green-500'); ?>">
                                    <i class="fas 
                                        <?php echo $activity['type'] === 'warehouse' ? 'fa-box' : 
                                              ($activity['type'] === 'project' ? 'fa-project-diagram' : 'fa-cogs'); ?> 
                                        text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($activity['title']); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo date('M j, Y', strtotime($activity['date'])); ?></p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    <?php echo $activity['type'] === 'warehouse' ? 'bg-red-100 text-red-800' : 
                                          ($activity['type'] === 'project' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'); ?>">
                                    <?php echo ucfirst($activity['type']); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-4">No recent activities found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/script.js"></script>
<?php include 'includes/footer.php'; ?>