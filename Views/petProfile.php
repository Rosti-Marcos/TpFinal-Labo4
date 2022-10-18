
<div>
    <p>

        <?php echo $pet->GetPetName()?>
        <?php echo $pet->GetPetBreed()?>
        <?php echo $pet->GetObservation()?>
        <img src="<?php echo HOME_URL.FRONT_ROOT.$pet->getVaccineCertId()?>" height="240">
        <?php echo $pet->GetPetTypeId()?>
        <img src="<?php echo HOME_URL.FRONT_ROOT.$pet->GetPetPics()?>" height="240">
        <video controls alt= "no hay video" width="320" height="240"><source src="<?php echo HOME_URL.FRONT_ROOT.$pet->GetPetVideo()?>">


    </p>
</div>






