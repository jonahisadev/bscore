<?php 

	//include 'connect.php';

	function slog($str) {
		$file = fopen("data/log.txt", "a");
		fwrite($file, date("[m/d h:i:s A] ", time()) . $str . "\n");
		fclose($file);
	}
	
	function printLog() {
		$file = fopen("data/log.txt", "r");
		echo(fread($file, filesize("data/log.txt")));
		fclose($file);
	}

	function cleanse($str) {
		global $db;
		$str = stripslashes($str);
		$str = mysqli_real_escape_string($db, $str);
		return $str;
	}
	
	function getLeagueName($num) {
		if ($num == 1) {
			return "Men";
		}
		else if ($num == 2) {
			return "Women";
		}
		else if ($num == 3) {
			return "Youth M";
		}
		else if ($num == 4) {
			return "Youth F";
		}
		else {
			return "???";
		}
	}
	
	function getScoreType($num) {
		if ($num == 1) {
			return "Game";
		}
		else if ($num == 2) {
			return "Series";
		}
		else {
			return "???";
		}
	}
	
	class ScoreData {
		var $id;
		var $score;
		
		function ScoreData($id, $score) {
			$this->id = $id;
			$this->score = $score;
		}
		
		static function cmp_obj($a, $b) {
			if ($a->score == $b->score) {
				return 0;
			}
			return ($a->score > $b->score) ? -1 : +1;
		}
	}

?>