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
class Black_Belt_Profile_Public {

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

		$this->public_load_classes();

	}


	public function public_load_classes() {

		// Shortcodes

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-black-belt-profile-shortcodes.php';

	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Black_Belt_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Black_Belt_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/black-belt-profile-public.css', array(), $this->version, 'all' );

		wp_enqueue_style( "jquery.atAccordionOrTabs",  plugin_dir_url( __FILE__ )  . '/css/jquery.atAccordionOrTabs.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Black_Belt_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Black_Belt_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script('jquery');

    	//wp_enqueue_script( 'autoNumeric', plugin_dir_url( __FILE__ ) . 'js/autoNumeric-jquery.js', array( 'jquery'), $this->version, true );

    	wp_enqueue_script( 'AutoNumeric',  plugin_dir_url( __FILE__ ) . 'js/AutoNumeric.js', array( 'jquery'), $this->version, true );

		wp_enqueue_script( 'jquery.bbq', plugin_dir_url( __FILE__ ) . 'js/jquery.bbq.js', array( 'jquery'), $this->version, true );

		wp_enqueue_script( 'jquery.atAccordionOrTabs', plugin_dir_url( __FILE__ ) . 'js/jquery.atAccordionOrTabs.js', array( 'jquery', 'jquery.bbq' ), $this->version, true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/black-belt-profile-public.js', array( 'jquery',  'jquery.bbq', 'jquery.atAccordionOrTabs'), $this->version, true );


		wp_enqueue_script( 'ajax-script',  plugin_dir_url( __FILE__ )  . 'js/black-belt-profile-acf.js', array('jquery'), null, true);

    	wp_localize_script( 'ajax-script', 'bb_ajax_object',
            array( 

            	'ajax_url' => admin_url( 'admin-ajax.php' ) 

        	) 

        );




	}


	public function acf_form_hook_header() {

		 acf_form_head(); 

	}


	public function load_field_test_hidden_field($field) {

		$condition = false; 


		if (!$condition) {

			$current_month = date('m') - 1;

			$month = $field['instructions'];
			$nmonth = date("m", strtotime($month));

		    if (strpos($month, '2019') === false) {

		  		if( $nmonth > $current_month) {

		  			$field['wrapper']['class'] = 'disable-gray';

		  		} else {

		         $field['wrapper']['class'] = '';

		      }


		    }
		
		}


		return $field;
	

	}


	public function bb_rest_prepare_user( $response, $user, $request ) {

	    $response->data[ 'first_name' ] = get_user_meta( $user->ID, 'first_name', true );
	    $response->data[ 'last_name' ] = get_user_meta( $user->ID, 'last_name', true );

	    $user_info = get_userdata($user->ID);

	     $response->data[ 'user_email' ] = $user_info->user_email;
	     $response->data[ 'user_registered' ] = $user_info->user_registered;

	    return $response;

	}

	
	public function bb_rest_request_before_callbacks( $response, $handler, $request ) {

	    if ( WP_REST_Server::READABLE !== $request->get_method() ) {
	        return $response;
	    }

	    if ( ! preg_match( '~/wp/v2/users/\d+~', $request->get_route() ) ) {
	        return $response;
	    }

	    add_filter( 'get_usernumposts', function( $count ) {
	        return $count > 0 ? $count : 1;
	    } );

	    return $response;

	}



	public function get_user_list($request) {
	   //below you can change to a WQ_Query and customized it to ensure the list is exactly what you need
	   $results = get_users();

	   //Using the default controller to ensure the response follows the same structure as the default route
	   $users = array();
	   $controller = new WP_REST_Users_Controller();
	   foreach ( $results as $user ) {
	        $data    = $controller->prepare_item_for_response( $user, $request );
	        $users[] = $controller->prepare_response_for_collection( $data );
	    }

	   return rest_ensure_response( $users );
	}


	public function bb_register_routes() {

		register_rest_route( 'wp/v2', '/allusers', array(
		    'methods'             => WP_REST_Server::READABLE,
		    'callback'            => array($this, 'get_custom_user_list'),
		    'show_in_rest' => true
		));

	}


	public function get_custom_user_list() {

		$args = [
			array( 'fields' => array( 'ID', 'display_name', 'user_nicename', 'user_email') ) 
		];

		$users = get_users($args);

		$data = [];

		$i = 0;

		foreach($users as $user_id) {

			$id = $user_id->data->ID;
			$user_acf_id = 'user_' . $id;

			//$data[$i]['id'] = $user_id->data->ID;
			//$data[$i]['name'] = $user_id->data->display_name;
			$data[$i]['email'] = $user_id->data->user_email;



			if(function_exists('get_field')) {

				if( get_field('Currencies', $user_acf_id)) {

					$data[$i]['currency'] = get_field('Currencies', $user_acf_id);

				} else {

					$data[$i]['currency'] = "";
				}

				//////////

				if( get_field('t2_2019_april_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/04/2019'] = str_replace($rep, '', get_field('t2_2019_april_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/04/2019'] = "";

				}

				//////////


				if( get_field('t2_2019_may_actual', $user_acf_id)) {

					$rep = [",", "null"];
				
					$data[$i]['revenue']['01/05/2019'] =  str_replace($rep, '', get_field('t2_2019_may_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/05/2019'] = "";
				}

				//////////

				if( get_field('t2_2019_june_actual', $user_acf_id)) {

					$rep = [",", "null"];
				
					$data[$i]['revenue']['01/06/2019'] = str_replace($rep, '', get_field('t2_2019_june_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/06/2019'] = "";

				}

				//////////

				if( get_field('t2_2019_july_actual', $user_acf_id)) {

					$rep = [",", "null"];
					
					$data[$i]['revenue']['01/07/2019'] = str_replace($rep, '', get_field('t2_2019_july_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/07/2019'] = "";

				}
					
				//////////

				if( get_field('t3_2019_august_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/08/2019'] = str_replace($rep, '', get_field('t3_2019_august_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/08/2019'] = "";

				}

				//////////

				if( get_field('t3_2019_september_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/09/2019'] = str_replace($rep, '', get_field('t3_2019_september_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/09/2019'] = "";

				}

				//////////

				if( get_field('t3_2019_october_actual', $user_acf_id)) {	

					$rep = [",", "null"];

					$data[$i]['revenue']['01/10/2019'] = str_replace($rep, '', get_field('t3_2019_october_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/10/2019'] = "";

				}

				//////////

				if( get_field('t3_2019_november_actual', $user_acf_id)) {	

					$rep = [",", "null"];

					$data[$i]['revenue']['01/11/2019'] = str_replace($rep, '', get_field('t3_2019_november_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/11/2019'] = "";
				}
					
				//////////

				if( get_field('t1_2020_december_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/12/2019'] = str_replace($rep, '', get_field('t1_2020_december_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/12/2019'] = "";

				}

				//////////

				if( get_field('t1_2020_january_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/01/2020'] =  str_replace($rep, '', get_field('t1_2020_january_actual', $user_acf_id)[0]['actual']);
					

				} else {

					$data[$i]['revenue']['01/01/2020'] = "";

				}

				//////////

				if( get_field('t1_2020_february_actual', $user_acf_id)) {	

					$rep = [",", "null"];

					$data[$i]['revenue']['01/02/2020'] = str_replace($rep, '', get_field('t1_2020_february_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/02/2020'] = "";

				}

				//////////

				if( get_field('t1_2020_march_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/03/2020'] = str_replace($rep, '', get_field('t1_2020_march_actual', $user_acf_id)[0]['actual']);
				
				} else {

					$data[$i]['revenue']['01/03/2020'] = "";

				}

				//////////
			
				if( get_field('t2_2020_april_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/04/2020'] = str_replace($rep, '', get_field('t2_2020_april_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/04/2020'] = "";

				}

				//////////

				if( get_field('t2_2020_may_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/05/2020'] =  str_replace($rep, '',get_field('t2_2020_may_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/05/2020'] = "";

				}

				//////////

				if( get_field('t2_2020_june_actual', $user_acf_id)) {

					$rep = [",", "null"];


					$data[$i]['revenue']['01/06/2020'] = str_replace($rep, '', get_field('t2_2020_june_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/06/2020'] = "";

				}

				//////////

				if( get_field('t2_2020_july_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/07/2020'] = str_replace($rep, '', get_field('t2_2020_july_actual', $user_acf_id)[0]['actual']);
				
				} else {

					$data[$i]['revenue']['01/07/2020'] = "";
				}

				//////////
			
				if( get_field('t3_2020_august_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/08/2020'] = str_replace($rep, '', get_field('t3_2020_august_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/08/2020'] = "";

				}

				//////////

				if( get_field('t3_2020_september_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/09/2020'] = str_replace($rep, '', get_field('t3_2020_september_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/09/2020'] = "";

				}

				//////////

				if( get_field('t3_2020_october_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/10/2020'] = str_replace($rep, '', get_field('t3_2020_october_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/10/2020'] = "";
				}

				//////////

				if( get_field('t3_2020_november_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/11/2020'] = str_replace($rep, '', get_field('t3_2020_november_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/11/2020'] = "";

				}
					
		
			}
		    
		    //print_r(get_user_meta ( $user_id->ID));

		    $i++;
		 }

		 return $data;
			


	}


	public function bb_single_register_routes() {

		register_rest_route( 'wp/v2', '/allusers/(?P<id>\d+)', array(
		    'methods'             => WP_REST_Server::READABLE,
		    'callback'            => array($this, 'get_single_custom_user_list'),
		    'args' => [
			        'id'
			   ],
		    'show_in_rest' => true
		));

	}

	public function get_single_custom_user_list($id) {

	

			
		$user_id  = get_user_by('ID', $id['id']);



	    //echo '<pre>'.print_r($users, true).'dx</pre>';

		//$data = [];

		//$i = 0;

		//foreach($users as $user_id) {

			$id = $user_id->data->ID;
			$user_acf_id = 'user_' . $id;

			$data['id'] = $user_id->data->ID;
			$data['name'] = $user_id->data->display_name;
			$data['email'] = $user_id->data->user_email;


			if(function_exists('get_field')) {

				if( get_field('Currencies', $user_acf_id)) {

					$data[$i]['currency'] = get_field('Currencies', $user_acf_id);

				} else {

					$data[$i]['currency'] = "";
				}

				

				//////////

				if( get_field('t2_2019_april_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/04/2019'] = str_replace($rep, '', get_field('t2_2019_april_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/04/2019'] = "";

				}

				//////////


				if( get_field('t2_2019_may_actual', $user_acf_id)) {

					$rep = [",", "null"];
				
					$data[$i]['revenue']['01/05/2019'] =  str_replace($rep, '', get_field('t2_2019_may_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/05/2019'] = "";
				}

				//////////

				if( get_field('t2_2019_june_actual', $user_acf_id)) {

					$rep = [",", "null"];
				
					$data[$i]['revenue']['01/06/2019'] = str_replace($rep, '', get_field('t2_2019_june_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/06/2019'] = "";

				}

				//////////

				if( get_field('t2_2019_july_actual', $user_acf_id)) {

					$rep = [",", "null"];
					
					$data[$i]['revenue']['01/07/2019'] = str_replace($rep, '', get_field('t2_2019_july_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/07/2019'] = "";

				}
					
				//////////

				if( get_field('t3_2019_august_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/08/2019'] = str_replace($rep, '', get_field('t3_2019_august_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/08/2019'] = "";

				}

				//////////

				if( get_field('t3_2019_september_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/09/2019'] = str_replace($rep, '', get_field('t3_2019_september_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/09/2019'] = "";

				}

				//////////

				if( get_field('t3_2019_october_actual', $user_acf_id)) {	

					$rep = [",", "null"];

					$data[$i]['revenue']['01/10/2019'] = str_replace($rep, '', get_field('t3_2019_october_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/10/2019'] = "";

				}

				//////////

				if( get_field('t3_2019_november_actual', $user_acf_id)) {	

					$rep = [",", "null"];

					$data[$i]['revenue']['01/11/2019'] = str_replace($rep, '', get_field('t3_2019_november_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/11/2019'] = "";
				}
					
				//////////

				if( get_field('t1_2020_december_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/12/2019'] = str_replace($rep, '', get_field('t1_2020_december_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/12/2019'] = "";

				}

				//////////

				if( get_field('t1_2020_january_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/01/2020'] =  str_replace($rep, '', get_field('t1_2020_january_actual', $user_acf_id)[0]['actual']);
					

				} else {

					$data[$i]['revenue']['01/01/2020'] = "";

				}

				//////////

				if( get_field('t1_2020_february_actual', $user_acf_id)) {	

					$rep = [",", "null"];

					$data[$i]['revenue']['01/02/2020'] = str_replace($rep, '', get_field('t1_2020_february_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/02/2020'] = "";

				}

				//////////

				if( get_field('t1_2020_march_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/03/2020'] = str_replace($rep, '', get_field('t1_2020_march_actual', $user_acf_id)[0]['actual']);
				
				} else {

					$data[$i]['revenue']['01/03/2020'] = "";

				}

				//////////
			
				if( get_field('t2_2020_april_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/04/2020'] = str_replace($rep, '', get_field('t2_2020_april_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/04/2020'] = "";

				}

				//////////

				if( get_field('t2_2020_may_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/05/2020'] =  str_replace($rep, '',get_field('t2_2020_may_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/05/2020'] = "";

				}

				//////////

				if( get_field('t2_2020_june_actual', $user_acf_id)) {

					$rep = [",", "null"];


					$data[$i]['revenue']['01/06/2020'] = str_replace($rep, '', get_field('t2_2020_june_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/06/2020'] = "";

				}

				//////////

				if( get_field('t2_2020_july_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/07/2020'] = str_replace($rep, '', get_field('t2_2020_july_actual', $user_acf_id)[0]['actual']);
				
				} else {

					$data[$i]['revenue']['01/07/2020'] = "";
				}

				//////////
			
				if( get_field('t3_2020_august_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/08/2020'] = str_replace($rep, '', get_field('t3_2020_august_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/08/2020'] = "";

				}

				//////////

				if( get_field('t3_2020_september_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/09/2020'] = str_replace($rep, '', get_field('t3_2020_september_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/09/2020'] = "";

				}

				//////////

				if( get_field('t3_2020_october_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/10/2020'] = str_replace($rep, '', get_field('t3_2020_october_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/10/2020'] = "";
				}

				//////////

				if( get_field('t3_2020_november_actual', $user_acf_id)) {

					$rep = [",", "null"];

					$data[$i]['revenue']['01/11/2020'] = str_replace($rep, '', get_field('t3_2020_november_actual', $user_acf_id)[0]['actual']);

				} else {

					$data[$i]['revenue']['01/11/2020'] = "";

				}
					
			}
		    
		    //print_r(get_user_meta ( $user_id->ID));

		    //$i++;
		 //}

		 return $data;


	}



	public function acf_form_sub($form, $post_id) {

	    // vars
	    $return = acf_maybe_get($form, 'return', '');
	    
	    
	    // redirect
	    if( $return ) {
	      
	      // update %placeholders%
	      $return = str_replace('%post_id%', $post_id, $return);
	      $return = str_replace('%post_url%', get_permalink($post_id), $return);
	      
	      
	      // redirect

	      $location = "http://localhost/wordpress_testing/s";
	      
	      header( "Location: $location");
	      exit;
      
    	}

    }

    public function my_acf_op_init() {

	    // Check function exists.
	    if( function_exists('acf_add_options_page') ) {

	        // Register options page.
	        $option_page = acf_add_options_page(array(
	            'page_title'    => __('Revenue Accelerator Settings'),
	            'menu_title'    => __('Revenue Accelerator Settings'),
	            'menu_slug'     => 'revenue-accelerator-settings',
	            'capability'    => 'edit_posts',
	            'redirect'      => false
	        ));
	    }

	}

	public function bb_acf_form_dropdown_save() {

		global $current_user;
	              
	    $user_id = 'user_' . $current_user->ID;


	    if($_POST['val_select']) {

			update_field('Currencies', $_POST['val_select'], $user_id);

		}

		echo $_POST['val_select'];
		die();
	}



}
