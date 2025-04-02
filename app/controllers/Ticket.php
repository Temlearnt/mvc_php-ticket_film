<?php
class Ticket extends Controller {
    public function index() {
        $ticket = $this->service('TicketService');
        $this->checkLogin('login_adm');
        $data['tickets'] = $ticket->getAllTickets();
        $data['sidebar'] = 'sales';
        $data['menu'] = 'ticket';
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/ticket/index', $data);
        $this->view('templates/footerAdmin');
    }
    public function edit(){
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $ticket = $this->service('ticketService');
            $data['ticket'] = $ticket->getTicketById($id);
            $data['movie'] = $ticket->getAllMovies();
        }
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $name = trim($_POST['name']);
        //     $location = trim($_POST['location']);
        //     $dataPost=[
        //         'id'=>$id,
        //         'name'=>$name,
        //         'location'=>$location,
        //     ];

        //     $result = $ticket->editticket($dataPost);
        //     // var_dump($result);
        //     if($result){
        //         $this->swal('Succes...', 'Ticket Has Been Updated', 'success', 'ticket/index', 1);
        //     }else{
        //         $this->swal('Oops...', 'There is something wrong', 'error', '', 1);
        //     }
        // }
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/ticket/updateticket', $data);
        $this->view('templates/footerAdmin');
    }
}