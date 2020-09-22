jQuery(document).ready(function($){

	//'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() 
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */



	$('.bb-tabs').accordionortabs();

	$('.bb-tabs-combined').accordionortabs();

	 //$('#acf-form .acf-field.acf-field-text .acf-input input').autoNumeric('init', {mDec: 0});


	new AutoNumeric.multiple('#acf-form.rev-acc-form .acf-input input[type=text]', {decimalPlaces: '0'});
	

	
	var bb_tabs_length = $('.bb-tabs li').length;

	//alert(bb_tabs_length);


	
	//for (i = 0; i < bb_tabs_length; i++) { 

		//console.log(i + "dx");

	

		 bb_on_save('#sect_tabset_0_' + '0' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		 $('#sect_tabset_0_' + '0' + ' .acf-table .acf-row:nth-child(1) input[type=text]').change(function() {

		 	 bb_on_save('#sect_tabset_0_' + '0' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		});

		 bb_on_save('#sect_tabset_0_' + '1' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		 $('#sect_tabset_0_' + '1' + ' .acf-table .acf-row:nth-child(1) input[type=text]').change(function() {

		 	 bb_on_save('#sect_tabset_0_' + '1' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		});

		 bb_on_save('#sect_tabset_0_' + '2' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		$('#sect_tabset_0_' + '2' + ' .acf-table .acf-row:nth-child(1) input[type=text]').change(function() {

		 	 bb_on_save('#sect_tabset_0_' + '2' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		});

		bb_on_save('#sect_tabset_0_' + '3' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		 $('#sect_tabset_0_' + '3' + ' .acf-table .acf-row:nth-child(1) input[type=text]').change(function() {

		 	 bb_on_save('#sect_tabset_0_' + '3' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		});


		bb_on_save('#sect_tabset_0_' + '4' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		$('#sect_tabset_0_' + '4' + ' .acf-table .acf-row:nth-child(1) input[type=text]').change(function() {

		 	 bb_on_save('#sect_tabset_0_' + '4' + ' .acf-table .acf-row:nth-child(1) input[type=text]');


		});

	//}


	function bb_on_save(selector) {


			var allRequired = true;

			 $(selector).each(function() {
				if($(this).val() == ''){
			        allRequired = false;
			    }

		    });

			if(allRequired == true){
		    	
				 $('#acf-form input.acf-button.button.button-primary.button-large').css("background-color", "#2E3236");
		     	console.log('up');
			} else {
				
				 $('#acf-form input.acf-button.button.button-primary.button-large').css("background-color", "#cccccc");
				console.log('down');
		}

	}

	// Profile Combine Tab

	$('#acf-form-combined #preferForm input[type="number"]').change(function() {
	
	    var $current = $(this);

	    $('#acf-form-combined #preferForm input[type="number"]').each(function() {

	        if ($(this).val() == $current.val() && $(this).attr('countnum') != $current.attr('countnum'))
	        {
	            alert('duplicate found!');
	            $current.val('');
	        }

	        if ($(this).val() < 0) {

	    	    //alert('Negative value is not applicable!');
	            $current.val(0);
	   	 	}

	    });
	   
  	});
 
});




