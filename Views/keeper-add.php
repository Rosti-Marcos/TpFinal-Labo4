<?php
include ('nav-bar.php');
?>
<header>
    <link href="<?php echo CSS_PATH . "turningToKeeper.css" ?>" rel="stylesheet">
</header>

<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            
            <div class="card">
                <h5 class="text-center mb-4">Your preferences</h5>
                <form class="form-card" action="<?php echo  FRONT_ROOT . "Keeper\Add "?>" method="post">

                    
                    <div >
                        <label class="form-control-label px-3">Pet size allowed
                            <span class="text-danger"> *</span>
                        </label>
                        <select id="petSizeId" name="petSizeId" required>
                            <?php foreach($petSizeList as $petSize){?>
                            <option value="<?php echo $petSize->getPetSizeId()?>"><?php echo $petSize->getPetSize()?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>                
                    <div >
                        <label class="form-control-label px-3">Your Remuneration
                            <span class="text-danger"> *</span>
                        </label>
                        <input type="number" name="remuneration" min="0" required>
                    </div>            
                    <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Go!</button>
                    </div>
                    <div class="row justify-content-end">
                        <div class="d-flex align-items-center justify-content-center pb-4">
                            <p class="mb-0 me-2"></p>
                            <button type="button" class="btn btn-outline-danger"
                                    onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
