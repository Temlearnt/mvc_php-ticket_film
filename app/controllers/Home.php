<?php
class Home extends Controller {
    public function index() {
        // Langsung gunakan MovieRepository di controller
        $recommendation = $this->service('LandingPageService');
        $data = 
        [
            'movies' => $recommendation->getRecommendMovies(),
            'coming' => $recommendation->getComing(),
            'theater' => $recommendation->getTheater(),
            'promotion' => $recommendation->getPromotion()
        ]
        ;

        $this->view('home/index', $data);
    }
}

