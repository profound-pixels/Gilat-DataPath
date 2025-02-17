jQuery(document).ready(function(){
	//These are the events we will potentially track
	var eventsToTrack = [
		'click',
		'inview'
	];

	//Iterate over the events and add the listener to the window
	jQuery.each(eventsToTrack, function(index, element){
		window.addEventListener(element, function(e){
			reportEvent(e.target); //When the event is triggered, call the reportEvent function
		});
	});
});

function reportEvent(element){
/*
 * //Allow for hierarchical tracking (upwards)
	jQuery(element).parents('[data-event-action]')
			 .addBack('[data-event-action]')
			 .each(function(index, e){
					var action = jQuery(e).data('event-action') ?? '';
					var category = jQuery(e).data('event-category') ?? '';
					var label = jQuery(e).data('event-label') ?? '';

					gtag('event', action, {
						'event_category': category,
						'event_label': label
					});
	});
	*/

	var action = jQuery(element).data('event-action') ?? ''; //Set required action value
	if(action !== ''){ //Only send event if action value is set
		//Set optional values
		var category = jQuery(element).data('event-category') ?? '';
		var label = jQuery(element).data('event-label') ?? '';

		//Send event to Google Analytics
		gtag('event', action, {
			'event_category': category,
			'event_label': label
		});
	}
}
