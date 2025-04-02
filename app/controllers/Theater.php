<?php
class Theater extends Controller {
    public function index() {
        $theater = $this->service('TheaterService');
        $this->checkLogin('login_adm');
        $data['theaters'] = $theater->getAlltheaters();
        $data['sidebar'] = 'film';
        $data['menu'] = 'theater';
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/theater/index', $data);
        $this->view('templates/footerAdmin');
    }

    public function add(){
        $this->checkLogin('login_adm');
        $theater = $this->service('TheaterService');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $location = trim($_POST['location']);
            $dataPost=[
                'name'=>$name,
                'location'=>$location,
            ];

            // var_dump($select);
            $result = $theater->addTheater($dataPost) ;
            // var_dump($dataPost);
            if($result){
                $this->swal('Succes...', 'Theater Has Been Added', 'success', 'theater/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', '', 1);
            }
        }
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/theater/addTheater');
        $this->view('templates/footerAdmin');
    }
    
    public function edit(){
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $theater = $this->service('TheaterService');
            $data['theater'] = $theater->theaterById($id);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $location = trim($_POST['location']);
            $dataPost=[
                'id'=>$id,
                'name'=>$name,
                'location'=>$location,
            ];

            $result = $theater->editTheater($dataPost);
            // var_dump($result);
            if($result){
                $this->swal('Succes...', 'Theater Has Been Updated', 'success', 'theater/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', '', 1);
            }
        }
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/theater/updatetheater', $data);
        $this->view('templates/footerAdmin');
    }

    public function drop(){
        if(isset($_GET['data'])){
         $id = $_GET['data'];
         $data = $this->service('TheaterService');
        }
            $result = $data->deleteTheater($id);
            if($result){
                $this->swal('Succes...', 'Theater Has Been Deleted', 'success', 'theater/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', 'theater/index', 1);
            }
    }
}