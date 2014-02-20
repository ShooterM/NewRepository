<?php
/**
 *
 * Class with helpful functions
 * @author Misha
 *
 */
class Support {
	
	public static function getCorrectDate($date) {
		$parts = explode('/', $date);
		return  "$parts[2]-$parts[0]-$parts[1]";
	}

	public static function rowsGen($row) {
		$newRow = "<tr>";
		foreach ($row as $col) {
			if (!is_null($col)) {
				$newRow = $newRow."<td>".$col."</td>";
			} else {
				$newRow = $newRow."<td>-</td>";
			}
		}
		return $newRow."</tr>";
	}
}
?>