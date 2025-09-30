<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Storage Optimization</h2>
    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-custom">
        <i class="fas fa-chart-bar mr-2"></i>Generate Report
    </button>
</div>

<!-- Storage Metrics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Capacity</p>
                <p class="text-2xl font-bold text-gray-900">85%</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-warehouse text-blue-500"></i>
            </div>
        </div>
        <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
            <div class="bg-blue-500 h-2 rounded-full" style="width: 85%"></div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Optimal Zones</p>
                <p class="text-2xl font-bold text-gray-900">12/15</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
        </div>
        <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
            <div class="bg-green-500 h-2 rounded-full" style="width: 80%"></div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Slow Moving</p>
                <p class="text-2xl font-bold text-gray-900">8 Items</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Space Saved</p>
                <p class="text-2xl font-bold text-gray-900">15%</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-line text-purple-500"></i>
            </div>
        </div>
    </div>
</div>

<!-- Warehouse Layout Visualization -->
<div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Warehouse Layout Optimization</h3>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <div class="bg-gray-100 rounded-lg p-4 h-64 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-warehouse text-4xl text-gray-400 mb-2"></i>
                    <p class="text-gray-500">Warehouse Layout Visualization</p>
                    <p class="text-sm text-gray-400">Interactive map would be displayed here</p>
                </div>
            </div>
        </div>
        <div>
            <h4 class="font-medium text-gray-900 mb-3">Optimization Suggestions</h4>
            <div class="space-y-3">
                <div class="flex items-start p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <i class="fas fa-lightbulb text-yellow-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-yellow-800">Relocate Zone B items</p>
                        <p class="text-sm text-yellow-600">Move slow-moving items to reduce travel time</p>
                    </div>
                </div>
                <div class="flex items-start p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <i class="fas fa-lightbulb text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-blue-800">Consolidate storage</p>
                        <p class="text-sm text-blue-600">Merge similar items to free up 2 pallet positions</p>
                    </div>
                </div>
                <div class="flex items-start p-3 bg-green-50 border border-green-200 rounded-lg">
                    <i class="fas fa-lightbulb text-green-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-green-800">ABC Analysis Complete</p>
                        <p class="text-sm text-green-600">Fast-moving items properly positioned near dispatch</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Storage Performance -->
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Storage Performance Metrics</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h4 class="font-medium text-gray-700 mb-2">Space Utilization by Zone</h4>
            <div class="space-y-3">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Zone A (Fast-moving)</span>
                        <span>92%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 92%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Zone B (Medium-moving)</span>
                        <span>78%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Zone C (Slow-moving)</span>
                        <span>45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h4 class="font-medium text-gray-700 mb-2">Efficiency Metrics</h4>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Picking Efficiency</span>
                        <span>88%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: 88%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Space Utilization</span>
                        <span>85%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-indigo-500 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Travel Time Reduction</span>
                        <span>22%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-teal-500 h-2 rounded-full" style="width: 22%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>