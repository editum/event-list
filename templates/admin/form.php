	<form id="simplecal-neweventform" method="post" action="?page=eventlist_manager">
		<?php if($event) { ?>
			<input type="hidden" name="event[id]" value="<?php echo $event->id; ?>">
		<?php } ?>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<h3 class="hndle"><span>Speichern</span></h3>
						<div class="inside">
							<div class="submitbox">
							
								<div id="major-publishing-actions" style="background: white;">
									<div id="delete-action"></div>
									<div id="publishing-action">
										<?php if($event) { ?>
											<input type="submit" class="button-primary" id="publish" tabindex="4" accesskey="p" value="&Auml;nderungen speichern">
										<?php } else { ?>
											<input type="submit" class="button-primary" id="publish" tabindex="4" accesskey="p" value="Termin hinzuf&uuml;gen">
										<?php } ?>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
					
					<div id="pageparentdiv" class="postbox">
						<h3 class="hndle">
							<span>Verkn&uuml;pfung mit Seite</span>
						</h3>
						<div class="inside">
							<p>
								<strong>Seite</strong>
							</p><label class="screen-reader-text" for="event[page]">Seite</label>
							<?php
								if($event)
									wp_dropdown_pages(array('show_option_none' => '-', 'name' => 'event[page]', 'selected' => $event->post));
								else
									wp_dropdown_pages(array('show_option_none' => '-', 'name' => 'event[page]'));
							?>
						</div>
					</div>
				</div>
			</div>
			
			<div id="post-body">
				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap">
							<input type="text" name="event[title]" size="30" tabindex="1" id="title" autocomplete="off" placeholder="Titel" value="<?php echo $event->caption; ?>">
						</div>
					</div>
				
					<div class="postbox">
						<h3 class="hndle"><span>Zeit und Ort</span></h3>
						<div class="inside">
							
							<?php $begin_date = $event ? explode("-",$event->begin_date) : NULL; ?>
							
							<p><strong>Beginn</strong></p>
							<label class="screen-reader-text" for="begin_day">Tag</label> 
							<select name="event[begin_date][d]" id="begin_day">
								<?php echo EventListHelper::num_options(1,31,".",$begin_date[2]); ?>
							</select>
							<label class="screen-reader-text" for="begin_month">Monat</label> 
							<select name="event[begin_date][m]" id="begin_month">
								<?php echo EventListHelper::month_options($begin_date[1]); ?>
							</select>
							<label class="screen-reader-text" for="begin_year">Jahr</label> 
							<select name="event[begin_date][y]" id="begin_year">
								<?php echo EventListHelper::num_options(intval(date(Y)),intval(date(Y))+10,NULL,$begin_date[0]); ?>
							</select>
							&ndash;
							
							<?php $begin_time = $event && $event->begin_time ? explode(":",$event->begin_time) : NULL; ?>
							
							<label class="screen-reader-text" for="begin_hours">Stunde</label> 
							<select name="event[begin_time][h]" id="begin_hours">
								<option value="">-</option>
								<?php echo EventListHelper::num_options(0,24,NULL,$begin_time[0]); ?>
							</select>
							&#58;
							<label class="screen-reader-text" for="begin_minutes">Minuten</label> 
							<select name="event[begin_time][m]" id="begin_minutes">
								<option value="">-</option>
								<?php echo EventListHelper::num_options(0,60,NULL,$begin_time[1]); ?>
							</select>

							<?php $end_date = $event && $event->end_date ? explode("-",$event->end_date) : NULL; ?>
							
							<p><strong>Ende</strong></p>
							<label class="screen-reader-text" for="end_day">Tag</label> 
							<select name="event[end_date][d]" id="end_day">
								<option value="">-</option>
								<?php echo EventListHelper::num_options(1,31,".",$end_date[2]); ?>
							</select>
							<label class="screen-reader-text" for="end_month">Monat</label> 
							<select name="event[end_date][m]" id="end_month">
								<option value="">-</option>
								<?php echo EventListHelper::month_options($end_date[1]); ?>
							</select>
							<label class="screen-reader-text" for="end_year">Jahr</label> 
							<select name="event[end_date][y]" id="end_year">
								<option value="">-</option>
								<?php echo EventListHelper::num_options(intval(date(Y)),intval(date(Y))+10,NULL,$end_date[0]); ?>
							</select>
							&ndash;
							
							<?php $end_time = $event && $event->end_time ? explode(":",$event->end_time) : NULL; ?>
							
							<label class="screen-reader-text" for="end_hours">Stunden</label> 
							<select name="event[end_time][h]" id="end_hours">
								<option value="">-</option>
								<?php echo EventListHelper::num_options(0,24,NULL,$end_time[0]); ?>
							</select>
							&#58;
							<label class="screen-reader-text" for="end_minutes">Minuten</label> 
							<select name="event[end_time][m]" id="end_minutes">
								<option value="">-</option>
								<?php echo EventListHelper::num_options(0,60,NULL,$end_time[1]); ?>
							</select>
							
							<p><strong>Ort</strong></p>
							<label class="screen-reader-text" for="begin_minutes">Ort</label>
							<input name="event[venue]" type="text" value="<?php echo $event->venue; ?>"/>
							
						</div>
					</div>
								
					<div class="postbox">
						<h3 class="hndle"><span>Kurztext</span></h3>
						<div class="inside">
							<textarea name="event[description]" id="event_description"><?php echo $event->description; ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<br class="clear">
		</div>
	</form>