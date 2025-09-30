<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

$page_title = "Document Tracking & Logistic Records";
$auth->redirectIfNotLoggedIn();

$page = $_GET['page'] ?? 'documents';

// Initialize database connection
$pdo_document = $pdo;

try {
    $pdo_document = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=logistic_document_tracking_logistic_record", DB_USER, DB_PASS);
    $pdo_document->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Use main database if module database doesn't exist
}
?>

<?php include '../includes/header.php'; ?>

<div class="flex min-h-screen">
    <?php include '../includes/sidebar.php'; ?>

    <div id="main-content" class="flex-1 ml-60 transition-custom min-h-screen bg-gray-50 flex flex-col">
        <nav class="h-16 bg-white shadow-lg shadow-red-500/10 px-6 flex items-center justify-between sticky top-0 z-40 border-b border-gray-200 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <button id="toggle-sidebar" class="w-9 h-9 bg-red-500 border-none cursor-pointer text-white rounded-lg flex items-center justify-center transition-custom hover:bg-red-600 mr-2">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex items-center gap-2">
                    <img src="../assets/logo.svg" alt="MerchFlow Logo" class="w-7 h-7 rounded-lg shadow-md bg-white object-contain" />
                    <span class="text-red-500 font-semibold text-lg tracking-wide">MerchFlow</span>
                </div>
                <h1 class="text-xl font-bold text-gray-900 ml-4">Document Tracking & Records</h1>
            </div>
        </nav>

        <div class="flex-1 p-6">
            <!-- Page Tabs -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg w-fit">
                    <a href="?page=documents" 
                       class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'documents' ? 'bg-indigo-500 text-white' : 'text-gray-600 hover:text-gray-900'; ?>">
                        Document Management
                    </a>
                    <a href="?page=version" 
                       class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'version' ? 'bg-indigo-500 text-white' : 'text-gray-600 hover:text-gray-900'; ?>">
                        Version Control
                    </a>
                    <a href="?page=approval" 
                       class="px-4 py-2 rounded-md text-sm font-medium transition-custom <?php echo $page === 'approval' ? 'bg-indigo-500 text-white' : 'text-gray-600 hover:text-gray-900'; ?>">
                        Approval Workflow
                    </a>
                </div>
            </div>

            <!-- Dynamic Content -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <?php
                $submodule_path = "document/{$page}.php";
                if (file_exists($submodule_path)) {
                    include $submodule_path;
                } else {
                    echo '<div class="text-center py-8">
                            <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Page Not Found</h3>
                            <p class="text-gray-600">The requested page does not exist.</p>
                            <a href="?page=documents" class="inline-block mt-4 bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600">Go to Documents</a>
                          </div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="../assets/script.js"></script>
<?php include '../includes/footer.php'; ?>