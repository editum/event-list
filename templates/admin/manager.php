<script type="text/javascript">
<!--
function confirmDelete(id) {
	if (confirm("Sind Sie sicher, dass Sie diesen Termin löschen möchten?"))
		window.location = "?page=eventlist_manager&action=delete&id="+id;
}
//-->
</script>

<div class="wrap">
	<div id="icon-simplecal-page" class="icon32 icon32-simplecal-page"><br></div>
	<h2>Termine</h2>
	<?php 
	if($error) 
		echo "<div id=\"message\" class=\"error below-h2\"><p>".$error."</p></div>";
	else if($message)
		echo "<div id=\"message\" class=\"updated below-h2\"><p>".$message."</p></div>";
	?>
	<ul class="subsubsub">
		<?php if($_GET['view'] == "all") { ?>
			<li class="all"><a href="?page=eventlist_manager&amp;view=all" class="current">Alle<!--> <span class="count">(14)</span>--></a> |</li>
		<?php } else { ?>
			<li class="all"><a href="?page=eventlist_manager&amp;view=all">Alle<!--> <span class="count">(14)</span>--></a> |</li>
		<?php } if(!$_GET['view'] || $_GET['view'] == "upcoming") { ?>
			<li class="upcoming"><a href="?page=eventlist_manager&amp;view=upcoming" class="current">Kommende</a></li>
		<?php } else { ?>
			<li class="upcoming"><a href="?page=eventlist_manager&amp;view=upcoming">Kommende</a></li>
		<?php } ?>
	</ul>

	<table class="widefat">
		<thead>
			<tr>
				<th class="manage-column column-cb check-column" scope="col"><!-- reserved for checkboxes --></th>
				<th>Name</th>
				<th>Ort</th>
				<th>Datum und Uhrzeit</th>
			</tr>
		</thead>
		
		<tbody>
			<?php
			$events = $_GET['view'] == "all" ? EventListEvent::all() : EventListEvent::upcoming_and_running();
			
			if(count($events)) {
				foreach($events as $event) { ?>
					<tr class="alternate">
						<td><!-- reserved for checkboxes --></td>
						<td>
							<strong><a class="row-title" href="?page=eventlist_manager&amp;action=edit&amp;id=<?php echo $event->id; ?>">
								<?php echo $event->caption; ?>
							</a></strong>
							<br/>
							<div class="row-actions">
								<span class="edit"><a href="?page=eventlist_manager&amp;action=edit&amp;id=<?php echo $event->id; ?>" title="Dieses Element bearbeiten">Bearbeiten</a> | </span><span class="trash"><a class="submitdelete" title="Element in den Papierkorb verschieben" href="#" onclick="confirmDelete(<?php echo $event->id; ?>)">L&ouml;schen</a></span>
							</div>
						</td>
						<td><?php echo $event->venue; ?></td>
						<td><?php echo $event->formattedDateTime(); ?></td>
					</tr>
				<?php }
			} else { ?>
				<tr><td class="no-events" colspan="4">keine Termine</td></tr>
			<?php } ?>
		</tbody>
	</table>
</div>

