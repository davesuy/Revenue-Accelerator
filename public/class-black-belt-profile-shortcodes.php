<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       dev@itmooti.com
 * @since      1.0.0
 *
 * @package    Black_Belt_Profile
 * @subpackage Black_Belt_Profile/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Black_Belt_Profile
 * @subpackage Black_Belt_Profile/public
 * @author     ITMOOTI <dev@itmooti.com>
 */
class Black_Belt_Profile_Shortcodes {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('acf/save_post', array($this, 'save_post'), 5);

	}
	
	public function save_post($post_id){
		global $current_user;
		$user_id = 'user_' . $current_user->ID;
		if($post_id == $user_id){
			$month = strtolower(date("F", strtotime("last month")));
			if(in_array($month, array('november','december','january','february'))){
				$term = "t1";
			} else if(in_array($month, array('march','april','may','june'))){
				$term = "t2";
			} else {
				$term = "t3";
			}
			$field = $term."_".date("Y", strtotime("last month"))."_".$month."_actual";
			$field_object = get_field_object($field, $post_id);
			if(isset($_POST["acf"][$field_object["key"]])){
				$value = array_values($_POST["acf"][$field_object["key"]]);
				$value = $value[0];
				$value = array_values($value);
				$value = $value[0];
				if(!empty($value) && empty($field_object["value"][0]["actual"])){
					file_get_contents('https://hooks.zapier.com/hooks/catch/77889/o80gw5t/?email='.$current_user->user_email);
				}
			}
		}
	}


	public function public_shortcodes() {

		add_shortcode( 'ti_acf_form', array($this,'ti_acf_form'));

		add_shortcode( 'bb_tabs', array($this, 'bb_tabs'));

		add_shortcode( 'bb_address_map', array($this, 'bb_address_map'));


		// $user_id = 1675;
		// $website = 'http://example.comx';
		 
		// $user_data = wp_update_user( array( 'ID' => $user_id, 'user_url' => $website ) );
		 
		// if ( is_wp_error( $user_data ) ) {
		//     // There was an error; possibly this user doesn't exist.
		//     echo 'Error.';
		// } else {
		//     // Success!
		// }


		 // global $current_user;
	              
	  //     $user_id = 'user_' . $current_user->ID;

	  //     echo $user_id.'xcx';


		global $current_user;

		$user_id = $current_user->ID;
	              
	    $user_acf_id = 'user_' . $current_user->ID;
	    $email = $current_user->user_email;

	    
		// //$website = "www.website.com";
		 
		// $user_data = wp_update_user( array( 'ID' => $user_id, 'user_url' => $website ) );
		 
		// if ( is_wp_error( $user_data ) ) {
		//     // There was an error; possibly this user doesn't exist.
		//     echo 'Error.';
		// } else {
		//     // Success!
		// }

	 //    if( get_field('t2_2020_june_actual', $user_acf_id)) {

		// 	$month = '01/06/2020';
		// 	$value_june = get_field('t2_2020_june_actual', $user_acf_id);
		

		// 	//echo '<pre>'.print_r($value_june[0]['actual'], true).'</pre>';

		

		// 	wp_remote_post("https://hooks.zapier.com/hooks/catch/108162/o8n3a05/?email='".$email."'&month='".$month."'&value='".$value_june[0]['actual']."'");

		// }


		// if( get_field('t2_2020_may_actual', $user_acf_id)) {

		// 	$month = '01/05/2020';
		// 	$value_may = get_field('t2_2020_may_actual', $user_acf_id);


		// 	//echo '<pre>'.print_r($value_may[0]['actual'], true).'</pre>';
		

		// 	wp_remote_post("https://hooks.zapier.com/hooks/catch/108162/o8n3a05/?email='".$email."'&month='".$month."'&value='".$value_may[0]['actual']."'");

		// }





	}


	public function ti_acf_form($atts) {


	    $atts = shortcode_atts( array(
	          'field_groups' => array(),
	          'tab_count' => '',
	 
	      ), $atts, 'ti_acf_form' );

	    
	    ob_start();

	     $args = [
			array( 'fields' => array( 'ID', 'display_name', 'user_nicename', 'user_email') ) 
		];

		$users = get_users($args);

		


		//foreach($users as $user_id){ 
			//echo '<pre>'.print_r($user_id, true).'</pre>';
		//}

	      global $current_user;
	              
	      $user_id = 'user_' . $current_user->ID;

	      $html_e = "";
	      $v_bar = "|";

	      if($atts[ 'tab_count']) {

	            $tab_count = $atts[ 'tab_count'];

	          
	            $html_e =  "/#ontratabs".$v_bar.$tab_count;
	      }

	      $updated = "Save";
	      $class = "";

	      if($_GET['updated'] == true) {
	      	$updated = "Saved";
	      	$class = "bb-form-updated";
	      }

	      $field_groups_ids = $atts[ 'field_groups'];
	      $field_groups_ids = explode(',', $field_groups_ids);


	      	//$thank_you_url = get_field( "thank_you_page_url", "options" );

	      	//$thank_you_url_val = "";

			//if( $thank_you_url && !is_page('accelerator')) {

				//$thank_you_url_val = $thank_you_url;

			//} elseif(is_page('accelerator')) {

				 $thank_you_url_val = add_query_arg( 'updated', false, get_permalink());
			//}
			  
	   		echo '<input type="hidden" class="debug-ty" name="'.$thank_you_url_val.'"/>';
	   		
	       $acf_form = acf_form(array(

	            'post_id' => $user_id,
	            'field_groups'       => $field_groups_ids,
	            'form' => false,
	            'submit_value' => __($updated , 'acf'),
	            'updated_message'    => 'Updated!',
	            'form_attributes' => array('class' => $class),
	            //'return' => add_query_arg( 'updated', false, get_permalink()), 
	           	'return' => $thank_you_url_val, 

	                
	               
	        ) ); 


	      $output = ob_get_clean();

	      return $output;   

	}


	public function bb_tabs($atts) {

		  $atts = shortcode_atts( array(
	          'field_groups' => array(),
	          'tab_count' => '',
	 
	      ), $atts, 'bb_tabs' );

	    ob_start();

	    $rows = get_field('tabs_revenue_accelerator', 'options');

	 //    global $current_user;

	 //    $id = $current_user->ID;

	 //   $user_acf_id = 'user_' . $id;

		// $user = get_field('t1_2020_january_actual', $user_acf_id);

		// $t = get_user_meta($id);
		// $c = get_user_meta($id, '_t1_2020_january_actual');


	
	     //echo '<pre>'.print_r($c, true).'ds</pre>';


		if($rows)
		{
			?>

			<form id="post" class="acf-form" action="" method="post">
				<div id="acf-form" class="rev-acc-form">
			    	<ul class="bb-tabs">

					<?php

					foreach($rows as $row)
					{

						$field_label = acf_get_fields($row['periods']);

						$label = $field_label[0]['label'];

						?>
						<li><a><?php echo $label; ?></a>
						    <section>
						    	<?php echo do_shortcode('[ti_acf_form field_groups="'.$row['periods'] .'"]'); ?>
						    </section>


						</li>

						<?php
					}

					?>
						<div class="acf-form-submit">
					        <input type="submit" class="acf-button button button-primary button-large" value="Save">
					        <span class="acf-spinner"></span>
		    			</div>
					</ul>

					
				</div>
			</form>

			<?php
		}


	   $output = ob_get_clean();

	   return $output;   

	}

	public function bb_address_map($atts) {

		  $atts = shortcode_atts( array(
	          'field_map' => array(),
	          'map_count' => '',
	 
	      ), $atts, 'bb_address_map' );

	    ob_start();

		    global $current_user;

		    $id = $current_user->ID;

		   	$user_acf_id = 'user_' . $id;


		    $street_mailing_address = get_field('street_mailing_address', $user_acf_id);
		    $street_mailing_address_2 = get_field('street_mailing_address_2', $user_acf_id);
		    $street_mailing_address_city = get_field('street_mailing_address_city', $user_acf_id);
		    $street_mailing_address_state = get_field('street_mailing_address_state', $user_acf_id);
		    $street_mailing_address_postal = get_field('street_mailing_address_postal', $user_acf_id);
		    $street_mailing_address_country = get_field('street_mailing_address_country', $user_acf_id);


		    if($street_mailing_address) {

		    	echo $street_mailing_address.' '.$street_mailing_address_2.' '. $street_mailing_address_city.', '.$street_mailing_address_state.', '.$street_mailing_address_country;

		    }



	   $output = ob_get_clean();

	   return $output;   

	}





}
