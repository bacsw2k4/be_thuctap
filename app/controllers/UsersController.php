<?php
class UsersController extends BaseController
{
    private $userdModel;
    public function __construct()
    {
        parent::__construct();
        $this->userdModel = $this->model('UserModel');
    }
    public function showListUser()
    {
        $users = $this->userdModel->getAllUser();
        $data = [
            'users' => $users
        ];
        $this->view('users/listuser', $data);
    }
    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['loginname']),
                'fullname' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'email' => trim($_POST['email']),
                'birthdate' => trim($_POST['birthDate']),
                'categoryuser' => trim($_POST['categoryuser']),
                'department' => trim($_POST['department']),
                'status' => trim('status'),
                "username_err" => '',
                'fullname_err' => '',
                'password_err' => '',
                'email_err' => '',
                "birthdate_err" => '',
                'categoryuser_err' => '',
                'department_err' => '',
                'status_err' => ""
            ];
            if (empty($data['username'])) {
                $data['username_err'] = '※Tên đăng nhập không được để trống';
            } else {
                if ($this->userdModel->findUserByUserName($data['username'])) {
                    $data['username_err'] = '※Tên đăng nhập đã tồn tại.Thử lại ! ';
                }
            }
            if (empty($data['fullname'])) {
                $data['fullname_err'] = '※Tên người dùng không được để trống';
            }
            if (empty($data['password'])) {
                $data['password_err'] = '※Mật khẩu không được để trống';
            } else {
                if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $data['password'])) {
                    $data['password_err'] = '※Mật khẩu phải ít nhất 8 ký tự gồm chữ thường chữ viết hoa và ký tự đặc biệt';
                }
            }
            if (empty($data['email'])) {
                $data['email_err'] = '※Email không được để trống';
            } else {
                if ($this->userdModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = '※Email đã tồn tại.Thử lại';
                }
            }
            if (empty($data['birthdate'])) {
                $data['birthdate_err'] = '※Ngày sinh không được để trống';
            }
            if (empty($data['categoryuser'])) {
                $data["categoryuser_err"] = '※Loại người dùng không được để trống';
            }
            if (empty($data['department'])) {
                $data['department_err'] = '※Vui lòng chọn phòng ban';
            }
            if (empty($data['status'])) {
                $data['status_err'] = '※Vui lòng chọn trạng thái';
            }
        }
    }
}