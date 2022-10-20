<?php
include('header.php');
include ('nav-bar.php');
?>
<div>
    <p>

    <h1>Name: <?php echo $pet->GetPetName()?></h1>
    <h3>I'm a: <?php echo $pet->GetPetBreed()?></h3>
    <h3>My owner comments: <?php echo $pet->GetObservation()?></h3>
    <h3>My healt certificate: <img src="<?php echo HOME_URL.FRONT_ROOT.$pet->getVaccineCertId()?>" height="240"></h3>
    <h3>Here I am!! <img src="<?php echo HOME_URL.FRONT_ROOT.$pet->GetPetPics()?>" height="240"></h3>
    <h3>My video! <video controls alt= "no hay video" width="320" height="240"><source src="<?php echo HOME_URL.FRONT_ROOT.$pet->GetPetVideo()?>"></h3>


    </p>
</div>
<a href="<?php echo FRONT_ROOT. "Home\ShowWellcomeView"?>">Back</a>
<?php
include('footer.php');
?>




