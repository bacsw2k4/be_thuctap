<?php
class LettersController extends BaseController
{
    private $letterModel;
    public function __construct()
    {
        parent::__construct();
        $this->letterModel = $this->model('LetterModel');
    }
    public function showLetters()
    {
        $department = $_SESSION['user_department'];
        $category = $_SESSION['user_category'];
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        $page = isset($_GET['page']) ? (int)($_GET['page']) : 1;
        $limit = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $limit;
        $page = max($page, 1);
        $result = $this->letterModel->getAllLetter($search, $limit, $offset);
        $totalPages = ceil($result['total'] / $limit);
        $data = [
            'letters' => $result['letters'],
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'search' => $search,
            'department' => $department,
            'category' => $category
        ];
        $this->view('letters/listletters', $data);
    }
    public function addLetter()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $user_department = $_SESSION['user_department'];
            $userDepartment = $this->letterModel->getUserByDepartment($user_department);
            $data = [
                'userId' => trim($_POST['userId']),
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'roleuser' => trim($_POST['roleuser']),
                'categoryletter' => trim($_POST['categoryletter']),
                'startdate' => trim($_POST['datestart']),
                'enddate' => trim($_POST['dateend']),
                'status' => 'Chờ duyệt',
                'file' => trim($_POST['file']),
                'title_err' => '',
                'content_err' => '',
                'roleuser_err' => '',
                'categoryletter_err' => '',
                'startdate_err' => '',
                'enddate_err' => '',
                'file_err' => '',
                'userdepartment' => $userDepartment
            ];
            if (empty($data['title'])) {
                $data['title_err'] = "※Tiêu đề không được để trống";
            }
            if (empty($data['content'])) {
                $data['content_err'] = "※Nội dung không được để trống";
            }
            if (empty($data['roleuser'])) {
                $data['roleuser_err'] = "※Người duyệt không được để trống";
            }
            if (empty($data['categoryletter'])) {
                $data['categoryletter_err'] = "※Loại đơn không được để trống";
            }
            if (empty($data['startdate'])) {
                $data['startdate_err'] = "※Ngày bắt đầu không được để trống";
            } elseif (!empty($data['startdate']) && ($data['startdate'] > $data['enddate'])) {
                $data['startdate_err'] = "※Ngày bắt đầu không được lớn hơn ngày kết thúc";
            }
            if (empty($data['enddate'])) {
                $data['enddate_err'] = "※Ngày kết thúc không được để trống";
            } elseif (!empty($data['enddate']) && ($data['startdate'] > $data['enddate'])) {
                $data['enddate_err'] = "※Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu";
            }
            if (!isset($_FILES['file']) || $_FILES['file']['error'] != UPLOAD_ERR_OK) {
                $data['file_err'] = "※File không được để trống";
            }
            if (
                empty($data['title_err']) &&
                empty($data['content_err']) &&
                empty($data['roleuser_err']) &&
                empty($data['categoryletter_err']) &&
                empty($data['startdate_err']) &&
                empty($data['enddate_err']) &&
                empty($data['file_err'])
            ) {
                $upload_dir = "uploads/";
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $file_name = $_SESSION['user_id'] . '_' . time() . '_' . basename($_FILES['file']['name']);
                $target_file = $upload_dir . $file_name;

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    $_SESSION['add_letter'] = [
                        'userId'         => $data['userId'],
                        'title'          => $data['title'],
                        'content'        => $data['content'],
                        'status'         => $data['status'],
                        'roleuser'       => $data['roleuser'],
                        'categoryletter' => $data['categoryletter'],
                        'startdate'      => $data['startdate'],
                        'enddate'        => $data['enddate'],
                        'file'           => $file_name

                    ];
                    $this->redirect('letters/checkAddLetter');
                    return;
                } else {
                    $data['file_err'] = "※Upload file thất bại";
                }
            }
            $this->view('letters/addletters', $data);
        } else {
            $user_department = $_SESSION['user_department'];
            $userDepartment = $this->letterModel->getUserByDepartment($user_department);
            $data = [
                'title' => '',
                'content' => '',
                'roleuser' => '',
                'categoryletter' => '',
                'startdate' => '',
                'enddate' => '',
                'file' => '',
                'title_err' => '',
                'content_err' => '',
                'roleuser_err' => '',
                'categoryletter_err' => '',
                'startdate_err' => '',
                'enddate_err' => '',
                'file_err' => '',
                'userdepartment' => $userDepartment
            ];
            $this->view('letters/addletters', $data);
        }
    }
    public function checkAddLetter()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!isset($_SESSION['add_letter'])) {
                header('Location: ' . BASE_URL . "/public/index.php?url=letters/addLetter");
                exit();
            }
            $user_department = $_SESSION['user_department'];
            $userDepartment = $this->letterModel->getUserByDepartment($user_department);
            $letters = $_SESSION['add_letter'];
            $data = [
                'userid' => $letters['userId'],
                'title' => $letters['title'],
                'content' => $letters['content'],
                'status' => $letters['status'],
                'roleuser' => $letters['roleuser'],
                'categoryletter' => $letters['categoryletter'],
                'startdate' => $letters['startdate'],
                'enddate' => $letters['enddate'],
                'file' => $letters['file'],
                'userdepartment' => $userDepartment
            ];

            if ($this->letterModel->addLetter($data)) {
                unset($_SESSION['add_letter']);
                $this->redirect('letters/showLetters');
            } else {
                echo "Error";
            }
        } else {
            if (!isset($_SESSION['add_letter'])) {
                header('Location: ' . BASE_URL . "/public/index.php?url=letters/addLetter");
                exit();
            }
            $user_department = $_SESSION['user_department'];
            $userDepartment = $this->letterModel->getUserByDepartment($user_department);
            $letters = $_SESSION['add_letter'];
            $data = [
                'userid' => $letters['userId'],
                'title' => $letters['title'],
                'content' => $letters['content'],
                'status' => $letters['status'],
                'roleuser' => $letters['roleuser'],
                'categoryletter' => $letters['categoryletter'],
                'startdate' => $letters['startdate'],
                'enddate' => $letters['enddate'],
                'file' => $letters['file'],
                'userdepartment' => $userDepartment
            ];
            $this->view('letters/checkaddletters', $data);
        }
    }
    public function acceptLetter($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $useridacess = $_SESSION['add_letter'];
            $letterApprove = $this->letterModel->findLettertById($id);
            $data = [
                'title' => $letterApprove['title'],
                'content' => $letterApprove['content'],
                'status' => "Đã duyệt",
                'roleuser' => $letterApprove['approverId'],
                'categoryletter' => $letterApprove['categoryLetter'],
                'startdate' => $letterApprove['startDate'],
                'enddate' => $letterApprove['endDate'],
                'file' => $letterApprove['attachment'],
            ];
            if ($_SESSION['user_id'] == $useridacess['userId']) {
                $this->letterModel->acceptLetter($data, $id);
                $this->redirect('letters/showLetters');
            } else {
                $this->view('letters/approveletter', $data);
            }
        } else {
            $letterApprove = $this->letterModel->findLettertById($id);
            $data = [
                'title' => $letterApprove['title'],
                'content' => $letterApprove['content'],
                'status' => $letterApprove['status'],
                'roleuser' => $letterApprove['approverId'],
                'categoryletter' => $letterApprove['categoryLetter'],
                'startdate' => $letterApprove['startDate'],
                'enddate' => $letterApprove['endDate'],
                'file' => $letterApprove['attachment'],
            ];
            $this->view('letters/approveletter', $data);
        }
    }
}
