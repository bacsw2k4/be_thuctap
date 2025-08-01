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
        $letters = $this->dashboardModel->getLetter();
        $data = [
            'letters' => $letters
        ];

        $this->view('dashboard/dashboard', $data);
    }
}