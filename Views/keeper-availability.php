<?php 
 include('header.php');
 include ('nav-bar.php');
?>

  <nav class="navtop">
  	<div>
			<h1>Set my availability</h1>
  	</div>
  </nav>
  <?php if(!empty($message)){ echo $message; }?>
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
														<option value="Available">Available</option>
														<option value="Unavailable">Unavailable</option>
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
		<div class="row justify-content-end">
        <div class="d-flex align-items-center pb-4">
                  <p class="mb-0 me-2"></p>
                    <button type="button" class="btn btn-outline-danger"
                      onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                    </div>
         </div>
	</div>
<?php 
 include('footer.php');
?>
        
