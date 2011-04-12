<?php

class EventListHelper {
	
	public static function month_options($selected = NULL) {

		$months = array("Januar", "Februar", "M&auml;rz", "April", "Mai", "Juni", "Juli", "August",
			"September", "Oktober", "November", "Dezember");

		$i = 1;
		foreach($months as $key => $value)
			if($i == $selected)
				$return .= "<option value=\"".$i++."\" selected>".$value."</option>";
			else
				$return .= "<option value=\"".$i++."\">".$value."</option>";				

		return $return;
	}

	public static function num_options($from, $to, $suffix = NULL, $selected = NULL) {

		for($i = $from; $i <= $to; $i++)
			if($i == $selected && $selected != NULL)
				$return .= "<option value=\"".$i."\" selected>".$i.$suffix."</option>";
			else
				$return .= "<option value=\"".$i."\">".$i.$suffix."</option>";
				
		return $return;
	}
}


?>