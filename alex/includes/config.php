<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$full_name = $_SESSION['full_name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MerchFlow Pro | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-red': '#E63946',
                        'dark-red': '#C1121F',
                        'accent-blue': '#457B9D',
                        'sidebar-black': '#181818',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'fadeIn': 'fadeIn 0.22s cubic-bezier(.44,1.52,.67,.94)',
                        'fadeUp': 'fadeUp 0.7s cubic-bezier(.44,1.52,.67,.94)',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .transition-custom {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .dropdown-enter {
            animation: fadeIn 0.2s ease-out;
        }
    </style>
</head>
<body class="font-poppins bg-gray-50 text-gray-900 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-60 bg-gradient-to-b from-gray-900 to-red-600 text-white h-screen fixed transition-custom z-50 shadow-2xl shadow-red-500/10 flex flex-col overflow-hidden">
            <div class="flex items-center justify-center h-16 bg-red-500 transition-custom shadow-lg shadow-red-500/20">
                <div class="flex items-center gap-2.5 text-white font-bold text-lg tracking-wide transition-custom">
                    <img src="../assets/logo.svg" alt="MerchFlow Logo" class="w-8 h-8 rounded-lg shadow-lg bg-white object-contain" />
                    <span class="sidebar-text">MerchFlow</span>
                </div>
            </div>
            <div class="flex-1 py-5 overflow-y-auto transition-custom">
                <!-- Main Section -->
                <div class="px-5 py-2 text-xs uppercase text-gray-300 tracking-wide font-semibold menu-label">Main</div>
                <a href="../index.php" class="flex items-center gap-3 px-5 py-3 mx-2 text-white no-underline transition-custom rounded-xl font-medium text-base opacity-90 hover:bg-red-500/25 hover:text-red-500 hover:opacity-100 hover:shadow-lg hover:shadow-red-500/10 active:bg-red-500/25 active:text-red-500 active:opacity-100 active:shadow-lg active:shadow-red-500/10">
                    <i class="fas fa-home w-5 text-center text-lg"></i>
                    <span class="menu-text">Dashboard</span>
                </a>

                <!-- Smart Warehousing Module -->
                <div class="module-dropdown">
                    <div class="module-toggle flex items-center gap-3 px-5 py-3 mx-2 text-white no-underline transition-custom rounded-xl font-medium text-base opacity-90 hover:bg-red-500/25 hover:text-red-500 hover:opacity-100 hover:shadow-lg hover:shadow-red-500/10 cursor-pointer">
                        <i class="fas fa-warehouse w-5 text-center text-lg"></i>
                        <span class="menu-text flex-1">Smart Warehousing</span>
                        <i class="fas fa-chevron-down text-xs transition-transform dropdown-arrow"></i>
                    </div>
                    <div class="module-submenu hidden pl-4">
                        <a href="../modules/smart_warehousing.php?page=inventory" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-boxes w-4 text-center"></i>
                            <span>Inventory Management</span>
                        </a>
                        <a href="../modules/smart_warehousing.php?page=storage" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-pallet w-4 text-center"></i>
                            <span>Storage Optimization</span>
                        </a>
                        <a href="../modules/smart_warehousing.php?page=tracking" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-map-marker-alt w-4 text-center"></i>
                            <span>Real-time Tracking</span>
                        </a>
                    </div>
                </div>

                <!-- Procurement & Sourcing Module -->
                <div class="module-dropdown">
                    <div class="module-toggle flex items-center gap-3 px-5 py-3 mx-2 text-white no-underline transition-custom rounded-xl font-medium text-base opacity-90 hover:bg-red-500/25 hover:text-red-500 hover:opacity-100 hover:shadow-lg hover:shadow-red-500/10 cursor-pointer">
                        <i class="fas fa-shopping-cart w-5 text-center text-lg"></i>
                        <span class="menu-text flex-1">Procurement & Sourcing</span>
                        <i class="fas fa-chevron-down text-xs transition-transform dropdown-arrow"></i>
                    </div>
                    <div class="module-submenu hidden pl-4">
                        <a href="../modules/procurement_sourcing.php?page=vendors" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-handshake w-4 text-center"></i>
                            <span>Vendor Management</span>
                        </a>
                        <a href="../modules/procurement_sourcing.php?page=requests" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-clipboard-list w-4 text-center"></i>
                            <span>Purchase Requests</span>
                        </a>
                        <a href="../modules/procurement_sourcing.php?page=orders" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-file-purchase w-4 text-center"></i>
                            <span>Purchase Orders</span>
                        </a>
                    </div>
                </div>

                <!-- Project Logistic Tracker Module -->
                <div class="module-dropdown">
                    <div class="module-toggle flex items-center gap-3 px-5 py-3 mx-2 text-white no-underline transition-custom rounded-xl font-medium text-base opacity-90 hover:bg-red-500/25 hover:text-red-500 hover:opacity-100 hover:shadow-lg hover:shadow-red-500/10 cursor-pointer">
                        <i class="fas fa-truck w-5 text-center text-lg"></i>
                        <span class="menu-text flex-1">Project Logistic Tracker</span>
                        <i class="fas fa-chevron-down text-xs transition-transform dropdown-arrow"></i>
                    </div>
                    <div class="module-submenu hidden pl-4">
                        <a href="../modules/project_logistic_tracker.php?page=projects" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-project-diagram w-4 text-center"></i>
                            <span>Project Management</span>
                        </a>
                        <a href="../modules/project_logistic_tracker.php?page=shipments" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-shipping-fast w-4 text-center"></i>
                            <span>Shipment Tracking</span>
                        </a>
                        <a href="../modules/project_logistic_tracker.php?page=routes" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-route w-4 text-center"></i>
                            <span>Route Optimization</span>
                        </a>
                    </div>
                </div>

                <!-- Management Section -->
                <div class="px-5 py-2 text-xs uppercase text-gray-300 tracking-wide font-semibold menu-label mt-4">Management</div>

                <!-- Asset Lifecycle Maintenance Module -->
                <div class="module-dropdown">
                    <div class="module-toggle flex items-center gap-3 px-5 py-3 mx-2 text-white no-underline transition-custom rounded-xl font-medium text-base opacity-90 hover:bg-red-500/25 hover:text-red-500 hover:opacity-100 hover:shadow-lg hover:shadow-red-500/10 cursor-pointer">
                        <i class="fas fa-cogs w-5 text-center text-lg"></i>
                        <span class="menu-text flex-1">Asset Management</span>
                        <i class="fas fa-chevron-down text-xs transition-transform dropdown-arrow"></i>
                    </div>
                    <div class="module-submenu hidden pl-4">
                        <a href="../modules/asset_lifecycle_maintenance.php?page=register" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-clipboard-check w-4 text-center"></i>
                            <span>Asset Register</span>
                        </a>
                        <a href="../modules/asset_lifecycle_maintenance.php?page=maintenance" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-tools w-4 text-center"></i>
                            <span>Maintenance Schedule</span>
                        </a>
                        <a href="../modules/asset_lifecycle_maintenance.php?page=lifecycle" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-recycle w-4 text-center"></i>
                            <span>Lifecycle Tracking</span>
                        </a>
                        <a href="../modules/asset_lifecycle_maintenance.php?page=depreciation" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-chart-line w-4 text-center"></i>
                            <span>Depreciation Calculator</span>
                        </a>
                        <a href="../modules/asset_lifecycle_maintenance.php?page=reports" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-file-alt w-4 text-center"></i>
                            <span>Asset Reports</span>
                        </a>
                    </div>
                </div>

                <!-- Document Tracking Module -->
                <div class="module-dropdown">
                    <div class="module-toggle flex items-center gap-3 px-5 py-3 mx-2 text-white no-underline transition-custom rounded-xl font-medium text-base opacity-90 hover:bg-red-500/25 hover:text-red-500 hover:opacity-100 hover:shadow-lg hover:shadow-red-500/10 cursor-pointer">
                        <i class="fas fa-file-alt w-5 text-center text-lg"></i>
                        <span class="menu-text flex-1">Document Tracking</span>
                        <i class="fas fa-chevron-down text-xs transition-transform dropdown-arrow"></i>
                    </div>
                    <div class="module-submenu hidden pl-4">
                        <a href="../modules/document_tracking_logistic_record.php?page=documents" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-folder w-4 text-center"></i>
                            <span>Document Management</span>
                        </a>
                        <a href="../modules/document_tracking_logistic_record.php?page=version" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-code-branch w-4 text-center"></i>
                            <span>Version Control</span>
                        </a>
                        <a href="../modules/document_tracking_logistic_record.php?page=approval" class="flex items-center gap-3 px-5 py-2 text-gray-200 no-underline transition-custom rounded-lg text-sm hover:bg-red-500/20 hover:text-white">
                            <i class="fas fa-check-circle w-4 text-center"></i>
                            <span>Approval Workflow</span>
                        </a>
                    </div>
                </div>

                <!-- Analytics & Reports -->
                <a href="../analytics.php" class="flex items-center gap-3 px-5 py-3 mx-2 text-white no-underline transition-custom rounded-xl font-medium text-base opacity-90 hover:bg-red-500/25 hover:text-red-500 hover:opacity-100 hover:shadow-lg hover:shadow-red-500/10">
                    <i class="fas fa-chart-line w-5 text-center text-lg"></i>
                    <span class="menu-text">Analytics</span>
                </a>
                <a href="../reports.php" class="flex items-center gap-3 px-5 py-3 mx-2 text-white no-underline transition-custom rounded-xl font-medium text-base opacity-90 hover:bg-red-500/25 hover:text-red-500 hover:opacity-100 hover:shadow-lg hover:shadow-red-500/10">
                    <i class="fas fa-file-invoice-dollar w-5 text-center text-lg"></i>
                    <span class="menu-text">Reports</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 ml-60 transition-custom min-h-screen bg-gray-50 flex flex-col">
            <!-- Navbar -->
            <nav class="h-16 bg-white shadow-lg shadow-red-500/10 px-6 flex items-center justify-between sticky top-0 z-40 border-b border-gray-200 backdrop-blur-sm">
                <div class="flex items-center gap-4">
                    <button id="toggle-sidebar" class="w-9 h-9 bg-red-500 border-none cursor-pointer text-white rounded-lg flex items-center justify-center transition-custom hover:bg-red-600 mr-2">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="flex items-center gap-2">
                        <img src="../assets/logo.svg" alt="MerchFlow Logo" class="w-7 h-7 rounded-lg shadow-md bg-white object-contain" />
                        <span class="text-red-500 font-semibold text-lg tracking-wide">MerchFlow</span>
                    </div>
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Search across all modules..." class="pl-10 pr-4 py-2 border-2 border-gray-200 rounded-lg w-48 text-sm transition-custom bg-white text-gray-900 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/10">
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative w-8 h-8 text-red-700 text-lg cursor-pointer transition-custom rounded-lg bg-gray-100 flex items-center justify-center hover:text-red-500 hover:bg-red-50">
                        <i class="far fa-bell"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center font-bold border-2 border-white shadow-md shadow-red-500/50">3</span>
                    </div>
                    <div class="relative w-8 h-8 text-red-700 text-lg cursor-pointer transition-custom rounded-lg bg-gray-100 flex items-center justify-center hover:text-red-500 hover:bg-red-50">
                        <i class="far fa-envelope"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center font-bold border-2 border-white shadow-md shadow-red-500/50">5</span>
                    </div>
                    <div class="relative">
                        <div class="flex items-center gap-2 cursor-pointer transition-custom rounded-lg bg-gray-100 p-1 hover:bg-red-50 dropdown-toggle">
                            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-red-500 to-blue-500 flex items-center justify-center text-white font-semibold text-sm shadow-md shadow-red-500/30">
                                <?php echo strtoupper(substr($full_name, 0, 2)); ?>
                            </div>
                            <div class="user-info hidden md:flex flex-col">
                                <div class="font-semibold text-sm text-gray-900"><?php echo htmlspecialchars($full_name); ?></div>
                                <div class="text-xs text-gray-500"><?php echo ucfirst($_SESSION['role'] ?? 'User'); ?></div>
                            </div>
                        </div>
                        <ul class="absolute right-0 top-full bg-white rounded-xl shadow-2xl border border-gray-200 w-44 py-1 z-50 hidden overflow-hidden dropdown-enter">
                            <li><a href="../profile.php" class="flex items-center gap-2 px-4 py-2 text-gray-700 no-underline transition-custom hover:bg-red-50 hover:text-red-500 text-sm"><i class="fas fa-user w-4 text-gray-500"></i> Profile</a></li>
                            <li><a href="../settings.php" class="flex items-center gap-2 px-4 py-2 text-gray-700 no-underline transition-custom hover:bg-red-50 hover:text-red-500 text-sm"><i class="fas fa-cog w-4 text-gray-500"></i> Settings</a></li>
                            <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                            <li><a href="../admin_users.php" class="flex items-center gap-2 px-4 py-2 text-gray-700 no-underline transition-custom hover:bg-red-50 hover:text-red-500 text-sm"><i class="fas fa-users-cog w-4 text-gray-500"></i> Admin Users</a></li>
                            <?php endif; ?>
                            <li><hr class="my-1 border-gray-200"></li>
                            <li><a href="../logout.php" class="flex items-center gap-2 px-4 py-2 text-gray-700 no-underline transition-custom hover:bg-red-50 hover:text-red-500 text-sm"><i class="fas fa-sign-out-alt w-4 text-gray-500"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="flex-1 flex flex-col items-center justify-center p-4">
                <div class="text-center animate-fadeUp mt-12 mb-8">
                    <h1 class="text-2xl font-bold text-red-500 mb-4 relative tracking-wide">
                        Dashboard
                        <div class="w-16 h-1 bg-gradient-to-r from-red-500 to-blue-500 rounded-full mx-auto mt-2 opacity-70"></div>
                    </h1>
                    <p class="text-lg font-medium bg-gradient-to-r from-red-500 to-blue-500 bg-clip-text text-transparent mt-2 tracking-wide">
                        Welcome back, <?php echo htmlspecialchars($full_name); ?> 🎉
                    </p>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-4xl">
                        <a href="../modules/smart_warehousing.php" class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow border-l-4 border-red-500">
                            <i class="fas fa-warehouse text-2xl text-red-500 mb-2"></i>
                            <h3 class="font-semibold">Smart Warehousing</h3>
                        </a>
                        <a href="../modules/procurement_sourcing.php" class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow border-l-4 border-blue-500">
                            <i class="fas fa-shopping-cart text-2xl text-blue-500 mb-2"></i>
                            <h3 class="font-semibold">Procurement & Sourcing</h3>
                        </a>
                        <a href="../modules/project_logistic_tracker.php" class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow border-l-4 border-green-500">
                            <i class="fas fa-truck text-2xl text-green-500 mb-2"></i>
                            <h3 class="font-semibold">Project Logistic Tracker</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarTexts = document.querySelectorAll('.sidebar-text, .menu-text, .menu-label');
            
            sidebar.classList.toggle('w-60');
            sidebar.classList.toggle('w-16');
            mainContent.classList.toggle('ml-60');
            mainContent.classList.toggle('ml-16');
            
            sidebarTexts.forEach(text => {
                text.classList.toggle('hidden');
            });
        });

        // Module dropdown functionality
        document.querySelectorAll('.module-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.closest('.module-dropdown');
                const submenu = dropdown.querySelector('.module-submenu');
                const arrow = dropdown.querySelector('.dropdown-arrow');
                
                // Close other dropdowns
                document.querySelectorAll('.module-submenu').forEach(menu => {
                    if (menu !== submenu) {
                        menu.classList.add('hidden');
                    }
                });
                document.querySelectorAll('.dropdown-arrow').forEach(arr => {
                    if (arr !== arrow) {
                        arr.classList.remove('rotate-180');
                    }
                });
                
                // Toggle current dropdown
                submenu.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.module-submenu').forEach(menu => {
                menu.classList.add('hidden');
            });
            document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
                arrow.classList.remove('rotate-180');
            });
        });

        // User dropdown functionality
        document.querySelector('.dropdown-toggle').addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('hidden');
        });

        // Close user dropdown when clicking outside
        document.addEventListener('click', function() {
            document.querySelector('.dropdown-toggle + ul').classList.add('hidden');
        });
    </script>
</body>
</html>