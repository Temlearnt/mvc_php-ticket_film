<?php

class Auth extends Controller
{
    protected $authService;

    public function __construct()
    {
        $this->authService = $this->service('AuthService');
    }

    public function login()
    {
        $data = [
            'email' => '',
            'password' => '',
            'errors' => [
                'email' => '',
                'password' => '',
                'general' => '',
            ],
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi dan Sanitasi Input
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
            $password = trim($_POST['password'] ?? '');

            // Validasi Email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = "Invalid email format.";
            }

            // Validasi Password
            if (strlen($password) < 6) {
                $data['errors']['password'] = "Password must be at least 6 characters.";
            }

            if (empty($data['errors']['email']) && empty($data['errors']['password'])) {
                try {
                    $result = $this->authService->login($email, $password);
                    if ($result['success']) {
                        // Redirect berdasarkan role
                        // Tentukan URL redirect berdasarkan role
                        $redirectUrl = $result['role'] === 'admin' ? 'admin/index' : 'customer/index';
                        // Tentukan nama sesi berdasarkan role
                        $sessionKey = $result['role'] === 'admin' ? 'login_adm' : 'login_cust';

                        // Mulai sesi
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        // Simpan data ke dalam sesi
                        $_SESSION[$sessionKey] = true; // Menandakan pengguna telah login
                        if (isset($result['session'])) {
                            $_SESSION['user_session'] = $result['session']; // Simpan data sesi pengguna
                        }
                        $this->view('auth/login', $data); 
                        $this->swal('Succes...', 'Login Succes', 'success', $redirectUrl, 3);
                        return;  // Menghentikan eksekusi lebih lanjut setelah swal
                    }

                    // Error dari AuthService
                    $data['errors'] = $result['errors'];
                } catch (Exception $e) {
                    error_log("Error during login: " . $e->getMessage());
                    $data['errors']['general'] = "An unexpected error occurred. Please try again.";
                }
            }
        }
        $this->view('auth/login', $data); 
    }

    public function regist()
    {
        $data = [
            'email' => '',
            'name' => '',
            'password' => '',
            'confirm_password' => '',
            'errors' => [
                'email' => '',
                'name' => '',
                'password' => '',
                'confirm_password' => '',
                'general' => '',
            ],
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
            $name = trim($_POST['name'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = "Invalid email format.";
            }

            if (empty($name)) {
                $data['errors']['name'] = "Name is required.";
            }

            if (strlen($password) < 6) {
                $data['errors']['password'] = "Password must be at least 6 characters.";
            }

            if (empty(array_filter($data['errors']))) {
                try {
                    $data = [
                        "email" => $email, 
                        "name" => $name, 
                        "password" => password_hash($password, PASSWORD_DEFAULT)
                    ];
                    $result = $this->authService->regist($data);
                    if ($result) {
                        $this->swal('Success...', 'Registration Successful', 'success', 'auth/login', 3);
                        return;
                    }
                    $data['errors']['general'] = "Registration failed. Please try again.";
                } catch (Exception $e) {
                    error_log("Error during registration: " . $e->getMessage());
                    $data['errors']['general'] = "An unexpected error occurred. Please try again.";
                }
            }
        }

        $this->view('auth/register', $data);
    }

    public function forgetPassword()
    {
        $data = [
            'email' => '',
            'new_password' => '',
            'confirm_password' => '',
            'errors' => [
                'email' => '',
                'new_password' => '',
                'confirm_password' => '',
                'general' => '',
            ],
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
            $new_password = trim($_POST['new'] ?? '');
            $confirm_password = trim($_POST['confirm'] ?? '');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = "Invalid email format.";
            }

            if (strlen($new_password) < 6) {
                $data['errors']['new_password'] = "Password must be at least 6 characters.";
            }

            if ($new_password !== $confirm_password) {
                $data['errors']['confirm_password'] = "Passwords do not match.";
            }

            if (empty(array_filter($data['errors']))) {
                try {
                    $result = $this->authService->forgetPassword($email, password_hash($new_password, PASSWORD_DEFAULT));
                    if ($result) {
                        $this->swal('Success...', 'Password updated successfully', 'success', 'auth/login', 3);
                        return;
                    }
                    $data['errors']['general'] = "Failed to update password. Please try again.";
                } catch (Exception $e) {
                    error_log("Error during password update: " . $e->getMessage());
                    $data['errors']['general'] = "An unexpected error occurred. Please try again.";
                }
            }
        }

        $this->view('auth/forgetpassword', $data);
    }


    public function logout(): void
    {
        try {
            $this->authService->logout();
            header('Location: ' . BASEURL . 'auth/login');
            exit;
        } catch (Exception $e) {
            error_log("Error during logout: " . $e->getMessage());
            $this->view('auth/login', [
                'errors' => ['general' => 'Failed to log out. Please try again.']
            ]);
        }
    }
}
