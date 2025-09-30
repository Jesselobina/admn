<?php
class Auth {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function login($email, $password) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && $password === $user['password']) { // NOTE: Using plaintext passwords is not secure.
                if (session_status() === PHP_SESSION_NONE) { session_start(); }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Invalid email or password'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }
    
    public function isLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        return isset($_SESSION['user_id']);
    }
    
    public function redirectIfNotLoggedIn() {
        if (!$this->isLoggedIn()) {
            header("Location: /alex/login.php");
            exit;
        }
    }
    
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        session_destroy();
        header("Location: /alex/login.php");
        exit;
    }
}

// This line creates the $auth object that your other pages use.
$auth = new Auth($pdo);
?>