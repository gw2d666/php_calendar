<?php

	$exp = '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/';
	if (isset($_POST["date"]) && !empty($_POST["date"]) && isset($_POST["content"]) && !empty($_POST["content"]) && preg_match($exp, $_POST["date"]) && checkdate((int)substr($_POST["date"], 5, 2), (int)substr($_POST["date"], 8, 2), (int)substr($_POST["date"], 0, 4))) {
		
		require_once("connection/connection.php");
		require_once("class/addNote.php");
		
		$add = new addNote($_POST["date"], $_POST["content"]);
		
	} else if (isset($_POST["date"]) || isset($_POST["content"])){
		 echo "Can't send - wrong input";
	} 

?>

<form method="POST" action="add.php">
	<label>Date: </label><input name="date" type="date">
	<label>Content: </label><textarea name="content"></textarea>
	<input type="submit" value="Submit">
</form>