<?php 
 include('header.php');
 include('nav-bar.php');
?>
	    <nav class="navtop">
	    	<div>
	    		<h1>Availability Calendar</h1>
	    	</div>
	    </nav>
		
		<div class="content home">
			<form action="<?php echo  FRONT_ROOT."Calendar/showAvailabilityCalendar"?>" method="post">
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
						<option value="10" selected>October</option>
						<option value="11">November</option>
						<option value="12">December</option>
						</select>
				<span class="select-arrow"></span>
				<button type="submit" class="submit-btn">Go</button>
			</form>
				<?=$calendar?>
		</div>
		<div class="row justify-content-end">
        <div class="d-flex align-items-center justify-content-center pb-4">
                  <p class="mb-0 me-2"></p>
                    <button type="button" class="btn btn-outline-danger"
                      onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                    </div>
         </div>
		<?php 
 include('footer.php');
?>