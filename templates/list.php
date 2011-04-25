<ul class="eventlist">	
<?php 
$months = array("JAN", "FEB", "M&Auml;R", "APR", "MAI", "JUN", "JUL", "AUG", "SEP", "OKT", "NOV", "DEZ");

$events = EventListEvent::upcoming_and_running();

if(count($events)) {
	
	foreach(EventListEvent::upcoming_and_running() as $event) {
		
		list($y, $m, $d) = explode('-', $event->begin_date);
		if(intval($m) == $lastm) $newm = false;
		else { $newm = true; $lastm = intval($m); }	
	?>
		<li>
			<div class="<?php echo $newm ? 'event newmonth' : 'event'; ?>">
				<div class="month">
					<?php echo $months[intval($m)-1]; ?><span class="year"><?php echo $y; ?></span>
				</div>
				<div class="content">
					<?php if($event->post) { ?>
						<div class="caption"><?php echo $event->caption; ?>
							<span class="page-link"><a href="<?php echo get_page_uri($event->post); ?>">&raquo; weitere Informationen</a>
						</div>
					<?php } else { ?>
						<div class="caption"><?php echo $event->caption; ?></div>
					<?php } ?>
					<span class="time"><?php echo $event->formattedDateTime(); ?></span>
					<?php if($event->venue) { ?><span class="venue">/ <?php echo $event->venue; ?></span><?php } ?>
					<?php if($event->description) { ?><div class="description"><?php echo $event->description; ?></div><?php } ?>
				</div>
			</div>
		</li>
	<?php }
} else { ?>
	<li class="noevents">keine Termine</li>
<?php } ?>
</ul>