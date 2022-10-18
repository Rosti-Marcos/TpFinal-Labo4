<?php

    namespace DAO;
    use Models\Booking as Booking;

    interface IBookingDAO {
        function GetAll();
        function Add(Booking $booking);
    }
?>