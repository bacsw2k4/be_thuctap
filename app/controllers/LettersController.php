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
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'categoryuser' => trim($_POST['categoryuser']),
                'categoryletter' => trim($_POST['categoryletter']),
                'startdate' => trim($_POST['datestart']),
                'enddate' => trim($_POST['dateend']),
                'file' => trim($_POST['file']),
                'title_err' => '',
                'content_err' => '',
                'categoryuser_err' => '',
                'categoryletter_er' => '',
                'startdate_err' => '',
                'enddate_err' => '',
                'file_err' => ''
            ];
            if (empty($data['title'])) {
                $data['title_err'] = "※Tiêu đề không được để trống";
            }
            if (empty($data['content'])) {
                $data['content_err'] = "※Nội dung không được để trống";
            }
            if (empty($data['categoryuser'])) {
                $data['categoryuser_err'] = "※Người duyệt không được để trống";
            }
            if (empty($data['categoryletter'])) {
                $data['categoryletter_er'] = "※Loại đơn không được để trống";
            }
            if (empty($data['startdate'])) {
                $data['startdate_err'] = "※Ngày bắt đầu không được để trống";
            }
            if (empty($data['enddate'])) {
                $data['enddate_err'] = "※Ngày kết thúc không được để trống";
            }
            if (empty($data['file'])) {
                $data['file_err'] = "※File không được để trống";
            }
            if (empty($data['title_err']) && empty($data['content_err']) && empty($data['categoryuser_err']) && empty($data['startdate_err']) && empty($data['startdate_err']) && empty($data['enddate_err']) && empty($data['file_err'])) {
                $this->redirect('letters/checkAddLetter');
            } else {
                $this->view('letters/addletters', $data);
            }
        } else {
            $data = [
                'title' => '',
                'content' => '',
                'categoryuser' => '',
                'categoryletter' => '',
                'startdate' => '',
                'enddate' => '',
                'file' => '',
                'title_err' => '',
                'content_err' => '',
                'categoryuser_err' => '',
                'categoryLetter_er' => '',
                'startdate_err' => '',
                'enddate_err' => '',
                'file_err' => ''
            ];
            $this->view('letters/addletters', $data);
        }
    }
}
