<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$page_title = "Login";

if ($auth->isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = $auth->login($email, $password);
    if ($result['success']) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Login Successful!',
                text: 'Welcome back!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
        exit;
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
                    <img src="assets/logo.svg" alt="MerchFlow Logo" class="w-16 h-16 rounded-xl shadow-lg">
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-600">Sign in to your MerchFlow Pro account</p>
            </div>

            <?php if ($error_message): ?>
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="space-y-6">
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

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-red-500 focus:ring-red-500">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-red-500 hover:text-red-600 font-semibold">Forgot password?</a>
                </div>

                <button type="submit" 
                        class="w-full bg-red-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-600 transition-custom focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Sign In
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">
                    Don't have an account? 
                    <a href="register.php" class="text-red-500 font-semibold hover:text-red-600 transition-custom">
                        Create one here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>