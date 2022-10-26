<?php
include ('nav-bar.php');
?>
<header>
    <link href="<?php echo CSS_PATH . "addPet.css" ?>" rel="stylesheet">
</header>
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Add your pet</h3>
            <p class="blue-text">When you are done<br> you will see your pet on your list</p>
            <div class="card">
                <h5 class="text-center mb-4">Your pet data</h5>
                <form class="form-card" action="<?php echo FRONT_ROOT . "Pet\Add" ?>" method="post" enctype="multipart/form-data">

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Your pet name
                                <span class="text-danger"> *</span>
                            </label>
                            <input type="text" name="petName" size="30" placeholder="name..." required>
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Yor pet breed
                                <span class="text-danger"> *</span>
                            </label>
                            <input type="text" name="petBreed" placeholder="Breed" required>
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Your pet size
                                <span class="text-danger"> *</span>
                            </label>
                            <select id="petSizeId" name="petSizeId">
                                <?php foreach($petSizeList as $petSize){?>
                                <option value="<?php echo $petSize->getPetSizeId()?>"><?php echo $petSize->getPetSize()?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Your pet photo
                                <span class="text-danger"> *</span>
                            </label>
                            <input accept="image/png,image/jpeg,image/gif" type="file" name="petPics" id="petPics" required>
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Your pet health certificate
                                <span class="text-danger"> *</span>
                            </label>
                            <input accept="image/png,image/jpeg" type="file" name="vaccineCertId" id="vaccineCertId" required>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Your pet video (optional)
                                <span class="text-danger"></span>
                            </label>
                            <input accept="video/mp4" type="file" name="petVideo" id="petVideo">
                        </div>
                    </div>
                    <br>               
                    <div class="btn-group">
                        <?php foreach($petSpecieList as $petSpecie){?>
                        <input type="radio" class="btn-check" name="petSpecie" id="option.<?php echo $petSpecie->getPetSpecieId() ?>" autocomplete="off" value="<?php echo $petSpecie->getPetSpecieId() ?>" checked />
                        <label class="btn btn-secondary" for="option.<?php echo $petSpecie->getPetSpecieId() ?>"><?php echo $petSpecie->getPetSpecie() ?></label>
                        <?php } ?>
                    </div>                   
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex">
                            <label class="form-control-label px-3">Some observations
                                <span class="text-danger"> </span>
                            </label>
                            <textarea cols="50" rows="2" type="text" name="observation" placeholder="Please insert your additional info"></textarea>
                        </div>
                    </div>
                        <div class="row justify-content-end">
                            <div> <button type="submit" class="enviar">Add Pet</button> </div>
                        </div>
                    <div class="row justify-content-end">
                        <div>
                            <button type="button" class="enviar" onclick="location.href= '<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>