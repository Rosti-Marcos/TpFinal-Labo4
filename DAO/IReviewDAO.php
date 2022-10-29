<?php

    namespace DAO;
    use Models\Review as Review;

    interface IReviewDAO {
        function GetAll();
        function Add(Review $review);
    }
?>