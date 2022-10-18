<?php

    if(!isset($_SESSION["loggedUser"])) {
        header("location:..home.php");
    }
?>