<?php 
 include('header.php');
 include('nav-bar.php');
?>
<div id="service" class="section">
<body background="<?php echo FRONT_ROOT . IMG_PATH . "bgPerroBlanco.jpg"?>">
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
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsKeeperByStatus/"."Finished"?>" class="btn btn-dark" for="option.finished" value="finished">Finished</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsKeeperByStatus/"."Finishedreviewed"?>" class="btn btn-dark" for="option.finished" value="finished">Finished Reviewed</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsKeeperByStatus/"."Approved (Payed)"?>" class="btn btn-success" for="option.approved">Approved (Payed)</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsKeeperByStatus/"."Approved (Pending payment)"?>" class="btn btn-success" for="option.pendingPayment">Pending Payment</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsKeeperByStatus/"."Pending"?>" class="btn btn-warning" for="option.pending" value="pending">Pending</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsKeeperByStatus/"."Rejected"?>" class="btn btn-danger" for="option.rejected">Rejected</a>
                        </div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsKeeperByStatus/"."Unanswered"?>" class="btn btn-secondary" for="option.unanswered">Unanswered</a>
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
						      <th style="text-align: center;">Customer</th>
						      <th style="text-align: center;">Start date</th>
						      <th style="text-align: center;">End date</th>
						      <th style="text-align: center;">Price</th>
							  <th style="text-align: center;">Specie</th>
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
                                foreach($userList as $user){
                                    if($booking->getUser()->getUserId() == $user->getUserId()){
                                        $name = $user->getName();
                                        $lastName = $user->getLastname();
                                    }
                                }
								?>
								<tr>
									<td style="text-align: center;"><?php echo $name." ".$lastName ?></td>
									<td style="text-align: center;"><?php echo $booking->getStartDate() ?></td>
									<td style="text-align: center;"><?php echo $booking->getEndDate() ?></td>
									<td style="text-align: center;"><?php echo $booking->getPrice() ?></td>
									<td style="text-align: center;"><?php echo $booking->getPet()->getPetSpecie()->getPetSpecie() ?></td>
									<?php
										$class = "";
										switch ($booking->getStatus()) {
											case 'Approved (Pending payment)': 
												$class = "btn btn-success";
												break;
											case 'Approved (Payed)':
												$class = "btn btn-success";
												break;
											case 'Pending':
												$class =  "btn btn-warning";
												break;
											case 'Rejected':
												$class =  "btn btn-danger"; 
												break;
											case 'Finished':
												$class =  "btn btn-dark"; 
												break;
											case 'Finished & reviewed':
												$class =  "btn btn-dark"; 
												break;
											case 'Unanswered':
												$class = "btn btn-secondary"; 
												break;
										}
									?>
									<td style="text-align: center;"">
										<a class="<?php echo $class?>"><?php echo $booking->getStatus() ?></a>
									</td>
									<?php
										if($booking->getStatus() == 'Pending'){
											?>
										<form action="<?php echo FRONT_ROOT."Booking/ReplyBooking" ?>" method="POST">
											<td style="text-align: center;"> 
												<input type="hidden" name="bookingId" id="bookingId" value="<?php echo $booking->getId() ?>">
												<input type="text" name="message" size="20" required>
											</td>
											<td style="text-align: center;">
												<button type="submit" name="approve" class="btn btn-success" value="Approve"> Approve </button>
												<button type="submit" name="decline" class="btn btn-danger" value="Decline"> Reject </button>
											</td>
										</form>
									<?php
										}else if($booking->getStatus() != 'Finished & reviewed'){
											?>
											<td  style="text-align: center;"><?php echo $booking->getMessage() ?></td>
											<td style="text-align: center;">
											<a class="btn btn-secondary"><?php echo $booking->getStatus() ?></a>
											</td>
									<?php }else{ ?>
											<td  style="text-align: center;"><?php echo $booking->getMessage() ?></td>
											<td style="text-align: center;">
											<a href="<?php echo FRONT_ROOT."Review/ShowReviews"?>" class="btn btn-primary">Show Reviews</a>
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
		<div class="row justify-content-end">
        <div class="d-flex align-items-center justify-content-center pb-4">
                  <p class="mb-0 me-2"></p>
                    <button type="button" class="btn btn-outline-danger"
                      onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                    </div>
         </div>
	</section>
</div>
	<?php 
 include('footer.php');
?>
