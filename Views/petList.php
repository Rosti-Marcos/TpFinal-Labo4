<?php
include('header.php');
?>
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
    <a href="<?php echo FRONT_ROOT. "Home\ShowWellcomeView"?>">Back</a>
</main>
<?php
include('footer.php');
?>