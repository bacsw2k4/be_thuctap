<?php
class DashboardController extends BaseController
{
    private $dashboardModel;
    public function __construct()
    {
        parent::__construct();
        $this->dashboardModel = $this->model('DashboardModel');
    }
    public function showDashboard()
    {
        $categoryuser = $_SESSION['user_category'];
        $department = $_SESSION['user_department'];
        $letters = $this->dashboardModel->getLetter($categoryuser, $department);
        $data = [
            'letters' => $letters
        ];

        $this->view('dashboard/dashboard', $data);
    }
}