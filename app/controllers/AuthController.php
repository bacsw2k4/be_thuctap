<?php
class AuthController extends BaseController
{
    private $authModel;

    public function __construct()
    {
        $this->authModel = $this->model('AuthModel');
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];
            $user = $this->authModel->login($data['username'], $data['password']);
            if (empty($data['username'])) {
                $data['username_err'] = '※Tên đăng nhập không được để trống!';
            } else {
            }
            if (empty($data['password'])) {
                $data['password_err'] = '※Mật khẩu không được để trống!';
            }

            if (empty($user)) {
                $data['password_err'] = '※Sai tài khoản hoặc mật khẩu';
            }

            if (empty($data['username_err']) && empty($data['password_err'])) {
                if ($user) {
                    $_SESSION['user_id'] = $user['userId'];
                    $_SESSION['user_username'] = $user['username'];
                    $_SESSION['user_category'] = $user['userType'];
                    $_SESSION['user_department'] = $user['department'];
                    $this->redirect('dashboard/showDashboard');
                } else {
                    $data['password_err'] = 'Sai tài khoản hoặc mật khẩu';
                    $this->view('auth/login', $data);
                }
            } else {
                $this->view('auth/login', $data);
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            $this->view('auth/login', $data);
        }
    }

    public function logout()
    {

        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_category']);
        unset($_SESSION['user_department']);
        session_destroy();
        $this->redirect('auth/login');
    }
}
