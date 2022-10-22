<?php 
 include('header.php');
 include('nav-bar.php');
?>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Reservation List</h2>
				</div>
			</div>
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
						      <th style="text-align: center;">Status</th>
							  <th style="text-align: center;">Message</th>
							  <th style="text-align: center;">Action</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
							foreach($bookingList as $booking)
							{
								?>
								<tr>
									<td style="text-align: center;">Name</td>
									<td style="text-align: center;"><?php echo $booking->getStartDate() ?></td>
									<td style="text-align: center;"><?php echo $booking->getEndDate() ?></td>
									<td style="text-align: center;"><?php echo $booking->getPrice() ?></td>
									<?php
										$class = "";
										switch ($booking->getStatus()) {
											case 'reserved':
												$class = "btn btn-success";
												break;
											case 'pending':
												$class =  "btn btn-warning";
												break;
											case 'rejected':
												$class =  "btn btn-danger"; 
												break;
										}
									?>
									<td style="text-align: center;"">
										<a class="<?php echo $class?>"><?php echo $booking->getStatus() ?></a>
									</td>
									<?php
										if($booking->getStatus() == 'pending'){
											?>
										<form action="<?php echo FRONT_ROOT."CellPhone/Remove" ?>" method="POST">
											<td style="text-align: center;">
												<input type="text" name="message" size="20" required>
											</td>
											<td style="text-align: center;">
												<button type="submit" name="approve" class="btn btn-success" value=""> Approve </button>
												<button type="submit" name="decline" class="btn btn-danger" value=""> Decline </button>
											</td>
										</form>
									<?php
										}else{
											?>
											<td></td>
											<td style="text-align: center;">
											<a class="btn btn-light"><?php echo $booking->getStatus() ?></a>
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
		<a href="<?php echo FRONT_ROOT. "Home\ShowWellcomeView"?>">Back</a>
	</section>

	<?php 
 include('footer.php');
?>
