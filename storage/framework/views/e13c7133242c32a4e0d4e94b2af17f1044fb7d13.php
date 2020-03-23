<?php
	if (Session::get('cocoa') == "") {
		?>
		<script type="text/javascript">
			location.href="<?php echo e(route('login_screen')); ?>";
		</script>
		<?php
	}
	$fname = Session::get('user_firstname');
	$lname = Session::get('user_lastname');
	$medium_fullname = $lname . ", " . $fname;
	$company = Session::get('user_company');
	$schedule = Session::get('user_schedule');
	$utype = Session::get('user_type');
	$utype_intext = "";
	$refined_schedule = "";
	switch($utype){
		case "1":
			$utype_intext = "Non-Teaching Personnel";
			$rf = explode(",", $schedule);
			$refined_schedule = $rf[0] . " to " . $rf[1] . " with " . $rf[2] . " to " . $rf[3] . " breaktime.";
		break;
		case "2":
			$utype_intext = "Teaching Personnel";
			$rf = explode(",", $schedule);
			$refined_schedule = $rf[0] . " to " . $rf[1];
		break;
		case "3":
			$utype_intext = "Division Personnel";
			$rf = explode(",", $schedule);
			$refined_schedule = $rf[0] . " to " . $rf[1] . " with " . $rf[2] . " to " . $rf[3] . " breaktime.";
		break;
	}
?>