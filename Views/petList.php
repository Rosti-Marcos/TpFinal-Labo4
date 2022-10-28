<?php
include('header.php');
include ('nav-bar.php');
?>
<body background="<?php echo FRONT_ROOT . IMG_PATH . "bgFootprints.jpeg"?>">
<main>
    <h1 align="center">My Pets</h1>
    <ul class="petList">
       <?php foreach ($petList as $pet){?>
        <li>
            <a href="<?php echo FRONT_ROOT . "Pet\ShowPetProfile" . "/" . $pet->GetPetId()?>">
            <h2><?php echo $pet->GetPetName()?></h2>
            <img src="<?php echo HOME_URL.FRONT_ROOT.$pet->GetPetPics()?>" height="180">
            </a>
        </li>
        <?php } ?>
    </ul>
    
    <div class="row justify-content-end">
        <div class="d-flex align-items-center justify-content-center pb-4">
            <p class="mb-0 me-2"></p>
            <button type="button" class="btn btn-outline-danger"
                    onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
        </div>
    </div>
</main>
<?php
include('footer.php');
?>