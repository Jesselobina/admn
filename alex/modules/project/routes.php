<?php
// Get routes data
try {
    $stmt = $pdo_project->query("SELECT * FROM routes ORDER BY created_at DESC");
    $routes = $stmt->fetchAll();
} catch (PDOException $e) {
    $routes = [];
    $error = "Error fetching routes: " . $e->getMessage();
}
?>

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Route Optimization</h2>
    <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-custom">
        <i class="fas fa-plus mr-2"></i>New Route
    </button>
</div>

<!-- Route Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-route text-green-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-green-600">Total Routes</p>
                <p class="text-2xl font-bold text-green-900"><?php echo count($routes); ?></p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-bolt text-blue-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-blue-600">Optimized</p>
                <p class="text-2xl font-bold text-blue-900">8</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-road text-purple-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-purple-600">Total Distance</p>
                <p class="text-2xl font-bold text-purple-900">1,284 km</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-clock text-yellow-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-600">Time Saved</p>
                <p class="text-2xl font-bold text-yellow-900">42 hrs</p>
            </div>
        </div>
    </div>
</div>

<!-- Route Optimization Map -->
<div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Route Network Map</h3>
    <div class="bg-gray-100 rounded-lg p-4 h-80 flex items-center justify-center">
        <div class="text-center">
            <i class="fas fa-map text-4xl text-gray-400 mb-2"></i>
            <p class="text-gray-500">Route Optimization Visualization</p>
            <p class="text-sm text-gray-400">Interactive map showing optimized routes and traffic patterns</p>
        </div>
    </div>
</div>

<!-- Routes Table -->
<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Point</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Point</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Distance</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Est. Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Optimized</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($routes)): ?>
                    <?php foreach ($routes as $route): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($route['route_name']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($route['start_point']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($route['end_point']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo number_format($route['distance_km'], 2); ?> km</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo number_format($route['estimated_time_hours'], 1); ?> hrs</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $route['optimized'] ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                    <?php echo $route['optimized'] ? 'Yes' : 'No'; ?>
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
                            No routes found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Optimization Suggestions -->
<div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Optimization Suggestions</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h4 class="font-medium text-gray-700 mb-3">Route Improvements</h4>
            <div class="space-y-3">
                <div class="flex items-start p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <i class="fas fa-route text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-blue-800">Manila to Batangas Route</p>
                        <p class="text-sm text-blue-600">Alternative route can save 15 minutes during peak hours</p>
                    </div>
                </div>
                <div class="flex items-start p-3 bg-green-50 border border-green-200 rounded-lg">
                    <i class="fas fa-gas-pump text-green-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-green-800">Fuel Optimization</p>
                        <p class="text-sm text-green-600">Consolidate deliveries to reduce fuel consumption by 12%</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h4 class="font-medium text-gray-700 mb-3">Traffic Alerts</h4>
            <div class="space-y-3">
                <div class="flex items-start p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-yellow-800">EDSA Heavy Traffic</p>
                        <p class="text-sm text-yellow-600">Expected delay of 45 minutes. Consider alternative routes.</p>
                    </div>
                </div>
                <div class="flex items-start p-3 bg-red-50 border border-red-200 rounded-lg">
                    <i class="fas fa-road text-red-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-red-800">NLEX Road Works</p>
                        <p class="text-sm text-red-600">Lane closures until September 15. Plan accordingly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>