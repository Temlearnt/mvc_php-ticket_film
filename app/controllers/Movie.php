<?php
class Movie extends Controller {
    public function index() {
        $movies = $this->service('MovieService');
        $this->checkLogin('login_adm');
        $data['movies'] = $movies->getAllMovies();
        $data['sidebar'] = 'film';
        $data['menu'] = 'movie';
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/movie/index', $data);
        $this->view('templates/footerAdmin');
    }

    public function add(){
        $this->checkLogin('login_adm');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars(trim($_POST['title'] ?? ''));
            $genre = htmlspecialchars(trim($_POST['genre'] ?? ''));
            $release = $_POST['release'];
            $description = htmlspecialchars(trim($_POST['description'] ?? ''));
            $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
            $duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);  
            $image = $_FILES['file'];
            $data = [ 
                'title' => $title,
                'genre' => $genre,
                'release_date' => $release,
                'description' => $description,
                'rating' => $rating,
                'duration' => $duration,
                'poster' => $image
            ];
            $movie = $this->service('MovieService');
            $result = $movie->createMovie($data);
            if($result['status'] == true){
                $this->swal('Succes...', 'Movie Has Been Created', 'success', 'movie/index', 1);
            }else{
                $this->swal('Oops...', $result['message'], 'error', 'movie/add', 1);
            }
        }
        $data['sidebar'] = 'film';
        $data['menu'] = 'movie';
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/movie/addMovie');
        $this->view('templates/footerAdmin');
    }

    public function edit(){
        if(isset($_GET['data'])){
         $id = $_GET['data'];
         $movie = $this->service('MovieService');
         $data['movies'] = $movie->getMovie($id);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars(trim($_POST['title'] ?? ''));
            $genre = htmlspecialchars(trim($_POST['genre'] ?? ''));
            $release = $_POST['release'];
            $description = htmlspecialchars(trim($_POST['description'] ?? ''));
            $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
            $duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);  
            $image = $_FILES['file'];
            $movies = [ 
                'id' => $id,
                'title' => $title,
                'genre' => $genre,
                'release_date' => $release,
                'description' => $description,
                'rating' => $rating,
                'duration' => $duration,
                'poster' => $image
            ];
            $movie = $this->service('MovieService');
            $result = $movie->updateMovie($movies);
            if($result['status'] == true){
                $this->swal('Succes...', 'Movie Has Been Updated', 'success', 'movie/index', 1);
            }else{
                $this->swal('Oops...', $result['message'], 'error', 'movie/edit', 1);
            }
        }
        $data['sidebar'] = 'film';
        $data['menu'] = 'movie';
        $this->view('templates/headerAdmin');
        $this->view('templates/sidebarAdmin');
        $this->view('admin/movie/updateMovie', $data);
        $this->view('templates/footerAdmin');
    }
    public function drop(){
        if(isset($_GET['data'])){
         $id = $_GET['data'];
         $data = $this->service('MovieService');
         $getData = $data->getMovie($id);
        }
            $movies = [ 
                'id' => $getData['movie_id'],
                'poster' => $getData['poster']
            ];
            $movie = $this->service('MovieService');
            $result = $movie->deleteMovie($movies);
            if($result['status'] == true){
                $this->swal('Succes...', 'Movie Has Been Deleted', 'success', 'movie/index', 1);
            }else{
                $this->swal('Oops...', $result['message'], 'error', 'movie/index', 1);
            }
    }

}