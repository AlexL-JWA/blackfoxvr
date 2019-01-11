jQuery(document).ready(function() {
	
	var td = new Date();
	var selected_date = td.getDate()+'.'+(td.getMonth() + 1)+'.'+td.getFullYear();
	console.log(selected_date);
	/* Отмечаем время */
	function highlight_free_time() {
		
		var this_class = 'vrh_'+selected_date.replace('.', '-')+'_input';
		this_class = this_class.replace('.', '-');
		
		jQuery('.vrhour').removeClass('vrh_avail').addClass('vrh_busy');
		
		if (!jQuery('.'+this_class).length) {
			return false;			
		}
		
		jQuery('.'+this_class).each(function() {
			
			var vrhour_class = 'vhrt_'+jQuery(this).val();
			jQuery('.'+vrhour_class).removeClass('vrh_busy').addClass('vrh_avail');
			
		});
		
	}
	
	highlight_free_time();
	jQuery('#vrc').datepicker({
		dateFormat: 'd.m.yy',
		onSelect: function(date) {

			selected_date = date;
			highlight_free_time();
			console.log(selected_date);
			
		}
	});
		
	jQuery('.vrhour').click(function() {
		
		var this_date = jQuery(this).data('cl');
		var this_class = 'vrh_'+selected_date.replace('.', '-');
		console.log(this_date);
		
		if (jQuery(this).hasClass('vrh_busy')) {
			
			jQuery(this).removeClass('vrh_busy').addClass('vrh_avail');
			jQuery('#vr_form').prepend('<input type="hidden" name="time['+selected_date+']['+this_date+']" value="'+this_date+'" class="'+this_class+'_input vrh_input">');
			
		}
		else {
			
			jQuery(this).removeClass('vrh_avail').addClass('vrh_busy');
			jQuery('input[name="time['+selected_date+']['+this_date+']"]').remove();
			
		}
		
	});
			
});