<?php
// Get maintenance schedule data
try {
    $stmt = $pdo_asset->query("
        SELECT ms.*, a.asset_name, a.asset_tag 
        FROM maintenance_schedule ms 
        LEFT JOIN assets a ON ms.asset_id = a.id 
        ORDER BY ms.scheduled_date DESC
    ");
    $maintenance_schedule = $stmt->fetchAll();
} catch (PDOException $e) {
    $maintenance_schedule = [];
    $error = "Error fetching maintenance schedule: " . $e->getMessage();
}
?>

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Maintenance Schedule</h2>
    <button class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition-custom">
        <i class="fas fa-plus mr-2"></i>Schedule Maintenance
    </button>
</div>

<!-- Maintenance Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-clock text-yellow-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-600">Scheduled</p>
                <p class="text-2xl font-bold text-yellow-900">8</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-tools text-blue-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-blue-600">In Progress</p>
                <p class="text-2xl font-bold text-blue-900">3</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-green-600">Completed</p>
                <p class="text-2xl font-bold text-green-900">15</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-exclamation-triangle text-red-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-red-600">Overdue</p>
                <p class="text-2xl font-bold text-red-900">2</p>
            </div>
        </div>
    </div>
</div>

<!-- Maintenance Calendar -->
<div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Maintenance Calendar</h3>
    <div class="bg-gray-100 rounded-lg p-4 h-64 flex items-center justify-center">
        <div class="text-center">
            <i class="fas fa-calendar-alt text-4xl text-gray-400 mb-2"></i>
            <p class="text-gray-500">Maintenance Schedule Calendar</p>
            <p class="text-sm text-gray-400">Interactive calendar showing scheduled maintenance</p>
        </div>
    </div>
</div>

<!-- Maintenance Schedule Table -->
<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asset</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Maintenance Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Scheduled Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Technician</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($maintenance_schedule)): ?>
                    <?php foreach ($maintenance_schedule as $maintenance): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($maintenance['asset_name']); ?></div>
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($maintenance['asset_tag']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $maintenance['maintenance_type'] === 'Preventive' ? 'bg-blue-100 text-blue-800' : 
                                          ($maintenance['maintenance_type'] === 'Corrective' ? 'bg-yellow-100 text-yellow-800' : 'bg-purple-100 text-purple-800'); ?>">
                                    <?php echo $maintenance['maintenance_type']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo date('M j, Y', strtotime($maintenance['scheduled_date'])); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($maintenance['technician']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">₱<?php echo number_format($maintenance['cost'], 2); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $maintenance['status'] === 'Scheduled' ? 'bg-yellow-100 text-yellow-800' : 
                                          ($maintenance['status'] === 'In Progress' ? 'bg-blue-100 text-blue-800' : 
                                          ($maintenance['status'] === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')); ?>">
                                    <?php echo $maintenance['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                            No maintenance scheduled.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Upcoming Maintenance -->
<div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Maintenance (Next 7 Days)</h3>
    <div class="space-y-3">
        <div class="flex items-center justify-between p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
            <div class="flex items-center space-x-3">
                <i class="fas fa-tools text-yellow-500"></i>
                <div>
                    <p class="font-medium text-yellow-800">Forklift Truck #1 - Preventive Maintenance</p>
                    <p class="text-sm text-yellow-600">Scheduled: Sep 15, 2025</p>
                </div>
            </div>
            <button class="text-yellow-600 hover:text-yellow-800">
                <i class="fas fa-edit"></i>
            </button>
        </div>
        <div class="flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-center space-x-3">
                <i class="fas fa-truck text-blue-500"></i>
                <div>
                    <p class="font-medium text-blue-800">Delivery Van #3 - Oil Change</p>
                    <p class="text-sm text-blue-600">Scheduled: Sep 16, 2025</p>
                </div>
            </div>
            <button class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-edit"></i>
            </button>
        </div>
    </div>
</div>