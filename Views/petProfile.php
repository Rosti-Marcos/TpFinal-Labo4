<?php

include ('nav-bar.php');
?>
<header>
    <link href="<?php echo CSS_PATH . "profileStyle.css" ?>" rel="stylesheet">
</header>
<div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card p-0">
                    <div class="card-image">
                    <img src="<?php echo HOME_URL.FRONT_ROOT.$pet->GetPetPics()?>?auto=compress&cs=tinysrgb&dpr=1&w=500"
                            alt="">
                    </div>
                    <div class="card-content d-flex flex-column align-items-center">
                        <h4 class="pt-2">My name is <?php echo $pet->GetPetName()?></h4>
                        <h5>I'm a <?php echo $pet->GetPetBreed()?></h5>

                        <ul class="social-icons d-flex justify-content-center">
                            <li style="--i:1">
                                <a href="#">
                                    <span class="fab fa-facebook"></span>
                                </a>
                            </li>
                            <li style="--i:2">
                                <a href="#">
                                    <span class="fab fa-twitter"></span>
                                </a>
                            </li>
                            <li style="--i:3">
                                <a href="#">
                                    <span class="fab fa-instagram"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-0">
                    <div class="card-image">
                    <video controls alt= "no hay video"  height="350"><source src="<?php echo HOME_URL.FRONT_ROOT.$pet->GetPetVideo()?>">
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-0">
                    <div class="card-image">
                        <img src="<?php echo HOME_URL.FRONT_ROOT.$pet->getVaccineCert()?>?auto=compress&cs=tinysrgb&dpr=1&w=500"
                            alt="">
                    </div>
                    <div class="card-content d-flex flex-column align-items-center">
                        <h4 class="pt-2">My Health</h4>
                        <h5>Certificate</h5>

                        <ul class="social-icons d-flex justify-content-center">
                            <li style="--i:1">
                                <a href="#">
                                    <span class="fab fa-facebook"></span>
                                </a>
                            </li>
                            <li style="--i:2">
                                <a href="#">
                                    <span class="fab fa-twitter"></span>
                                </a>
                            </li>
                            <li style="--i:3">
                                <a href="#">
                                    <span class="fab fa-instagram"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
