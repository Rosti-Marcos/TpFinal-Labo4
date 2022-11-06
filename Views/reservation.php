<?php 
 include('header.php');
 include('nav-bar.php');
?>

	    <nav class="navtop">
	    	<div>
	    		<h1>Keeper Profile</h1>
	    	</div>
	    </nav>
      <?php if(!empty($message)){?>
            <h4 class = "alert alert-danger"><?php echo $message ?></h4>
        <?php } ?>
        <br>
        <div class="container">
        <div class="row">
            <div class="col-6 col-md-5">
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div style="text-align: center;">
                      <h4>Personal data</h4>
                    </div>
                    <hr>
                    <div class="col-sm-4">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                        <?php echo $user->getName() ?> <?php echo $user->getLastname() ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                        <?php echo $user->getEMail() ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                        <?php echo $user->getPhoneNumber() ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0">Age</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                    <?php $date1=date_create(date('Y-m-d'));
                          $date2=date_create($user->getBirthDate());
                        $diff=$date2->diff($date1); echo $diff->y." "."years"?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0">Pet size</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                        <?php echo $petSize->getPetSize() ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0">Price</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                        <?php echo $keeper->getRemuneration()."/day" ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0">Experience</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                    <?php $date1=date_create(date('Y-m-d'));
                          $date2=date_create($keeper->getStartDate());
                        $diff=$date2->diff($date1); echo $diff->y." "."years, ".$diff->m." months, ".$diff->d." days"?>
                    </div>
                  </div>
                </div>
              </div>
              <form action="<?php echo  FRONT_ROOT."Booking/MakeReservation"?>" method="post">
              <?php 
              $startDate = new DateTime();
              $max = new DateTime();
              $max->modify("365 days");
                ?>
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div style="text-align: center;">
                      <h4>Make Reservation</h4>
                    </div>
                    <hr>
                    <div class="col-sm-3">
                      <h6 class="mb-0">From</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" min=<?=$startDate->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> name="startDate" require>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">To</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" min=<?=$startDate->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> name="endDate" require>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Pet</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <?php 
                        $cont = 0;
                        if(!empty($petList)){
                        foreach($petList as $pet){
                            if($pet->getPetSize() == $petSize){
                                $cont++;
                            ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="<?php echo $pet->getPetId() ?>" value="<?php echo $pet->getPetId() ?>">
                              <label class="form-check-label" for="<?php echo $pet->getPetName() ?>"><?php echo $pet->getPetName() ?></label>
                            </div>
                        <?php }}} if($cont == 0){ ?>
                            "You do not have any pet size that the keeper takes care of."
                            <?php } ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Size</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <?php echo $petSize->getPetSize() ?>
                        <input type="hidden" name="petSizeId" value="<?php echo $petSize->getPetSizeId() ?>">
                        <input type="hidden" name="userId" value="<?php echo $user->getUserId() ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <?php if($cont > 0){
                        ?>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Book</button>
                    <?php }else{ ?>
                        <a class="btn btn-secondary">Book</a>
                        <?php } ?>
                  </div>
                </div>
              </div>
            </form>
            </div>
            </div>
            <div class="col-6 col-sm-7"
                <div class="content home">
                            <form action="<?php echo  FRONT_ROOT."Booking/PreReservation"?>" method="post">
                            <input type="hidden" name="userId" id="userId" value="<?php echo $user->getUserId() ?>">
                                <span class="form-label">Month</span>
                                        <select name="month" id="month">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11" selected >November</option>
                                        <option value="12">December</option>
                                        </select>
                                <span class="select-arrow"></span>
                                <button type="submit" class="submit-btn">Go</button>
                            </form>
                                <?=$calendar?>
                </div>
            </div>

</div>
<div class="d-flex align-items-center justify-content-center pb-4">
                  <p class="mb-0 me-2"></p>
                    <button type="button" class="btn btn-outline-danger"
                      onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                    </div>
         </div>
            
</div>

		<?php 
 include('footer.php');
?>
