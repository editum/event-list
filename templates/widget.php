<li id="simplecal-3" class="widget widget_simplecal">
	<h2 class="widgettitle">Termine</h2>
		<ul class="widget-events">
			<?php foreach(SimpleCalEvent::upcoming_and_running(3) as $event) { ?>
				<li class="widget-event">
					<?php
						if($event->post) 
							echo "<a class=\"widget-link\" href=\"".get_page_uri($event->post)."\">&raquo; ".$event->caption."</a>";
						else
							echo "&raquo ".$event->caption;
					?>
					<span class="datetime"><?php echo $event->formattedDateTime(); ?></span>
				</li>	
			<?php } ?>
		</ul>
</li>
