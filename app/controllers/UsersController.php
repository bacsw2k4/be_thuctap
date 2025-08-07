<?php
class UsersController extends BaseController
{
    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->model('UserModel');
    }
    public function showListUser()
    {
        $department = $_SESSION['user_department'];
        $category = $_SESSION['user_category'];
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        $page = isset($_GET['page']) ? (int)($_GET['page']) : 1;
        $limit = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $limit;
        $page = max($page, 1);
        $result = $this->userModel->getAllUser($search, $limit, $offset, $department, $category);
        $totalPages = ceil($result['total'] / $limit);
        $data = [
            'users' => $result['users'],
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'search' => $search,
            'department' => $department,
            'category' => $category
        ];
        $this->view('users/listuser', $data);
    }
    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['loginname']),
                'fullname' => trim($_POST['fullname']),
                'password' => trim($_POST['password']),
                'email' => trim($_POST['email']),
                'birthdate' => trim($_POST['birthDate']),
                'categoryuser' => trim($_POST['categoryuser']),
                'department' => trim($_POST['department']),
                'status' => trim($_POST['status']),
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
                if ($this->userModel->findUserByUserName($data['username'])) {
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
                    $data['password_err'] = '※Mật khẩu phải ít nhất 8 ký tự gồm chữ thường chữ hoa và ký tự đặc biệt';
                }
            }
            if (empty($data['email'])) {
                $data['email_err'] = '※Email không được để trống';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
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
            if (empty($data['username_err']) && empty($data['fullname_err']) && empty($data['password_err']) && empty($data['email_err']) && empty($data['birthdate_err']) && empty($data["categoryuser_err"]) && empty($data["categoryuser_err"]) && empty($data['status_err'])) {
                $_SESSION['add_user'] = [
                    'username' => $_POST['loginname'],
                    'fullname' => $_POST['fullname'],
                    'password' => $_POST['password'],
                    'email' => $_POST['email'],
                    'birthdate' => $_POST['birthDate'] ?: null,
                    'categoryuser' => $_POST['categoryuser'],
                    'department' => $_POST['department'],
                    'status' => $_POST['status']
                ];
                $this->redirect('users/checkAddUser');
            } else {
                $this->view('users/adduser', $data);
            }
        } else {
            $data = [
                'username' => '',
                'fullname' => '',
                'password' => '',
                'email' => '',
                'birthdate' => '',
                'categoryuser' => '',
                'department' => '',
                'status' => '',
                'username_err' => '',
                'fullname_err' => '',
                'password_err' => '',
                'email_err' => '',
                'birthdate_err' => '',
                'categoryuser_err' => '',
                'department_err' => '',
                'status_err' => ''
            ];
            $this->view('users/adduser', $data);
        }
    }
    public function checkAddUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userdata = $_SESSION['add_user'];
            $data = [
                'username' => $userdata['username'],
                'fullname' => $userdata['fullname'],
                'password' => $userdata['password'],
                'email' => $userdata['email'],
                'birthdate' => $userdata['birthdate'],
                'categoryuser' => $userdata['categoryuser'],
                'department' => $userdata['department'],
                'status' => $userdata['status']
            ];
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            if ($this->userModel->addUser($data)) {
                unset($_SESSION['add_user']);
                $this->redirect('users/showListUser');
            } else {
                die('Something went wrong');
            }
        } else {
            if (!isset($_SESSION['add_user'])) {
                header("Location: " . BASE_URL . "/public/index.php?url=users/addUser");
                exit();
            }

            $userData = $_SESSION['add_user'];
            $username = $userData['username'] ?? '';
            $fullname = $userData['fullname'] ?? '';
            $password = $userData['password'] ?? '';
            $email = $userData['email'] ?? '';
            $birthDate = $userData['birthdate'] ?? '';
            $categoryUser = $userData['categoryuser'] ?? '';
            $department = $userData['department'] ?? '';
            $status = $userData['status'] ?? '';
            $data = [
                'username' => $username,
                'fullname' => $fullname,
                'password' => $password,
                'email' => $email,
                'birthdate' => $birthDate,
                'categoryuser' => $categoryUser,
                'department' => $department,
                'status' => $status,
                'username_err' => '',
                'fullname_err' => '',
                'password_err' => '',
                'email_err' => '',
                'birthdate_err' => '',
                'categoryuser_err' => '',
                'department_err' => '',
                'status_err' => ''
            ];
            $this->view('users/checkadduser', $data);
        }
    }
    public function deleteById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->userModel->deleteById($id)) {
                $this->redirect('users');
            } else {
                echo "Error!";
            }
        } else {
            $this->redirect('users');
        }
    }
    public function getInforEdit($id)
    {
        $user = $this->userModel->findUserById($id);
        $data = [
            'user' => $user,
            'fullname_err' => '',
            'email_err' => '',
            'birthdate_err' => '',
            'categoryuser_err' => '',
            'department_err' => '',
            'status_err' => ''
        ];
        $this->view('users/edituser', $data);
    }
    public function editUser($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user' => [
                    'userId' => $userId,
                    'username' => $_POST['loginname'],
                    'fullName' => $_POST['fullname'],
                    'password' => $_POST['password'],
                    'email' => $_POST['email'],
                    'dob' => $_POST['birthDate'],
                    'userType' => $_POST['categoryuser'],
                    'department' => $_POST['department'],
                    'status' => $_POST['status']
                ],
                'passwordold' => $_POST['password-old'],
                'fullname_err' => '',
                'email_err' => '',
                'birthdate_err' => '',
                'categoryuser_err' => '',
                'department_err' => '',
                'status_err' => ''
            ];
            if (empty($data['user']['fullName'])) {
                $data['fullname_err'] = '※Tên người dùng không được để trống';
            }
            if (!empty($data['user']['password'])) {
                $data['user']['password'] = password_hash($data['user']['password'], PASSWORD_DEFAULT);
            } else {
                $data['user']['password'] = $data['passwordold'];
            }
            if (empty($data['user']['email'])) {
                $data['email_err'] = '※Email không được để trống';
            }
            if (empty($data['user']['dob'])) {
                $data['birthdate_err'] = '※Ngày sinh không được để trống';
            }
            if (empty($data['user']['userType'])) {
                $data["categoryuser_err"] = '※Loại người dùng không được để trống';
            }
            if (empty($data['user']['department'])) {
                $data['department_err'] = '※Vui lòng chọn phòng ban';
            }
            if (empty($data['user']['status'])) {
                $data['status_err'] = '※Vui lòng chọn trạng thái';
            }
            if (empty($data['fullname_err'])  && empty($data['email_err']) && empty($data['birthdate_err']) && empty($data["categoryuser_err"]) && empty($data['status_err'])) {
                $_SESSION['edit_user'] = [
                    'userid' => $userId,
                    'username' => $data['user']['username'],
                    'fullname' => $data['user']['fullName'],
                    'password' => $data['user']['password'],
                    'email' => $data['user']['email'],
                    'birthdate' => $data['user']['dob'] ?: null,
                    'categoryuser' => $data['user']['userType'],
                    'department' => $data['user']['department'],
                    'status' => $data['user']['status']
                ];
                $this->redirect('users/checkEdit');
            } else {
                $this->view('users/edituser', $data);
            }
        } else {
            $data = [
                'user' => [
                    'userId' => $userId,
                    'username' => '',
                    'fullName' => '',
                    'password' => '',
                    'email' => '',
                    'dob' => '',
                    'userType' => '',
                    'department' => '',
                    'status' => ''
                ],
                'passwordold' => '',
                'fullname_err' => '',
                'email_err' => '',
                'birthdate_err' => '',
                'categoryuser_err' => '',
                'department_err' => '',
                'status_err' => ''
            ];
            $this->view('users/edituser', $data);
        }
    }
    public function checkEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userdata = $_SESSION['edit_user'];
            $data = [
                'userid' => $userdata['userid'],
                'username' => $userdata['username'],
                'fullname' => $userdata['fullname'],
                'password' => $userdata['password'],
                'email' => $userdata['email'],
                'birthdate' => $userdata['birthdate'],
                'categoryuser' => $userdata['categoryuser'],
                'department' => $userdata['department'],
                'status' => $userdata['status']
            ];
            if ($this->userModel->updateUser($data['userid'], $data)) {
                unset($_SESSION['edit_user']);
                $this->redirect('users/showListUser');
            } else {
                die('Something went wrong');
            }
        } else {
            if (!isset($_SESSION['edit_user'])) {
                header("Location: " . BASE_URL . "/public/index.php?url=users/editUser");
                exit();
            }

            $userData = $_SESSION['edit_user'];
            $username = $userData['username'] ?? '';
            $fullname = $userData['fullname'] ?? '';
            $password = $userData['password'] ?? '';
            $email = $userData['email'] ?? '';
            $birthDate = $userData['birthdate'] ?? '';
            $categoryUser = $userData['categoryuser'] ?? '';
            $department = $userData['department'] ?? '';
            $status = $userData['status'] ?? '';
            $userid = $userData['userid'] ?? '';
            $data = [
                'userid' => $userid,
                'username' => $username,
                'fullname' => $fullname,
                'password' => $password,
                'email' => $email,
                'birthdate' => $birthDate,
                'categoryuser' => $categoryUser,
                'department' => $department,
                'status' => $status,
                'username_err' => '',
                'fullname_err' => '',
                'password_err' => '',
                'email_err' => '',
                'birthdate_err' => '',
                'categoryuser_err' => '',
                'department_err' => '',
                'status_err' => ''
            ];
            $this->view('users/checkedituser', $data);
        }
    }
    public function deleteMultiple()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userIds = $_POST['userIds'] ?? [];

            if (empty($userIds)) {
                echo "Không có người dùng nào được chọn để xóa.";
                $this->redirect('users');
                return;
            }

            try {
                $success = $this->userModel->deleteMultipleUsers($userIds);

                if ($success) {
                    $this->redirect('users');
                } else {
                    echo "Có lỗi xảy ra khi xóa người dùng. (Truy vấn thất bại hoặc không có dòng nào bị ảnh hưởng)";
                }
            } catch (PDOException $err) {
                echo "Lỗi PDO: " . $err->getMessage();
            } catch (Exception $err) {
                echo "Lỗi chung: " . $err->getMessage();
            }
        } else {
            $this->redirect('users');
        }
    }
}
