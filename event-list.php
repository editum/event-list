<?php
/*
Plugin Name: Event List
*/

require_once("EventListEvent.php");
require_once("EventListHelper.php");

define('EVENTLIST_PLUGIN_URL', plugins_url('',plugin_basename(__FILE__)).'/');
define('SIMPLECAL_ROUTE', "termine");

wp_enqueue_style("event-list.css", EVENTLIST_PLUGIN_URL.'/event-list.css');

add_action("admin_menu", "admin_menu_injector");
add_filter("the_content","content_injector");

register_sidebar_widget("Event List - Upcoming Events","widget_injector");

function content_injector($content) {

	if(is_page(SIMPLECAL_ROUTE)) 
		include("templates/event-list.php");
	else
		return $content;
}

function admin_menu_injector() {

	add_menu_page("Termine", "Termine", 'edit_themes', 'eventlist_manager', 'admin_menu_events_render', EVENTLIST_PLUGIN_URL.'/images/calendar-16.png', 21); 
	add_submenu_page('eventlist_manager', "Neuer Termin", "Neuer Termin", 'edit_themes', 'eventlist_new_event', 'admin_menu_new_event_render');

	function admin_menu_events_render() {
		
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			
			if($_GET["action"] == "edit")
				include("templates/edit-event.php");
			elseif($_GET["action"] == "delete") {
				
				if(EventListEvent::with_id($_GET['id'])->delete())
					$message = "Der Termin wurde erfolgreich gel&ouml;scht.";
				else
					$error = "Der Termin konnte nicht gel&ouml;scht werden.";

				include("templates/event-manager.php");
					
			} else
				include("templates/event-manager.php");
		
		} else if($_SERVER["REQUEST_METHOD"] == "POST") {

			if($_POST['event']['title'] != "" && $_POST['event']['begin_date']['d'] != ""
				&& $_POST['event']['begin_date']['m'] != "" && $_POST['event']['begin_date']['y'] != "") {
					
					$event = new EventListEvent();
					$event->caption = $_POST['event']['title'];

					if($_POST['event']['begin_date']['d'] != "" && $_POST['event']['begin_date']['m'] != "") {
						$vals = $_POST['event']['begin_date'];
						$event->begin_date = $vals['y']."-".$vals['m']."-".$vals['d'];
					}
					
					if($_POST['event']['begin_time']['h'] != "" && $_POST['event']['begin_time']['m'] != "") {
						$vals = $_POST['event']['begin_time'];
						$event->begin_time = $vals['h'].":".$vals['m'].":00";
					}
					
					if($_POST['event']['end_date']['d'] != "" && $_POST['event']['end_date']['m'] != "") {
						$vals = $_POST['event']['end_date'];
						$event->end_date = $vals['y']."-".$vals['m']."-".$vals['d'];
					}
					
					if($_POST['event']['end_time']['h'] != "" && $_POST['event']['end_time']['m'] != "") {
						$vals = $_POST['event']['end_time'];
						$event->end_time = $vals['h'].":".$vals['m'].":00";
					}
					
					$event->description = $_POST['event']['description'];
					$event->venue = $_POST['event']['venue'];
					$event->post = $_POST['event']['page'];
					
					if($_POST['event']['id']) {
						
						$event->id = $_POST['event']['id'];
						
						if($event->update())
							$message = "Der Termin wurde erfolgreich bearbeitet.";
						else
							$error = "Der Termin konnte nicht bearbeitet werden.";
					} else {
						if($event->save())
							$message = "Der Termin wurde erfolgreich angelegt.";
						else
							$error = "Der Termin konnte nicht angelegt werden.";	
					}
										
					include("templates/event-manager.php");
					
			} else {
				$error = "Es muss mindestens ein Titel und ein Beginn-Datum angegeben werden.";
				include("templates/new-event.php");
			}
		}
	}
	
	function admin_menu_new_event_render() {
		
		include("templates/new-event.php");
	}
}

function widget_injector() {
	
	include("templates/widget.php");
}

?>