<?php
class Admin extends Controller {
    public function index() {
        $dashboard = $this->service('DashboardService');
        $cards = $dashboard->getDashboardData();
        $data = [
            'cards' => $cards,  // Entire $cards array
            'tables' => $cards['active_promotions']
        ];
        $this->checkLogin('login_adm');
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/index', $data);
        $this->view('templates/footerAdmin');
    }

    public function about() {
        $data['about'] = TRUE;
        $this->checkLogin('login_adm');
        $this->view('templates/headerAdmin', $data);
        $this->view('templates/sidebarAdmin');
        $this->view('admin/about');
        $this->view('templates/footerAdmin');
    }
}