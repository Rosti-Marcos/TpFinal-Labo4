<?php 
 include('header.php');
 include('nav-bar.php');
?>
	    <nav class="navtop">
	    	<div>
	    		<h1>Availability Calendar</h1>
	    	</div>
	    </nav>
		<form action="<?php echo  FRONT_ROOT."Calendar/showAvailabityCalendar"?>" method="post">
			<span class="form-label">Month</span>
					<select class="form-control" name="month" id="month">
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
		<div class="content home">
			<?=$calendar?>
		</div>
		<?php 
 include('footer.php');
?>