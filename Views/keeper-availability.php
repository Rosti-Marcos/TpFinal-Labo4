<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Poppins:400" rel="stylesheet">

	<link type="text/css" rel="stylesheet" href="<?php echo  CSS_PATH."bootstrap.min.css"?>"/>
  <link href="<?php echo  CSS_PATH."style.css"?>" rel="stylesheet" type="text/css">
	<link type="text/css" rel="stylesheet" href="<?php echo  CSS_PATH."stylebootstrap.css"?>"/>

	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

  <nav class="navtop">
  	<div>
			<h1>Set my availability</h1>
  	</div>
  </nav>

</head>
<body>
	<div id="service" class="section img">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
          <form action="<?php echo  FRONT_ROOT."Service/Add "?>" method="post">
            <?php 
              $startDate = new DateTime();
              $max = new DateTime();
              $max->modify("365 days");
             ?>
							<div class="row no-margin">
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">From</span>
										<input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" min=<?=$startDate->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> name="startDate" require>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row no-margin">
										<div class="col-md-6">
											<div class="form-group">
												<span class="form-label">To</span>
                        <input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" min=<?=$startDate->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> name="endDate" require>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
                        <span class="form-label">Status</span>
                        <select class="form-control" name="status" id="status">
                          <option value="available">Available</option>
                          <option value="unavailable">Unavailable</option>
                        </select>
                        <span class="select-arrow"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-btn">
                    <button type="submit" class="submit-btn" value="Agregar" >Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
        
