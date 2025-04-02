<?php
class Promotion extends Controller {
    public function index() {
        $this->checkLogin('login_adm');
        $promotion = $this->service('PromotionService');
        $data['promotions'] = $promotion->getAllPromotions();
        $data['sidebar'] = 'sales';
        $data['menu'] = 'promotion';
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/promotion/index', $data);
        $this->view('templates/footerAdmin');
    }
    
    public function add(){
        $this->checkLogin('login_adm');
        $promotion = $this->service('PromotionService');
        $data['movies'] = $promotion->getMovies();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie = trim($_POST['movie']);
            $discount = $_POST['discount'];
            $start = $_POST['start'];
            $end = $_POST['end'];
            $note = trim($_POST['note']);
            $dataPost=[
                'movie'=>$movie,
                'discount'=>$discount,
                'start'=>$start,
                'end'=>$end,
                'note'=>$note
            ];

            // var_dump($select);
            $result = $promotion->addPromotion($dataPost) ;
            // var_dump($dataPost);
            if($result){
                $this->swal('Succes...', 'Promotion Has Been Added', 'success', 'promotion/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', '', 1);
            }
        }
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/promotion/addPromotion', $data);
        $this->view('templates/footerAdmin');
    }
    
    public function edit(){
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $promotion = $this->service('PromotionService');
            $data['promotion'] = $promotion->promotionById($id);
            $data['movies'] = $promotion->getMovies();

        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie = trim($_POST['movie']);
            $discount = $_POST['discount'];
            $start = $_POST['start'];
            $end = $_POST['end'];
            $note = trim($_POST['note']);
            $dataPost=[
                'id'=>$id,
                'movie'=>$movie,
                'discount'=>$discount,
                'start'=>$start,
                'end'=>$end,
                'note'=>$note
            ];

            // // var_dump($select);
            $result = $promotion->editPromotion($dataPost);
            if($result){
                $this->swal('Succes...', 'Promotion Has Been Updated', 'success', 'promotion/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', '', 1);
            }
        }
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/promotion/updatePromotion', $data);
        $this->view('templates/footerAdmin');
    }

    public function drop(){
        if(isset($_GET['data'])){
         $id = $_GET['data'];
         $data = $this->service('PromotionService');
        }
            $result = $data->deletePromotion($id);
            if($result){
                $this->swal('Succes...', 'Promotion Has Been Deleted', 'success', 'promotion/index', 1);
            }else{
                $this->swal('Oops...', 'There is something wrong', 'error', 'promotion/index', 1);
            }
    }
}