<?php

require_once("singleNote.php");

class Calendar
{
	private $d;
	private $m;
	private $y;
	public $selected_date = "";
	public $content = "<div>";
	public function __construct ($date)
	{
		if ($date != NULL) {
			$this->selected_date = $date;
			$this->d = (int)substr($date, 8, 2);
			$this->m = (int)substr($date, 5, 2);
			$this->y = (int)substr($date, 0, 4);
		} else {
			$this->selected_date = date("Y-m-d");
			$this->d = date("d");
			$this->m = date("m");
			$this->y = date("Y");
		}
		
		return $this->item();
		
	}
	
	private function item()
	{
		
		$days = cal_days_in_month(CAL_GREGORIAN, $this->m, $this->y);
		$date = date("d");
		$first = date("l", mktime(0,0,0,$this->m,1,$this->y)); // first day of month
		$last = date("l", mktime(0,0,0,$this->m, $days,$this->y)); 
		if ($this->m == 12){
			$prevM = $this->m -1;
			$prevY = $this->y;
			$nextM = 1;
			$nextY = $this->y +1;
		} else if ($this->m == 1) {
			$prevM = 12;
			$prevY = $this->y -1;
			$nextM = $this->m +1;
			$nextY = $this->y;
		} else {
			$prevM = $this->m -1;
			$prevY = $this->y;
			$nextM = $this->m +1;
			$nextY = $this->y;
		}
		
		$prevMoDays = cal_days_in_month(CAL_GREGORIAN, $prevM, $this->y);
		$nextMoDays = cal_days_in_month(CAL_GREGORIAN, $nextM, $this->y);
		
		$prev;
		$next;
		$counter = 1;
		
		if ($first == "Monday") {
			$counter = 6;
		} else {
			$prev = date("l", mktime(0,0,0, $prevM, (int)$prevMoDays, $this->y));
			while ($prev != "Monday"){
				$prev = date("l", mktime(0,0,0, $prevM, (int)$prevMoDays - $counter, $this->y));
				$counter++;
			}
			$counter = $counter -1;
			if ($counter < 3){
				$counter = $counter + 7;
			}
		}
		
		
		for ($i = (int)$prevMoDays - $counter; $i <= $prevMoDays; $i++){
			$tmp = new singleNote("prev", $i, $prevM, $prevY);
			$this->content .= $tmp->content;
		}
		
		for ($i = 1; $i <= $days; $i++) {
			$tmp = new singleNote("norm", $i, $this->m, $this->y);
			$this->content .= $tmp->content;
		}
		
		$counter = 1;
		if ($last == "Sunday") {
			$counter = 6;
		} else {
			$next = date("l", mktime(0,0,0, $nextM, 1, $nextY));
			while ($next != "Sunday"){
				$next = date("l", mktime(0,0,0, $nextM, 1 + $counter, $nextY));
				$counter++;
			}
			if ($counter < 3) {
				$counter = $counter + 7;
			}
		}
		
		for ($i = 1; $i <= $counter; $i++){
			$tmp = new singleNote("next", $i, $nextM, $nextY);
			$this->content .= $tmp->content;
		}
		
		$this->content .= "</div>";
		
	}
	
	public function show()
	{
		echo "<div class='head'>Selected Date: " . $this->selected_date . "</div>";
		echo "<div class='day-bar'><h2>Monday</h2><h2>Tuesday</h2><h2>Wednesday</h2><h2>Thursday</h2><h2>Friday</h2><h2>Saturday</h2><h2>Sunday</h2>";
		echo $this->content;
	}
	
}
