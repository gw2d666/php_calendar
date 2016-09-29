<?php 

class AddNote {
	public function __construct ($date, $content) {
		try {
			$db = Db::getInstance();
			
			$sql = "INSERT INTO calendar (date, content) VALUES (:date, :content)";
			$sth = $db->prepare($sql);
			$sth->bindParam(":date", $date);
			$sth->bindParam(":content", $content);
			
			$sth->execute();
			
			echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";

		} catch(PDOException $e) {
			echo "Uploading error " . $e->getMessage();
		}
	}
}