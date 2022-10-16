<!doctype html>
<html lang="en">
  <head>
  	<title>Reservation Table</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?php echo  CSS_PATH."styleTable.css"?>">

	</head>
	<body>
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
						      <th>Customer</th>
						      <th>Start date</th>
						      <th>End date</th>
						      <th>Price</th>
						      <th>Status</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
							foreach($bookingList as $booking)
							{
								?>
								<tr>
									<td>Name</td>
									<td><?php echo $booking->getStartDate() ?></td>
									<td><?php echo $booking->getEndDate() ?></td>
									<td><?php echo $booking->getPrice() ?></td>
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
									<td>
									<a href="<?php echo FRONT_ROOT."Booking/modifyBookings/".$booking->getId()?>" class="<?php echo $class?>"><?php echo $booking->getStatus() ?></a>
									</td>
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
		
	</section>

</html>