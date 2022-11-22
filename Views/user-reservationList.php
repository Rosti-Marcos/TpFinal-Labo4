<?php 
 include('header.php');
 include('nav-bar.php');
?>
<body background="<?php echo FRONT_ROOT . IMG_PATH . "wallpaperbetter.jpg"?>">
<div id="service" class="section">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Reservation List</h2>
				</div>
			</div>
            <div class="container">       
        <div class="row justify-content-md-center">
            <div class="col-6 col-md-12">
              <div class="card mb-12">
                <div class="card-body">
                  <div class="row">
				  	 <div class="col-sm-4" style="text-align: center;">
				  		<h5 class="mb-2" style="border-right: 1px solid grey">Bookings Filter</h5>
                     </div>
                    	<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."Finished"?>" class="btn btn-dark" for="option.finished" value="finished">Finished</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."Approved"?>" class="btn btn-success" for="option.approved">Approved</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."Approved (Pending payment)"?>" class="btn btn-primary" for="option.pendingPayment">Pending Payment</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."Pending"?>" class="btn btn-warning" for="option.pending" value="pending">Pending</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."Rejected"?>" class="btn btn-danger" for="option.rejected">Rejected</a>
                        </div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."Unanswered"?>" class="btn btn-secondary" for="option.unanswered">Unanswered</a>
                        </div>
                     </div>           
              		</div>
            	</div>
            </div>
        </div>
		<br/>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th style="text-align: center;">Keeper</th>
						      <th style="text-align: center;">Start date</th>
						      <th style="text-align: center;">End date</th>
						      <th style="text-align: center;">Price</th>
						      <th style="text-align: center;">Status</th>
							  <th style="text-align: center;">Message</th>
							  <th style="text-align: center;">Action</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
						  	if(!empty($bookingList))
							foreach($bookingList as $booking)
							{
                                $name;
                                $lastName;
                                foreach($keeperList as $keeper){
                                    if($booking->getKeeper()->getKeeperId() == $keeper->getKeeperId()){
                                        $name = $keeper->getUser()->getName();
                                        $lastName = $keeper->getUser()->getLastname();
                                    }
                                }
								?>
								<tr>
									<td style="text-align: center;"><?php echo $name." ".$lastName ?></td>
									<td style="text-align: center;"><?php echo $booking->getStartDate() ?></td>
									<td style="text-align: center;"><?php echo $booking->getEndDate() ?></td>
									<td style="text-align: center;"><?php echo $booking->getPrice() ?></td>
									<?php
										$class = "";
										switch ($booking->getStatus()) {
											case 'Approved (Pending payment)': 
												$class = "btn btn-primary";
												break;
											case 'Approved (Payed)':
												$class = "btn btn-primary";
												break;
											case 'Pending':
												$class =  "btn btn-warning";
												break;
											case 'Rejected':
												$class =  "btn btn-danger"; 
												break;
                                            case 'Finished':
                                                $class =  "btn btn-secondary"; 
                                                break;
											case 'Finished & reviewed':
												$class =  "btn btn-dark"; 
												break;
                                            case 'Unanswered':
                                                $class = "btn btn-secondary"; 
                                                break;

										}
									?>
									<td style="text-align: center;">
										<a class="<?php echo $class?>"><?php echo $booking->getStatus() ?></a>
									</td>
									<td style="text-align: center;"><?php echo $booking->getMessage() ?></td>

									<?php if($booking->getStatus() == 'Finished' && $booking->getStatus() != 'Finished & reviewed'){
										?>
									<td style="text-align: center;">
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
									Review
									</button>

									<!-- Modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header modal-header-success">
											<h5 style="text-align: center;" id="exampleModalLabel">What do you think about my service?</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<div class="stars">
													<form action="<?php echo FRONT_ROOT. "Review/Add"?>">
														<input type="hidden" value="<?php echo $booking->getId()?>" name="bookingId">

														<input class="star star-5" id="star-5" type="radio" name="star" value="5" required>
														<label class="star star-5" for="star-5"></label>

														<input class="star star-4" id="star-4" type="radio" name="star" value="4" required>
														<label class="star star-4" for="star-4"></label>

														<input class="star star-3" id="star-3" type="radio" name="star" value="3" required>
														<label class="star star-3" for="star-3"></label>

														<input class="star star-2" id="star-2" type="radio" name="star" value="2" required>
														<label class="star star-2" for="star-2"></label>

														<input class="star star-1" id="star-1" type="radio" name="star" value="1" required>
														<label class="star star-1" for="star-1"></label>

														<div class="form-outline">
															<textarea class="form-control" id="textAreaExample" rows="4" placeholder="Add comment" name="comment"></textarea>
														</div>
													</div>	
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Send</button>
										</div>
										</div>
										</form>
									</div>
									</div>
									</td>
									<?php }else{
										?>
										<td style="text-align: center;">
										<button type="button" class="btn btn-secondary">
											Review
										</button>
										</td>
								</tr>
								<?php
							}}
							?> 
						  </tbody>
						</table>
					</div>
				</div>
			  </form>
			</div>
		</div>
        <div class="d-flex align-items-center justify-content-center pb-4">
                  <p class="mb-0 me-2"></p>
                    <button type="button" class="btn btn-outline-danger"
                      onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                    </div>
         </div>
	</section>

	<?php 
 include('footer.php');
?>
