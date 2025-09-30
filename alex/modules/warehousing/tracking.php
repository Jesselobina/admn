<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Real-time Tracking</h2>
    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-custom">
        <i class="fas fa-sync-alt mr-2"></i>Refresh Data
    </button>
</div>

<!-- Tracking Overview -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-shipping-fast text-blue-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-blue-600">In Transit</p>
                <p class="text-2xl font-bold text-blue-900">12</p>
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
                <p class="text-2xl font-bold text-green-900">45</p>
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
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-warehouse text-red-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-red-600">In Warehouse</p>
                <p class="text-2xl font-bold text-red-900">28</p>
            </div>
        </div>
    </div>
</div>

<!-- Live Tracking Map -->
<div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Live Shipment Tracking</h3>
    <div class="bg-gray-100 rounded-lg p-4 h-80 flex items-center justify-center">
        <div class="text-center">
            <i class="fas fa-map-marked-alt text-4xl text-gray-400 mb-2"></i>
            <p class="text-gray-500">Real-time Tracking Map</p>
            <p class="text-sm text-gray-400">Interactive map showing live shipment locations</p>
        </div>
    </div>
</div>

<!-- Active Shipments -->
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Active Shipments</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ETA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">TRK-784512</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">Manila to Cebu</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">Batangas Port</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            In Transit
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Sep 10, 2:00 PM
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">TRK-784513</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">Clark to Davao</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">NLEX - San Fernando</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Delayed
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Sep 11, 4:30 PM
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">TRK-784514</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">Makati to Quezon City</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">EDSA - Ortigas</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            On Time
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Sep 9, 11:00 AM
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>