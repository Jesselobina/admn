<?php
// Get documents data
try {
    $stmt = $pdo_document->query("SELECT * FROM documents ORDER BY upload_date DESC");
    $documents = $stmt->fetchAll();
} catch (PDOException $e) {
    $documents = [];
    $error = "Error fetching documents: " . $e->getMessage();
}
?>

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Document Management</h2>
    <button class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition-custom">
        <i class="fas fa-upload mr-2"></i>Upload Document
    </button>
</div>

<!-- Document Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-file-alt text-blue-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-blue-600">Total Documents</p>
                <p class="text-2xl font-bold text-blue-900"><?php echo count($documents); ?></p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-green-600">Approved</p>
                <p class="text-2xl font-bold text-green-900">8</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-clock text-yellow-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-600">Pending Review</p>
                <p class="text-2xl font-bold text-yellow-900">3</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-archive text-red-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-red-600">Archived</p>
                <p class="text-2xl font-bold text-red-900">5</p>
            </div>
        </div>
    </div>
</div>

<!-- Documents Table -->
<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Version</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded By</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($documents)): ?>
                    <?php foreach ($documents as $document): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($document['document_title']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($document['document_type']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($document['reference_number']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">v<?php echo htmlspecialchars($document['version']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($document['uploaded_by']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $document['status'] === 'Approved' ? 'bg-green-100 text-green-800' : 
                                          ($document['status'] === 'Pending Review' ? 'bg-yellow-100 text-yellow-800' : 
                                          ($document['status'] === 'Draft' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')); ?>">
                                    <?php echo $document['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-download"></i>
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
                            No documents found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Document Activity -->
<div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Document Activity</h3>
    <div class="space-y-4">
        <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-upload text-green-500 text-sm"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">New document uploaded</p>
                <p class="text-xs text-gray-500">Shipment BOL - MNL to CEB by John Doe</p>
            </div>
            <span class="text-xs text-gray-500">2 hours ago</span>
        </div>
        <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-check text-blue-500 text-sm"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">Document approved</p>
                <p class="text-xs text-gray-500">Supplier Invoice - Steel Co. by Manager A</p>
            </div>
            <span class="text-xs text-gray-500">5 hours ago</span>
        </div>
        <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-edit text-yellow-500 text-sm"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">Document updated</p>
                <p class="text-xs text-gray-500">Customs Declaration Form A by Jane Smith</p>
            </div>
            <span class="text-xs text-gray-500">1 day ago</span>
        </div>
    </div>
</div>