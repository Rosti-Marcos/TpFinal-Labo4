
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Availability Calendar</title>
         
		<link href="<?php echo  CSS_PATH."style.css"?>" rel="stylesheet" type="text/css">
		<link href="<?php echo  CSS_PATH."calendar.css"?>" rel="stylesheet" type="text/css">
	</head>
	<body>
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
	</body>
</html>