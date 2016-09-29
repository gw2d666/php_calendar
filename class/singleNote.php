<?php

require_once("connection/connection.php");

class singleNote
{
	public $content;
	public function __construct ($class, $day, $m, $y) {
		
		$value = "";
		
		if ($day < 10) {
			$day = "0" . $day;
		}
		$date = $y . "-" . $m . "-" . $day;
			$list = [];
		try {
			$db = Db::getInstance();
			$sth = $db->query('Select content FROM calendar WHERE date="' . $date . '"');
			foreach($sth->fetchAll() as $result) {
				$list[] = $result['content'];
			  }
		} catch (PDOException $e) {
			echo "PDO error: " . $e;
		}
		$lastDay = cal_days_in_month(CAL_GREGORIAN, $m, $y);
		if ($day == "01" || $day == $lastDay) {
			$mName = date(" F", mktime(0,0,0, $m, $day, $y));
			$day .= " " . $mName ;
		}
		
		if (sizeof($list) > 0) {
			foreach($list as $tasks) {
				$value .= "<p class='task'>" . $tasks . "</p>";
			}
		}
		
		$this->content = "<div class='" . $class . "'><h3>" . $day . "</h3><p>" . $value . "</p></div>";
	}
	
	
}