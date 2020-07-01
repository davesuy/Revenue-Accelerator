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


	}


	public function public_shortcodes() {

		add_shortcode( 'ti_acf_form', array($this,'ti_acf_form'));

		add_shortcode( 'bb_tabs', array($this, 'bb_tabs'));

		add_shortcode( 'bb_address_map', array($this, 'bb_address_map'));


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


	      	$thank_you_url = get_field( "thank_you_page_url", "options" );

	      	$thank_you_url_val = "";

			if( $thank_you_url ) {

				$thank_you_url_val = $thank_you_url;

			}
			  
	   
	       $acf_form = acf_form(array(

	            'post_id' => $user_id,
	            'field_groups'       => $field_groups_ids,
	            'form' => false,
	            'submit_value' => __($updated , 'acf'),
	            'updated_message'    => 'Updated!',
	            'form_attributes' => array('class' => $class),
	            //'return' => add_query_arg( 'updated', 'true', get_permalink().  $html_e ), 
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
			<div id="acf-form">
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
