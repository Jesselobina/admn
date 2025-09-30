<?php
// Get purchase orders data
try {
    $stmt = $pdo_procurement->query("
        SELECT po.*, v.vendor_name 
        FROM purchase_orders po 
        LEFT JOIN vendors v ON po.vendor_id = v.id 
        ORDER BY po.created_at DESC
    ");
    $orders = $stmt->fetchAll();
} catch (PDOException $e) {
    $orders = [];
    $error = "Error fetching purchase orders: " . $e->getMessage();
}
?>

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-900">Purchase Orders</h2>
    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-custom">
        <i class="fas fa-plus mr-2"></i>Create Order
    </button>
</div>

<!-- Order Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-clock text-yellow-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-600">Pending</p>
                <p class="text-2xl font-bold text-yellow-900">3</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-check text-blue-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-blue-600">Confirmed</p>
                <p class="text-2xl font-bold text-blue-900">8</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-shipping-fast text-green-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-green-600">Shipped</p>
                <p class="text-2xl font-bold text-green-900">5</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-box text-purple-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-purple-600">Delivered</p>
                <p class="text-2xl font-bold text-purple-900">12</p>
            </div>
        </div>
    </div>
</div>

<!-- Purchase Orders Table -->
<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expected Delivery</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($order['order_number']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($order['vendor_name']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo date('M j, Y', strtotime($order['order_date'])); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo date('M j, Y', strtotime($order['expected_delivery'])); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">₱<?php echo number_format($order['total_amount'], 2); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $order['status'] === 'Confirmed' ? 'bg-blue-100 text-blue-800' : 
                                          ($order['status'] === 'Shipped' ? 'bg-green-100 text-green-800' : 
                                          ($order['status'] === 'Delivered' ? 'bg-purple-100 text-purple-800' : 'bg-yellow-100 text-yellow-800')); ?>">
                                    <?php echo $order['status']; ?>
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
                            No purchase orders found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>