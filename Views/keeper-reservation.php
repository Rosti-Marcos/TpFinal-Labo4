<?php 
 include('header.php');
?>
<div id="service" class="section img">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Reservation data</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>Customer</th>
						      <th>Start date</th>
						      <th>End date</th>
						      <th>Price</th>
                              <th>Description</th>
						      <th>Status</th>
						    </tr>
						  </thead>
						  <tbody>
							  <td>Name</td>
					  		  <td><?php echo $booking->getStartDate() ?></td>
							  <td><?php echo $booking->getEndDate() ?></td>
							  <td><?php echo $booking->getPrice() ?></td>
                              <td>Description</td>
							  <td><?php echo $booking->getStatus() ?></td>
                              <?php 
                                if($booking->getStatus() == 'pending')
                                {
                                    ?>
                                    <td><a href="<?php echo FRONT_ROOT."Booking/Add/".$booking->getId()?>" class="btn btn-success">Approve</a></td>
                                    <td><a href="<?php echo FRONT_ROOT."Booking/Remove/".$booking->getId()?>" class="btn btn-danger">Decline</a></td>
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
		
	</section>
</div>
<?php 
 include('footer.php');
?>