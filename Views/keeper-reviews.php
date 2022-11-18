<?php 
 include('header.php');
 include('nav-bar.php');
?>
            <div class="container">
                <br><br>
              <div class="row g-5">
                <div class="col-7 col-md-5">
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
              
              <div class="col-6 col-md-7">
                  <div class="bg-white rounded shadow-lg p-4 mb-4 clearfix graph-star-rating">
                    <h5 class="mb-1">All Ratings and Reviews</h5>
                    <br>
                    <div style="width: auto; height: 440px; overflow: auto; text-align: justify; padding: 20px;">
                    <?php
                        if($reviewList){ 
                        foreach($reviewList as $review){ 
                        $date = date_create($review->getDate());
                        $date = date_format($date, "D, d M Y");
                      ?>
                    <div class="reviews-members pt-4 pb-2">
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
                    <?php }}?>
                  </div>
                </div>
            </div>
        </div>

<br>
<div class="d-flex align-items-center justify-content-center pb-4">
  <p class="mb-0 me-2"></p>
      <button type="button" class="btn btn-outline-danger" onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
</div>


		<?php 
 include('footer.php');
?>