jQuery(document).ready(function($){
 
	$(".currency-dropdown .acf-fields select").on('change', function(event) {

	    event.preventDefault();

	
	  
	   // console.log(3);

		var form_data = {"action" : "acf/validate_save_post"};

	   	jQuery('.currency-dropdown .acf-input select').each(function(){
 			form_data[jQuery(this).attr('name')] = jQuery(this).val()
		})

		//alert(form_data);

		val_select = $( ".currency-dropdown .acf-input select" ).val();


		// var form_data = {
	 //        'action' : 'save_my_data',
	 //        //'post_id': $button.data( 'post_id' ),
  //   	};

		// // alert(d_val);

	 	form_data.action = 'save_my_data';

	 	$('.currency-dropdown .acf-form-submit .acf-spinner').css('display', 'inline-block');


	    jQuery.post(bb_ajax_object.ajax_url, {"action" : "save_my_data", "val_select" : val_select}) // you will need to get the ajax url for you site
	     .done(function(data){
	     	
	     	//console.log(data);
	     	 //alert('Added successFully :');

	     	$('.currency-dropdown .acf-form-submit .acf-spinner').css('display', 'none');
	       //you get back something like {"result":1,"message":"Validation successful","errors":0}
	     })


	    // $.post(bb_ajax_object.ajax_url, {'action' : 'save_my_data'}, function(response) {
	    // 	console.log(response);
	    // 	$('.currency-dropdown .acf-form-submit .acf-spinner').css('display', 'none');
	    // });

		

	    // jQuery.ajax(
    	// {
	    //     type: "post",
	    //     dataType: "json",
	    //     url: bb_ajax_object.ajax_url,
	    //     data: $("#acf-form").serialize(),
	    //     success: function(data){
	    //         console.log(data);
	    //          alert(5);

	    //          $('.currency-dropdown .acf-form-submit .acf-spinner').css('display', 'none');
    	// });

  	});

});
