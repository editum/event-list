<ul class="sc-eventlist">
	
<?php 

$events = SimpleCalEvent::upcoming_and_running();

if(count($events)) {
	foreach(SimpleCalEvent::upcoming_and_running() as $event) { ?>
		<li class="sc-event">
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
		</li>
	<?php }
} else { ?>
	<li class="sc-noevents">keine Termine</li>
<?php } ?>
</ul>