<?php
class Customer extends Controller
{
    public function index()
    {
        $this->checkLogin('login_cust');
        // Langsung gunakan MovieRepository di controller
        $recommendation = $this->service('CustomerService');
        $data =
            [
                'movies' => $recommendation->getRecommendMovies(),
                'coming' => $recommendation->getComing(),
                'theater' => $recommendation->getTheater(),
                'promotion' => $recommendation->getPromotion()
            ];

        $this->view('customer/index', $data);
    }
    public function movies()
    {
        $this->checkLogin('login_cust');
        $movies = $this->service('CustomerService');
        $data['movies'] = $movies->getMovies();
        $this->view('customer/movies', $data);
    }

    public function book()
    {
        $this->checkLogin('login_cust');
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $book = $this->service('BookingService');
            $data['book'] = $book->getSchedule($id);
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataPost = json_decode(file_get_contents('php://input'), true);
            $result = $book->saveBooking($dataPost);
        
            if ($result['status'] === 'success') {
                $hashId = $result['id'];
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'id' => $hashId,
                ]);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => $result['message'],
                ]);
                exit;
            }
        }
        
        $this->view('customer/bookMovie', $data);
    }

    public function seats(){

        $this->checkLogin('login_cust');
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $book = $this->service('BookingService');
            $data['book'] = $book->getDataBookingById($id);
            $data['seats'] = $book->getSelectedSeats($data['book']['details']['schedule_id']);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataPost = json_decode(file_get_contents('php://input'), true);
            $result = $book->saveSelectedSeats($dataPost);
        
            if ($result['status'] === 'success') {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                ]);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => $result['message'],
                ]);
                exit;
            }
        }
        $this->view('customer/chooseSeat', $data);
    }

    public function payment(){
        $this->checkLogin('login_cust');
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $book = $this->service('BookingService');
            $data['book'] = $book->getDataBookingById($id);
            $data['promotions'] = $book->getPromotions($data['book']['details']['movie_id']);
            $data['schedule'] =$book->getSelectedSchedule($data['book']['details']['schedule_id']);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_SESSION['user_session'];
            $schedule = $data['book']['details']['schedule_id'];
            $seatsString = implode(",", $data['book']['details']['number_seats']);
            $promotion_id = $_POST['voucher'];
            $method = $_POST['method'];
            $ticketData = [
                'user_id' => $user['user_id'], // Assuming user session contains user_id
                'schedule_id' => $schedule,
                'seats' => $seatsString
            ];
            $saveTicket = $book->insertTicket($ticketData);
            $qty = count($data['book']['details']['number_seats']);
            if ($promotion_id == "0") {
                $promotion = $book->getPromotionbyId($promotion_id);
            
                // Check if the promotion is not empty and contains data
                if (!empty($promotion) && isset($promotion[0])) {
                    $amount = ($data["schedule"][0]["price"] * $qty) - (($data["schedule"][0]["price"] * $qty) * $promotion[0]['discount_percentage'] / 100);
                } else {
                    // Handle the case when no promotion is found
                    // For example, set amount without discount or some fallback logic
                    $amount = $data["schedule"][0]["price"] * $qty;
                }
            } else {
                $amount = $data["schedule"][0]["price"] * $qty;
            }
            $paymentData =[
                'ticket' => $saveTicket,
                'method' => $method,
                'amount' => $amount,
            ];
            // var_dump($paymentData);
            $bookingMovie = $book->insertPayment($paymentData);
            if($bookingMovie['status'] == true){
                $this->swal('Succes...', $bookingMovie['message'], 'success', 'customer/movies', 1);
            }else{
                $this->swal('Oops...', $bookingMovie['message'], 'error', '', 1);
            }
        }
        $this->view('customer/payment', $data);
    }

    public function ticket(){
        $this->checkLogin('login_cust');
        $user = $_SESSION['user_session'];
        $ticket = $this->service('CustomerService');
        $data['tickets'] = $ticket->getHistoryBooking($user['user_id']);
        $this->view('customer/tickets', $data);
    }

    public function print(){
        $this->checkLogin('login_cust');
        $ticket = $this->service('CustomerService');
        $data['user'] = $_SESSION['user_session'];
        if (isset($_GET['data'])) {
            $id = $_GET['data'];
            $data['payments'] = $ticket->getSelectedTicketByPaymentId($id);
        }
        $this->view('customer/printTicket', $data);
    }
}
