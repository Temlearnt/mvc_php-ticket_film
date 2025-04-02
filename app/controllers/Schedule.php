<?php
class Schedule extends Controller {
    public function index() {
        $schedule = $this->service('ScheduleService');
        $this->checkLogin('login_adm');
        $data['schedules'] = $schedule->getAllSchedules();
        $data['sidebar'] = 'film';
        $data['menu'] = 'schedule';
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/schedule/index', $data);
        $this->view('templates/footerAdmin');
    }

    public function add() {
        $schedule = $this->service('ScheduleService');
        $this->checkLogin('login_adm');
        $getData = $schedule->getMovienTheaterData();
        $data = [
            'movies' => $getData['movies_list'],
            'theaters' => $getData['theaters_list']
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie = $_POST['movie'];
            $theater = $_POST['theater'];
            $show = $_POST['show'];
            $price = $_POST['price'];
            $dataPost=[
                'movie'=>$movie,
                'theater'=>$theater,
                'show'=>$show,
                'price'=>$price,
            ];

            // var_dump($select);
            $result = $schedule->addSchedule($dataPost) ;
            // var_dump($dataPost);
            if($result){
                $this->swal('Succes...', 'Schedule Has Been Added', 'success', 'schedule/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', '', 1);
            }
        }
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/schedule/addSchedule', $data);
        $this->view('templates/footerAdmin');
    }

    public function edit(){
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $schedule = $this->service('ScheduleService');
            $this->checkLogin('login_adm');
            $getSchedule = $schedule->scheduleById($id);
            $getData = $schedule->getMovienTheaterData();
            $data = [
                'schedule' => $getSchedule,
                'movies' => $getData['movies_list'],
                'theaters' => $getData['theaters_list']
            ];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie = $_POST['movie'];
            $theater = $_POST['theater'];
            $show = $_POST['show'];
            $price = $_POST['price'];
            $dataPost=[
                'id' => $id,
                'movie'=>$movie,
                'theater'=>$theater,
                'show'=>$show,
                'price'=>$price,
            ];

            // // var_dump($select);
            $result = $schedule->editSchedule($dataPost);
            if($result){
                $this->swal('Succes...', 'Schedule Has Been Updated', 'success', 'schedule/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', '', 1);
            }
        }
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/schedule/updateSchedule', $data);
        $this->view('templates/footerAdmin');
    }

    public function drop(){
        if(isset($_GET['data'])){
         $id = $_GET['data'];
         $schedule = $this->service('ScheduleService');
        }
            $result = $schedule->deleteSchedule($id);
            if($result){
                $this->swal('Succes...', 'Schedule Has Been Deleted', 'success', 'schedule/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', 'schedule/index', 1);
            }
    }
    
}