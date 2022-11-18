<?php 
    namespace Controllers;

    use Models\Review as Review;
    use DAO\ReviewDAO as ReviewDAO;
    use Controllers\BookingController as BookingController;

    Class ReviewController{
        public $reviewDAO;

        public function __construct(){
            $this->reviewDAO = new ReviewDAO();
        }

        public function Add($bookingId, $star, $comment){
            $bookingController = new BookingController();
            $booking = $bookingController->bookingDAO->GetById($bookingId);
            $review = new Review();
            $review->setOwner($booking->getUser());
            $review->setKeeper($booking->getKeeper());
            $review->setComment($comment);
            $review->setDate(date_create(date('y-m-d')));
            $review->setValoration($star);

            $this->reviewDAO->Add($review);

            $bookingController->bookingDAO->modifyBooking($booking->getId(), $booking->getMessage(), "Finished & reviewed");

            $bookingController->ShowBookingsUser();

        }

        public function ShowReviews(){
            $user = $_SESSION["loggedUser"];
            $keeperController = new KeeperController();
            $keeper = $keeperController->keeperDAO->GetByUser($user);
            $reviewList = $this->reviewDAO->GetReviewsByKeeper($keeper->getKeeperId());
            $avgReview = $this->reviewDAO->GetAvgByKeeper($keeper->getKeeperId());
            require_once(VIEWS_PATH . "keeper-reviews.php");
        }
    }


?>