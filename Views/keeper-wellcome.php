<?php
include_once('header.php');
include_once('nav-bar.php');
?>
<?php if(!empty($message)){ echo $message; }?>
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                
                <img src="<?php echo FRONT_ROOT.IMG_PATH."perroMalo3.jpeg"?>"class="d-block w-100" alt="..." >
                
                <div class="carousel-caption d-none d-md-block">
                    <h3>Now you are a keeper</h3>
                    <p>Be carefull</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                
                <img src="<?php echo FRONT_ROOT.IMG_PATH."perroMalo1.jpeg"?>"class="d-block w-100" alt="..." width="240">
                
                <div class="carousel-caption d-none d-md-block">
                    <h5>Now you are a keeper</h5>
                    <p>Don't you want to keep them?</p>
                </div>
            </div>
            <div class="carousel-item">
                
                <img src="<?php echo FRONT_ROOT.IMG_PATH."perroMalo2.jpeg"?>" class="d-block w-100" alt="..." >
                
                <div class="carousel-caption d-none d-md-block">
                    <h5>Now you are a keeper</h5>
                    <p>You can't escape</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php
include_once('footer.php');
?>