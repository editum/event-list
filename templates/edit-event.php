<?php
	$event = EventListEvent::with_id($_GET['id']);
?>

<div class="wrap">
	<div id="icon-simplecal-page" class="icon32 icon32-simplecal-page"><br></div>
	<h2>Termin bearbeiten</h2>
	<?php
	if($error) 
		echo "<div id=\"message\" class=\"error below-h2\"><p>".$error."</p></div>";
	
	include("event-form.php"); ?>
</div>