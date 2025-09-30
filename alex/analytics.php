<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$page_title = "Analytics";
$auth->redirectIfNotLoggedIn();
?>

<?php include 'includes/header.php'; ?>

<div class="flex min-h-screen">
    <?php include 'includes/sidebar.php'; ?>

    <div id="main-content" class="flex-1 ml-60 transition-custom min-h-screen bg-gray-50 flex flex-col">
        <nav class="h-16 bg-white shadow-lg shadow-red-500/10 px-6 flex items-center justify-between sticky top-0 z-40 border-b border-gray-200 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <button id="toggle-sidebar" class="w-9 h-9 bg-red-500 border-none cursor-pointer text-white rounded-lg flex items-center justify-center transition-custom hover:bg-red-600 mr-2">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex items-center gap-2">
                    <img src="assets/logo.svg" alt="MerchFlow Logo" class="w-7 h-7 rounded-lg shadow-md bg-white object-contain" />
                    <span class="text-red-500 font-semibold text-lg tracking-wide">MerchFlow</span>
                </div>
                <h1 class="text-xl font-bold text-gray-900 ml-4">Analytics Dashboard</h1>
            </div>
        </nav>

        <div class="flex-1 p-6">
            <div class="text-center py-8">
                <i class="fas fa-chart-line text-4xl text-gray-400 mb-4"></i>
                <h2 class="text-2xl font-semibold text-gray-900 mb-2">Analytics Dashboard</h2>
                <p class="text-gray-600">Comprehensive analytics and insights coming soon.</p>
            </div>
        </div>
    </div>
</div>

<script src="assets/script.js"></script>
<?php include 'includes/footer.php'; ?>