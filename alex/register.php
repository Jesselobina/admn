<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$page_title = "Register";

if ($auth->isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = 'Passwords do not match';
    } else {
        $result = $auth->register($full_name, $email, $password);
        if ($result['success']) {
            $success_message = $result['message'];
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful!',
                    text: 'You can now login with your credentials',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = 'login.php';
                });
            </script>";
        } else {
            $error_message = $result['message'];
        }
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
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                <p class="text-gray-600">Join MerchFlow Pro today</p>
            </div>

            <?php if ($error_message): ?>
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6">
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="full_name" required 
                           value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-custom"
                           placeholder="Enter your full name">
                </div>

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

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="confirm_password" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-custom"
                           placeholder="Confirm your password">
                </div>

                <button type="submit" 
                        class="w-full bg-red-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-600 transition-custom focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Create Account
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">
                    Already have an account? 
                    <a href="login.php" class="text-red-500 font-semibold hover:text-red-600 transition-custom">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>