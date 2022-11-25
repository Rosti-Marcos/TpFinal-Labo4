<?php 
 include('header.php');
 include('nav-bar.php');
?>

      <nav class="navtop">
        <div>
          <h1>Keeper Profile</h1>
        </div>
       </nav>

       <?php if($message != ""){ echo "<script>alert('$message');</script>"; }?>

      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Personal Data</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Book</button>
        </div>
      </nav>

    <!-********* Seccion TABS **********->
    <div class="tab-content" id="nav-tabContent">
      
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <br>
            <div class="container">
              <div class="row g-5">
                <div class="col-7 col-md-5">
                    <div class="bg-white rounded shadow-lg p-5 mb-5 clearfix graph-star-rating">
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
                                  <?php echo $remuneration."/day" ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Experience</h6>
                              </div>
                              <div class="col-sm-6 text-secondary">
                              <?php echo $experience->y." "."years, ".$experience->m." months, ".$experience->d." days";?>
                              </div>
                            </div>
                            <br>
                      </div>
                    </div> 
                </div>
                <div class="col-6 col-md-7">
                  <div class="bg-white rounded shadow-lg p-4 mb-4 clearfix graph-star-rating">
                      <h5 class="mb-0 mb-4">Ratings and Reviews</h5>
                      <div class="graph-star-rating-header">
                          <div class="star-rating">
                              <a href="#"><i class="icofont-ui-rating"></i></a> <b class="text-black ml-2"><?php echo count($reviewList)?> Reviews</b>
                          </div>
                          <p class="text-black mb-4 mt-2">Rated <?php echo ($avgReview) ? number_format($avgReview[0]->getValoration(), 2) : 0 ?> out of 5</p>
                      </div>
                      <?php 
                          $oneStar = 0;
                          $twoStars = 0;
                          $threeStars = 0;
                          $fourStars = 0;
                          $fiveStars = 0;
                          foreach($reviewList as $review){ 
                            switch($review->getValoration()){
                              case 1:
                                $oneStar++;
                                break;
                              case 2:
                                $twoStars++;
                                break;
                              case 3:
                                $threeStars++;
                                break;
                              case 4:
                                $fourStars++;
                                break;
                              case 5:
                                $fiveStars++;
                                break;
                            }
                        }?>
                      <div class="graph-star-rating-body">
                          <div class="rating-list">
                              <div class="rating-list-left text-black">
                                <div class="ratings">
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                </div>
                              </div>
                              <div class="rating-list-center">
                                  <div class="progress">
                                      <div style="width: <?php echo $fiveStars / count($reviewList) *100?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                      </div>
                                  </div>
                              </div>
                              <div class="rating-list-right text-black"><?php echo $fiveStars > 0 ? number_format($fiveStars / count($reviewList) *100, 2) : 0?>%</div>
                          </div>
                          <div class="rating-list">
                              <div class="rating-list-left text-black">
                                <div class="ratings">
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star"></i>
                                </div>
                              </div>
                              <div class="rating-list-center">
                                  <div class="progress">
                                      <div style="width: <?php echo $fourStars / count($reviewList) *100?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                          <span class="sr-only">80% Complete (danger)</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="rating-list-right text-black"><?php echo $fourStars > 0 ? number_format($fourStars / count($reviewList) *100, 2) : 0?>%</div>
                          </div>
                          <div class="rating-list">
                              <div class="rating-list-left text-black">
                                <div class="ratings">
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                </div>
                              </div>
                              <div class="rating-list-center">
                                  <div class="progress">
                                      <div style="width: <?php echo $threeStars / count($reviewList) *100?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                          <span class="sr-only">80% Complete (danger)</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="rating-list-right text-black"><?php echo $threeStars > 0 ? number_format($threeStars / count($reviewList) *100, 2) : 0?>%</div>
                          </div>
                          <div class="rating-list">
                              <div class="rating-list-left text-black">
                                <div class="ratings">
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                </div>
                              </div>
                              <div class="rating-list-center">
                                  <div class="progress">
                                      <div style="width: <?php echo $twoStars / count($reviewList) *100?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                          <span class="sr-only">80% Complete (danger)</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="rating-list-right text-black"><?php echo $twoStars > 0 ? number_format($twoStars / count($reviewList) *100, 2) : 0?>%</div>
                          </div>
                          <div class="rating-list">
                              <div class="rating-list-left text-black">
                                <div class="ratings">
                                  <i class="fa fa-star rating-color"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i>
                                </div>
                              </div>
                              <div class="rating-list-center">
                                  <div class="progress">
                                      <div style="width: <?php echo $oneStar / count($reviewList) *100?>%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                          <span class="sr-only">80% Complete (danger)</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="rating-list-right text-black"><?php echo $oneStar > 0 ? number_format($oneStar / count($reviewList) *100, 2) : 0?>%</div>
                          </div>
                      </div>
                  </div>            
              </div>
              </div>
              
              <div class="bg-white rounded shadow-lg p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                    <h5 class="mb-1">All Ratings and Reviews</h5>
                    <br>
                    <div style="width: auto; height: 440px; overflow: auto; text-align: justify; padding: 20px;">
                    <?php
                        if(!empty($reviewList)){ 
                        foreach($reviewList as $review){ 
                        $date = date_create($review->getDate());
                        $date = date_format($date, "D, d M Y");
                      ?>
                    <div class="reviews-members pt-4 pb-4">
                        <div class="media">
                            <div class="media-body">
                                <div class="reviews-members-header">
                                    <h6 class="mb-1"><a class="text-black"><?php echo $review->getOwner()->getName() . " " . $review->getOwner()->getLastName()?></a></h6>
                                    <p class="text-gray"><?php echo $date?></p>
                                </div>
                                <div class="ratings">
                                <td style="text-align: center;">
                                <?php
                                      $valoration = $review->getValoration();
                                        for($i = 0 ; $i < 5 ; $i++){
                                            if($valoration > 0){
                                                ?>
                                                <i class="fa fa-star rating-color" style="font-size:20px;"></i>
                                        <?php   $valoration = $valoration - 1; 
                                            }else{ ?>
                                                <i class="fa fa-star" style="font-size:20px;"></i>
                                    <?php }}?>
                            <td><label class="<?php echo $class?>"></label></td>
                            </td>
                            </div>
                                <div class="reviews-members-body">
                                  <br>
                                    <i><?php echo "''" .$review->getComment(). "''"?> </i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr> 
                    <?php }}else{?>
                      <i>This keeper still has no reviews.</i>
                      <?php }?>
                </div>               
            </div>
            </div>
      </div>        
      
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div class="container">
          <div class="row">
            <div class="col-6 col-md-5">
              <div class="col-md-10">
                <br><br><br><br><br>
                <div class="bg-white rounded shadow-lg p-5 mb-5 clearfix graph-star-rating">
                  <div class="card-body">
                    <form action="<?php echo  FRONT_ROOT."Booking/MakeReservation"?>" method="post">
                     <?php 
                      $startDate = new DateTime();
                       $max = new DateTime();
                        $max->modify("365 days");
                         ?>
                              <div class="row">
                                <div style="text-align: center;">
                                  <h4>Book</h4>
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
                                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="<?php echo $pet->getPetId() ?>" value="<?php echo $pet->getPetId() ?>" required>
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
                    </form>
                  </div>
                </div>
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
        </div>
      </div>
      <!-********* FIN Seccion TABS **********->



<br>
<div class="d-flex align-items-center justify-content-center pb-4">
  <p class="mb-0 me-2"></p>
      <button type="button" class="btn btn-outline-danger" onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
</div>


		<?php 
 include('footer.php');
?>


