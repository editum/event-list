<ul class="eventlist">
	
<?php 

$events = EventListEvent::upcoming_and_running();

if(count($events)) {
	foreach(EventListEvent::upcoming_and_running() as $event) { ?>
		<li>
			<div class="event newmonth">
				<div class="month">
					AUG<span class="year">2011</span>
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