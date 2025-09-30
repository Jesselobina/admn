<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Version Control</h2>
    <button class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition-custom">
        <i class="fas fa-code-branch mr-2"></i>Manage Versions
    </button>
</div>

<!-- Version Control Overview -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-code-branch text-blue-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-blue-600">Total Versions</p>
                <p class="text-2xl font-bold text-blue-900">47</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-green-600">Current Versions</p>
                <p class="text-2xl font-bold text-green-900">23</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-history text-purple-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-purple-600">Archived Versions</p>
                <p class="text-2xl font-bold text-purple-900">24</p>
            </div>
        </div>
    </div>
</div>

<!-- Version History -->
<div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Document Version History</h3>
    <div class="space-y-4">
        <!-- Sample version history items -->
        <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-green-500"></i>
                </div>
                <div>
                    <p class="font-medium text-green-800">Shipment BOL - MNL to CEB</p>
                    <p class="text-sm text-green-600">Version 2.0 - Current Version</p>
                    <p class="text-xs text-green-500">Updated: Sep 6, 2025 10:30 AM by John Doe</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="text-green-600 hover:text-green-800">
                    <i class="fas fa-download"></i>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-200 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-file text-gray-500"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Shipment BOL - MNL to CEB</p>
                    <p class="text-sm text-gray-600">Version 1.0 - Previous Version</p>
                    <p class="text-xs text-gray-500">Created: Sep 5, 2025 2:15 PM by John Doe</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="text-green-600 hover:text-green-800">
                    <i class="fas fa-download"></i>
                </button>
                <button class="text-purple-600 hover:text-purple-800">
                    <i class="fas fa-redo"></i>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-200 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-file text-gray-500"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Supplier Invoice - Steel Co.</p>
                    <p class="text-sm text-gray-600">Version 1.1 - Archived</p>
                    <p class="text-xs text-gray-500">Created: Sep 4, 2025 9:45 AM by Jane Smith</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="text-green-600 hover:text-green-800">
                    <i class="fas fa-download"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Version Comparison -->
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Version Comparison</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Compare Version</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option>Version 2.0 (Current)</option>
                <option>Version 1.0</option>
                <option>Version 1.1</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">With Version</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option>Version 1.0</option>
                <option>Version 2.0 (Current)</option>
                <option>Version 1.1</option>
            </select>
        </div>
    </div>
    <div class="mt-4 bg-gray-100 rounded-lg p-4 h-48 flex items-center justify-center">
        <div class="text-center">
            <i class="fas fa-code-compare text-3xl text-gray-400 mb-2"></i>
            <p class="text-gray-500">Version Comparison Results</p>
            <p class="text-sm text-gray-400">Select versions to compare changes and differences</p>
        </div>
    </div>
</div>