<?php
// Get projects data
try {
    $stmt = $pdo_project->query("SELECT * FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll();
} catch (PDOException $e) {
    $projects = [];
    $error = "Error fetching projects: " . $e->getMessage();
}
?>

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Project Management</h2>
    <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-custom">
        <i class="fas fa-plus mr-2"></i>New Project
    </button>
</div>

<!-- Project Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-play-circle text-blue-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-blue-600">In Progress</p>
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
                <p class="text-sm font-medium text-green-600">Completed</p>
                <p class="text-2xl font-bold text-green-900">12</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-pause-circle text-yellow-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-600">On Hold</p>
                <p class="text-2xl font-bold text-yellow-900">3</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-chart-line text-purple-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-purple-600">Total Budget</p>
                <p class="text-2xl font-bold text-purple-900">₱65M</p>
            </div>
        </div>
    </div>
</div>

<!-- Projects Table -->
<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timeline</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manager</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($project['project_name']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($project['client_name']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    <?php echo date('M j, Y', strtotime($project['start_date'])); ?> - 
                                    <?php echo date('M j, Y', strtotime($project['end_date'])); ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">₱<?php echo number_format($project['budget'], 2); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($project['project_manager']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $project['status'] === 'In Progress' ? 'bg-blue-100 text-blue-800' : 
                                          ($project['status'] === 'Completed' ? 'bg-green-100 text-green-800' : 
                                          ($project['status'] === 'On Hold' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')); ?>">
                                    <?php echo $project['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 
                                        <?php echo $project['status'] === 'Completed' ? '100' : 
                                              ($project['status'] === 'In Progress' ? '65' : '30'); ?>%">
                                    </div>
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
                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                            No projects found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Project Timeline -->
<div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Project Timeline</h3>
    <div class="space-y-4">
        <div class="flex items-center space-x-4">
            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">Manila Port Expansion</p>
                <p class="text-xs text-gray-500">Aug 15, 2025 - Jun 30, 2026</p>
            </div>
            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">65% Complete</span>
        </div>
        <div class="flex items-center space-x-4">
            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">Cebu Retail Hub</p>
                <p class="text-xs text-gray-500">Sep 1, 2025 - Sep 22, 2025</p>
            </div>
            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Completed</span>
        </div>
        <div class="flex items-center space-x-4">
            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">Davao Cold Storage</p>
                <p class="text-xs text-gray-500">Oct 1, 2025 - Jan 20, 2026</p>
            </div>
            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Planning</span>
        </div>
    </div>
</div>