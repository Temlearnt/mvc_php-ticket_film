<?php
class Payment extends Controller {
    public function index() {
        $payment = $this->service('PaymentService');
        $this->checkLogin('login_adm');
        $data['payments'] = $payment->getAllPayments();
        $data['sidebar'] = 'sales';
        $data['menu'] = 'payment';
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/payment/index', $data);
        $this->view('templates/footerAdmin');
    }

    public function edit(){
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $book = $this->service('PaymentService');
            $data['payments'] = $book->selectedById($id);
            $data['users'] = $book->userById($data['payments'][0]['user_id']);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $select = $_POST['status'];
            // var_dump($select);
            $result = $book->editStatus($select, $id);
            if($result){
                $this->swal('Succes...', 'Payment Has Been Updated', 'success', 'payment/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', '', 1);
            }
        }
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/payment/updatePayment', $data);
        $this->view('templates/footerAdmin');
    }
}