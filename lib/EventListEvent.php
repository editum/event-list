<?php

class EventListEvent {
	
	public static $validKeys = array('id', 'caption', 'venue', 'begin_date', 'begin_time', 
		'end_date', 'end_time', 'description', 'post');
	
	private $eventHash;
	
	function __construct($hash = NULL) {

		$this->eventHash = $hash ? $hash : array();
	}
	
	function __get($property) {
		
		return $this->eventHash[$property];
	}
	
	function __set($property, $value) {
		if(in_array($property,self::$validKeys))
			$this->eventHash[$property] = $value;
	}
	
	private function nullifiy($value) {
		return $value == "" ? "NULL" : "'".$value."'";
	}
	
	public function formattedDateTime() {
		
		// needs to be refactored, i18ned
		
		$begin_date = explode("-", $this->begin_date);
		$formatted = $begin_date[2].".".$begin_date[1].".".$begin_date[0];
		
		if($this->begin_time) {
			$begin_time = explode(":", $this->begin_time);
			$formatted .= " ".$begin_time[0].":".$begin_time[1];
		}
		
		if($this->end_date == $this->begin_date) {
			if($this->end_time) {
				$end_time = explode(":", $this->end_time);
				$formatted .= " - ".$end_time[0].":".$end_time[1];
			}
		} else if($this->end_date) {
			$end_date = explode("-", $this->end_date);
			$formatted .= " - ".$end_date[2].".".$end_date[1].".".$end_date[0];
			
			if($this->end_time) {
				$end_time = explode(":", $this->end_time);
				$formatted .= " ".$end_time[0].":".$end_time[1];
			}
		} else {
			if($this->end_time) {
				$end_time = explode(":", $this->end_time);
				$formatted .= " - ".$end_time[0].":".$end_time[1];
			}
		}
			
		return $formatted;
	}
	
	public function save() {
		
		function sqlf($value) {
			return $value == "" ? "NULL" : "'".$value."'";
		}
		
		mysql_query("INSERT INTO wp_simplecal_events (id, caption, begin_date, begin_time, end_date, 
			end_time, venue, description, post) VALUES ('','".$this->eventHash['caption']."',
			'".$this->eventHash['begin_date']."',".sqlf($this->eventHash['begin_time']).",
			".sqlf($this->eventHash['end_date']).",".sqlf($this->eventHash['end_time']).",
			".sqlf($this->eventHash['venue']).",".sqlf($this->eventHash['description']).",
			".sqlf($this->eventHash['post']).");");	

		return mysql_error() != "" ? false : true;
	}
	
	public function update() {
		
		function sqlf($value) {
			return $value == "" ? "NULL" : "'".$value."'";
		}

		mysql_query("UPDATE wp_simplecal_events SET caption = '".$this->eventHash['caption']."',
			begin_date = '".$this->eventHash['begin_date']."', begin_time = ".sqlf($this->eventHash['begin_time']).",
			end_date = ".sqlf($this->eventHash['end_date']).", end_time = ".sqlf($this->eventHash['end_time']).",
			venue = ".sqlf($this->eventHash['venue']).", description = ".sqlf($this->eventHash['description']).",
			post = ".sqlf($this->eventHash['post'])." WHERE id = '".$this->eventHash['id']."';");

		return mysql_error() != "" ? false : true;		
	}
	
	public function delete() {
		
		mysql_query("DELETE FROM wp_simplecal_events WHERE id = ".$_GET['id']);
		return mysql_error() != "" ? false : true;
	}
	
	public static function all() {

		$returnVector = array();
		$events = mysql_query("SELECT * FROM wp_simplecal_events");
		
		if(mysql_num_rows($events))
			while($event = mysql_fetch_assoc($events))
		 		$returnVector[] = new EventListEvent($event);
			
		return $returnVector;
	}
	
	public static function upcoming_and_running($limit = NULL) {
		
		$returnVector = array();
		if($limit) 
			$events = mysql_query("SELECT * FROM wp_simplecal_events WHERE (begin_date >= NOW()) 
				OR (NOW() BETWEEN begin_date AND end_date) ORDER BY begin_date, begin_time ASC LIMIT ".$limit);
		else
			$events = mysql_query("SELECT * FROM wp_simplecal_events WHERE (begin_date >= NOW()) 
				OR (NOW() BETWEEN begin_date AND end_date) ORDER BY begin_date, begin_time ASC");
		
		if(mysql_num_rows($events))
			while($event = mysql_fetch_assoc($events))
				$returnVector[] = new EventListEvent($event);
			
		return $returnVector;
	}
	
	public static function with_id($id) {
		
		if($res = mysql_query("SELECT * FROM wp_simplecal_events WHERE id = '".$id."' LIMIT 1"))
			return new EventListEvent(mysql_fetch_assoc($res));
		else
			return NULL;
	}
}

?>