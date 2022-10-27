<?php 
 include('header.php');
 include('nav-bar.php');
?>
	    <nav class="navtop">
	    	<div>
	    		<h1>Keeper Profile</h1>
	    	</div>
	    </nav>
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
                      <h6 class="mb-0">Specie</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <?php foreach($petSpecieList as $petSpecie){?>
                            <input type="radio" class="btn-check" name="petSpecieId" id="option.<?php echo $petSpecie->getPetSpecieId() ?>" autocomplete="off" value="<?php echo $petSpecie->getPetSpecieId() ?>" checked />
                            <label class="btn btn-secondary" for="option.<?php echo $petSpecie->getPetSpecieId() ?>"><?php echo $petSpecie->getPetSpecie() ?></label>
                        <?php } ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Size</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <select id="petSizeId" name="petSizeId">
                        <?php foreach($petSizeList as $petSize){?>
                            <option value="<?php echo $petSize->getPetSizeId()?>"><?php echo $petSize->getPetSize()?></option>
                            <?php } ?>
                            <input type="hidden" name="userId" value="<?php echo $user->getUserId() ?>">
                        </select>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Book</button>
                  </div>
                </div>
              </div>
            </form>
            </div>
            </div>
            <div class="col-6 col-sm-7"
                <div class="content home">
                            <form action="<?php echo  FRONT_ROOT."Calendar/showAvailabilityCalendar"?>" method="post">
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
                                        <option value="10" selected>October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                        </select>
                                <span class="select-arrow"></span>
                                <button type="submit" class="submit-btn">Go</button>
                            </form>
                                <?=$calendar?>
                </div>
            </div>

</div>
            
</div>

		<?php 
 include('footer.php');
?>