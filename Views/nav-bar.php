<?php
include_once('header.php');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"role="button" data-bs-toggle="dropdown" aria-expanded="false">Pet Hero</a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT. "User/ShowUser" ?>">My profile</a></li>
            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT."Home/Logout" ?>">Logout</a></li>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">My reservations</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT. "User/ShowUser" ?>">Show Keepers</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        My pets
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo FRONT_ROOT."Pet/ShowAddPetView" ?>">Add pet</a></li>
                        <li><a class="dropdown-item" href="<?php echo FRONT_ROOT."Pet/petListByOwnerId" ?>">Show my pets</a></li>
                    </ul>
                </li>
                <?php if($_SESSION["loggedUser"]->getUserTypeId() == "1") {?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo FRONT_ROOT. "Keeper/ShowAddView" ?>">Become a Keeper</a></li>
                <?php }else{ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Keeper Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT."Service/ShowAvailabilityView" ?>">Set my availability</a></li>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT."Calendar/ShowAvailabityCalendar" ?>">Availability calendar</a></li>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT."Booking/ShowBookings" ?>">Show my reservations</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>