<html>
	<head>
	<title>Calendar</title>
	<link rel="stylesheet" href="style/style.css">
	</head>
	<body>
		<form method="GET" action="index.php">
			<label>Check date in format like 2016-09-20:</label><input type="date" name="date" value="">
			<input type="submit" value="Check date">
		</form>
		<a href="add.php">Add Note</a>
<?php
		
		

require_once("class/calendar.php");

$mode = NULL;

if (isset($_GET["date"])) {
	$exp = '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/';
	$temp = trim($_GET["date"]);
	
	if (preg_match($exp, $temp) && checkdate((int)substr($temp, 5, 2), (int)substr($temp, 8, 2), (int)substr($temp, 0, 4))) {
		$mode = $temp;
		//echo "correct date format inputed: " . $mode;
	} else {
		echo "<span class='input-info'>";
		echo "Wrong date or format inputed! - Now calendar is showing current date: " . date("Y-m-d") . "</br>";
		echo "</span>";
	}
}
echo "<br><br>";
	
$calendar = new Calendar($mode);
$calendar->show();

	
	?>
	</body>
</html>