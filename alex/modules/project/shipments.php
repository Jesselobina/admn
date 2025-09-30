<?php
// Get shipments data
try {
    $stmt = $pdo_project->query("
        SELECT s.*, p.project_name 
        FROM shipments s 
        LEFT JOIN projects p ON s.project_id = p.id 
        ORDER BY s.created_at DESC
    ");
    $shipments = $stmt->fetchAll();
} catch (PDOException $e) {
    $shipments = [];
    $error = "Error fetching shipments: " . $e->getMessage();
}
?>

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Shipment Tracking</h2>
    <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-custom">
        <i class="fas fa-plus mr-2"></i>New Shipment
    </button>
</div>

<!-- Shipment Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-shipping-fast text-blue-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-blue-600">In Transit</p>
                <p class="text-2xl font-bold text-blue-900">8</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-green-600">Delivered</p>
                <p class="text-2xl font-bold text-green-900">15</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-600">Delayed</p>
                <p class="text-2xl font-bold text-yellow-900">3</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-boxes text-purple-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-purple-600">Preparing</p>
                <p class="text-2xl font-bold text-purple-900">5</p>
            </div>
        </div>
    </div>
</div>

<!-- Live Tracking Map -->
<div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Live Shipment Locations</h3>
    <div class="bg-gray-100 rounded-lg p-4 h-80 flex items-center justify-center">
        <div class="text-center">
            <i class="fas fa-map-marked-alt text-4xl text-gray-400 mb-2"></i>
            <p class="text-gray-500">Real-time Shipment Tracking Map</p>
            <p class="text-sm text-gray-400">Interactive map showing active shipment locations</p>
        </div>
    </div>
</div>

<!-- Shipments Table -->
<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ETA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($shipments)): ?>
                    <?php foreach ($shipments as $shipment): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($shipment['tracking_number']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($shipment['project_name']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($shipment['origin']); ?> to <?php echo htmlspecialchars($shipment['destination']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($shipment['current_location']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $shipment['status'] === 'In Transit' ? 'bg-blue-100 text-blue-800' : 
                                          ($shipment['status'] === 'Delivered' ? 'bg-green-100 text-green-800' : 
                                          ($shipment['status'] === 'Delayed' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')); ?>">
                                    <?php echo $shipment['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    <?php echo $shipment['estimated_delivery'] ? date('M j, Y g:i A', strtotime($shipment['estimated_delivery'])) : 'N/A'; ?>
                                </div>
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
                            No shipments found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>