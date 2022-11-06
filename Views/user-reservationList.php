<?php 
 include('header.php');
 include('nav-bar.php');
?>
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
            <div class="col-6 col-md-9">
              <div class="card mb-12">
                <div class="card-body">
                  <div class="row">
				  	 <div class="col-sm-4" style="text-align: center;">
				  		<h5 class="mb-2" style="border-right: 1px solid grey">Bookings Filter</h5>
                     </div>
                    	<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."finished"?>" class="btn btn-primary" for="option.finished" value="finished">Finished</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."pending"?>" class="btn btn-warning" for="option.pending" value="pending">Pending</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."approved"?>" class="btn btn-success" for="option.approved">Approved</a>
						</div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."rejected"?>" class="btn btn-danger" for="option.rejected">Rejected</a>
                        </div>
						<div class="col text-secondary" style="text-align: center;">
						<a href="<?php echo FRONT_ROOT."Booking/ShowBookingsUserByStatus/"."unanswered"?>" class="btn btn-secondary" for="option.unanswered">Unanswered</a>
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
											case 'pending payment': 
												$class = "btn btn-warning";
												break;
											case 'approved':
												$class = "btn btn-success";
												break;
											case 'pending':
												$class =  "btn btn-warning";
												break;
											case 'rejected':
												$class =  "btn btn-danger"; 
												break;
                                            case 'finished':
                                                $class =  "btn btn-primary"; 
                                                break;
                                            case 'unanswered':
                                                $class = "btn btn-secondary"; 
                                                break;

										}
									?>
									<td style="text-align: center;">
										<a class="<?php echo $class?>"><?php echo $booking->getStatus() ?></a>
									</td>
									<td style="text-align: center;"><?php echo $booking->getMessage() ?></td>
	
								</tr>
								<?php
							}
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
