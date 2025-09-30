<?php
// This flag MUST come before including config.php
$is_public_page = true; 

require_once 'includes/config.php';
require_once 'includes/auth.php';

$page_title = "Login";

// This check prevents logged-in users from seeing the login page.
if ($auth->isLoggedIn()) {
    header("Location: /alex/index.php");
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = $auth->login($email, $password);
    if ($result['success']) {
        // Use JavaScript for a smooth redirect after the success alert.
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Login Successful!',
                text: 'Welcome back!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '/alex/index.php';
            });
        </script>";
        exit; // Stop script execution after redirecting.
    } else {
        $error_message = $result['message'];
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-red-50 to-blue-50 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <img src="/alex/assets/logo.png" alt="MerchFlow Logo" class="w-16 h-16 rounded-xl shadow-lg">
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-600">Sign in to your MerchFlow Pro account</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 text-center">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/alex/login.php" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" required 
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-custom"
                           placeholder="Enter your email">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-custom"
                           placeholder="Enter your password">
                </div>
                <button type="submit" 
                        class="w-full bg-red-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-600 transition-custom focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Sign In
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">
                    Don't have an account? 
                    <a href="/alex/register.php" class="text-red-500 font-semibold hover:text-red-600 transition-custom">
                        Create one here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>