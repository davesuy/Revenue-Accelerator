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
class Black_Belt_Profile_Combined_Shortcodes {

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


	public $hash_num;


	public $contact_data;




	public function __construct( $plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->contact_data = $contact_data;
	
	

	}
	



	public function public_profile_combined_shortcodes() {

		add_shortcode( 'bb_tabs_combined', array($this, 'bb_tabs_combined'));

	}

	public function handle_combined_submitted($connect_api_instance) {


		$current_user = wp_get_current_user();
		              
		$user_id = $current_user->ID;

		//echo '<pre>'.print_r($current_user, true).'</pre>';

		// if ( ! delete_user_meta($user_id, 'prefer_check_email') ) {
	 //  		echo "Ooops! Error while deleting this information!";
		// }

		// if ( ! delete_user_meta($user_id, 'prefer_check_sms') ) {
	 //  		echo "Ooops! Error while deleting this information!";
		// }
		

		if(isset($_POST['prefer_submitted'])) {

			if(isset($_POST['prefer_order_email'])) {

				update_user_meta( $user_id, 'prefer_order_email', $_POST['prefer_order_email'] );

			
			}

			if(isset($_POST['prefer_order_sms'])) {

				update_user_meta( $user_id, 'prefer_order_sms', $_POST['prefer_order_sms'] );

			
			}

			if(isset($_POST['prefer_order_facebook'])) {

				update_user_meta( $user_id, 'prefer_order_facebook', $_POST['prefer_order_facebook'] );

			
			}


			if(isset($_POST['prefer_order_phone'])) {

				update_user_meta( $user_id, 'prefer_order_phone', $_POST['prefer_order_phone'] );

			
			}

			if(isset($_POST['prefer_order_contact'])) {

				update_user_meta( $user_id, 'prefer_order_contact', $_POST['prefer_order_contact'] );

			
			}


			if(isset($_POST['prefer_order_voxer'])) {

				update_user_meta( $user_id, 'prefer_order_voxer', $_POST['prefer_order_voxer'] );

			
			}

			if(isset($_POST['prefer_order_whatsapp'])) {

				update_user_meta( $user_id, 'prefer_order_whatsapp', $_POST['prefer_order_whatsapp'] );

			
			}

			if(isset($_POST['prefer_order_carrier'])) {

				update_user_meta( $user_id, 'prefer_order_carrier', $_POST['prefer_order_carrier'] );

			
			}

	

			if(isset($_POST['prefer_check_email'])) {

				update_user_meta( $user_id, 'prefer_check_email', "Yes" );

			
			} else {

				update_user_meta( $user_id, 'prefer_check_email', "No" );

			}

			if(isset($_POST['prefer_check_sms'])) {

				update_user_meta( $user_id, 'prefer_check_sms', "Yes" );

			
			} else {

				update_user_meta( $user_id, 'prefer_check_sms', "No" );
			}



			if(isset($_POST['prefer_check_facebook'])) {

				update_user_meta( $user_id, 'prefer_check_facebook', "Yes" );

			
			} else {

				update_user_meta( $user_id, 'prefer_check_facebook', "No" );

			}

			if(isset($_POST['prefer_check_phone'])) {

				update_user_meta( $user_id, 'prefer_check_phone', "Yes" );

			
			} else {

				update_user_meta( $user_id, 'prefer_check_phone', "No" );

			}


			if(isset($_POST['prefer_check_contact'])) {

				update_user_meta( $user_id, 'prefer_check_contact', "Yes" );

			
			} else {

				update_user_meta( $user_id, 'prefer_check_contact', "No" );
			}


			if(isset($_POST['prefer_check_voxer'])) {

				update_user_meta( $user_id, 'prefer_check_voxer', "Yes" );

			
			} else {

				update_user_meta( $user_id, 'prefer_check_voxer', "No" );

			}

			if(isset($_POST['prefer_check_whatsapp'])) {

				update_user_meta( $user_id, 'prefer_check_whatsapp', "Yes" );

			
			} else {

				update_user_meta( $user_id, 'prefer_check_whatsapp', "No" );
			}


			if(isset($_POST['prefer_check_carrier'])) {

				update_user_meta( $user_id, 'prefer_check_carrier', "Yes" );

			
			} else {

				update_user_meta( $user_id, 'prefer_check_carrier', "No" );

			}

			if(isset($_POST['workshop_materials'])) {

				//update_user_meta( $user_id, 'prefer_check_carrier', "Yes" );
				//$contact_data = $this->contact_data;
				//$pref_val = $contact_data[0]->{"f2377"};

				$connect_api_instance->connect_api_update_preference($_POST['workshop_materials']);
			
				//echo '<pre>'.print_r($contact_data , true).'</pre>';
			} else {

				//update_user_meta( $user_id, 'prefer_check_carrier', "No" );

			}

			
		}

	}

	public function handle_current_level_submitted() {



		$current_user = wp_get_current_user();
		              
		$user_id = 'user_'.$current_user->ID;

		

		if(isset($_POST['belt_submitted'])) {

			if(isset($_POST['last_month_rev'])) {


				$value = array(
				    array( "actual" => $_POST['last_month_rev'])
			
				);

				update_field( 't2_2020_june_actual', $value, $user_id);

			}

		}

	}

	public function bb_tabs_combined($atts) {

		/** Connect API Regsistration **/

		$connect_api_instance = new Wp_Ontraninja_Connect_Ontraport;



		$this->handle_combined_submitted($connect_api_instance);

		$this->handle_current_level_submitted();


		global $current_user;
		              
		$user_id = 'user_' . $current_user->ID;


		$atts = shortcode_atts( array(
		  'field_groups' => array(),
		  'tab_count' => '',

		), $atts, 'bb_tabs' );

		ob_start();



		    $prefer_order_email = get_user_meta( $current_user->ID, 'prefer_order_email', true);
		    $prefer_order_sms = get_user_meta( $current_user->ID, 'prefer_order_sms', true);

		    $prefer_order_facebook = get_user_meta( $current_user->ID, 'prefer_order_facebook', true);
		    $prefer_order_phone = get_user_meta( $current_user->ID, 'prefer_order_phone', true);
		    
		    $prefer_order_contact = get_user_meta( $current_user->ID, 'prefer_order_contact', true);
		    $prefer_order_voxer = get_user_meta( $current_user->ID, 'prefer_order_voxer', true);

		    $prefer_order_whatsapp = get_user_meta( $current_user->ID, 'prefer_order_whatsapp', true);
		    $prefer_order_carrier = get_user_meta( $current_user->ID, 'prefer_order_carrier', true);
		   
		    // Check

		    $prefer_check_email = get_user_meta( $current_user->ID, 'prefer_check_email', true);
		    $prefer_check_sms = get_user_meta( $current_user->ID, 'prefer_check_sms', true);

		    $prefer_check_facebook = get_user_meta( $current_user->ID, 'prefer_check_facebook', true);
			$prefer_check_phone = get_user_meta( $current_user->ID, 'prefer_check_phone', true);
		   
		   	$prefer_check_contact = get_user_meta( $current_user->ID, 'prefer_check_contact', true);
			$prefer_check_voxer = get_user_meta( $current_user->ID, 'prefer_check_voxer', true);
	

  			$prefer_check_whatsapp = get_user_meta( $current_user->ID, 'prefer_check_whatsapp', true);
		    $prefer_check_carrier = get_user_meta( $current_user->ID, 'prefer_check_carrier', true);




		    $updated = "Save";
		    $class = "company-info-con";

		    if($_GET['updated'] == true) {

		      	$updated = "Saved";
		      	$class = "bb-form-updated company-info-con";

		    }

		     //$field_groups_ids = $atts[ 'field_groups'];
			//$field_groups_ids = explode(',', $field_groups_ids);


			$thank_you_url_val = add_query_arg( 'updated', false, get_permalink());





		

			// Contact Meta


			$contact_meta =  $connect_api_instance->contact_meta();

			
			// Companies //


			$company_result = $connect_api_instance->get_company_data();

			// Object Props - [id] [owner] [date] [name]  etc.


			//echo '<pre>'.print_r($company_result, true).'</pre>';

		

			$company_id = $company_result->id;

			$company_name = $company_result->name;


			// Tags //


			//$tag_results = $connect_api_instance->retrieveMultipleTags()->data;

			$tag_results = $company_result;


			// Contacts
			
			$contact_data = $connect_api_instance->contact_data();

			$this->contact_data = $contact_data;

		

			// Blackbelt Color

			$Blackbelt_color = $contact_data[0]->BBBeltColo_354; // 488 ID Color on option
			$Blackbelt_next = $contact_data[0]->{"f2368"}; // 1396 ID Color on option


			$contact_meta_blackbelt_color = $contact_meta->data->{0}->fields->BBBeltColo_354->options->$Blackbelt_color;


			// Next Highest Belt Achieved metaL f2368

			$Blackbelt_next_color = $contact_meta->data->{0}->fields->{"f2368"}->options->$Blackbelt_next; 

			//echo '<pre>'.print_r($Blackbelt_next , true).'</pre>';


			//echo '<pre>'.print_r($contact_meta->data->{0}->fields->BBBeltColo_354->options, true).'</pre>';

			?>


				<div id="acf-form-combined">
			    	<ul class="bb-tabs-combined">	
				
						<li>

							<a>Your Info</a>
						    <section>
						    	<?php

						    		// Local
						    		//echo do_shortcode('[gravityform id="56"  field_values="company='.$company_name.'" title="false" description="false"]');

						    		//Live
						    		echo do_shortcode('[gravityform id="30"  field_values="company='.$company_name.'" title="false" description="false"]');

						    	?>
						    </section>


						</li>


						<li>
							<a>Company</a>
    						<section>

    							<div id="acf-form-combined" class="profile-combined-form">
    								<?php
    								if(!empty(do_shortcode('[wp_ontraninja_partner]'))) {
	    							?>
	    								<div class="acf-fields">
		    								<div class="acf-field">

		    									<div class="acf-label">
		    										<label>Partner</label>
		    									</div>
		    									<?php
		    									echo do_shortcode('[wp_ontraninja_partner]');
		    									?>
		    								</div>
	    								</div>
    								<?php
    								}
    								?>
								
									<div class="acf-fields">
	    								<div class="acf-field">
		    								<div class="acf-label">
												<label id="company_name"><strong>Company Name</strong></label>
												<p style="font-weight: normal"><?php echo $company_name; ?></p>
											</div>
										</div>
									</div>
						    		<?php
								   		
								       $acf_form = acf_form(array(

								            'post_id' => $user_id,
								            //'field_groups'       => array(6442),	// Local
								            'field_groups'       => array(6542), // Live
								            'form' => true,
								            'submit_value' => __($updated , 'acf'),
								            'updated_message'    => 'Updated!',
								            'form_attributes' => array('class' => $class),
								            'return' => add_query_arg( 'updated', true, get_permalink()), 
								           	//'return' => $thank_you_url_val, 

								                
								               
								        ) ); 

								     ?>

								<div class="add-member-con mt-4">
									
								     <div class="acf-label">
										<label><strong>Team Members</strong></label>
									</div>

									<ul class="team-member-lists mb-5" style="margin-left: 0">
									<!-- 	<li>John Doe</li> -->

										<?php
											// Related Companies


											$company_related_results = $connect_api_instance->related_company_data();



											if(!empty($company_related_results)) {

												$company_related_result_output = "";

												foreach($company_related_results as $company_related_result) {


													$company_related_result_output .= '<li>'.$company_related_result->firstname.' '.$company_related_result->lastname.'</li>';

													
												}

												echo $company_related_result_output;
											}

										?>
									</ul>

								    <form action="" method="post" id="add_members_form">
								    	<div class="acf-label">
											<label><strong>New Team Member Information</strong></label>
										</div>

									    <div class="row">
									     	<div class="col-md-5">
										  		<label for="fname">First name:</label>
										  		<p><input type="text" id="fname" name="fname"  required></p>

										  		<label for="lname">Last name:</label>
										  		<p><input type="text" id="lname" name="lname" required></p>
							

										   		<label for="email">Email:</label>
										  		<p><input type="email" id="email" name="email" required></p>
										 
										 	</div>

											<div class="col-md-5">

											  <label for="phone">Mobile Phone:</label>

											  <p><input type="tel" id="phone" name="phone" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"></p>
											

											  <label for="fb_url">Facebook URL:</label>
											  <p><input type="url" id="fb_url" name="fb_url"></p>
											  	
											  <input type="hidden" id="company" name="company" value="<?php echo $company_id; ?>">

											 <!--  <label for="tags">Tags:</label> -->

											<!-- 	<select data-placeholder="Select tags" name="member_tags" id="member_tags" class="bb-tags-select" multiple> -->
													<?php
														// if(!empty($tag_results)) {

														// 	foreach($tag_results as $tag_result) {

														// 		echo '<option value="'.$tag_result->tag_id.'">'.$tag_result->tag_name.'</option>';
														// 	}


														// }		

													?>																				
											<!-- 	</select> -->

											<!-- 	<ul> -->
													<?php
														// if(!empty($tag_results)) {

														// 	echo '<pre>'.print_r($tag_results, true).'</pre>';

														// 	foreach($tag_results as $tag_result) {

																
														// 	}

														// }		

													?>
												  
											
												<!-- </ul> -->

											</div>
										</div>

										<div class="acf-form-submit">
											<input type="submit" class="acf-button button button-primary button-large" value="Add a Member" style="background-color: rgb(46, 50, 54);">
											<span class="acf-spinner"></span>
										</div>

									</form>
								 
								</div>
								</div>
						    </section>


						</li>

						<li>
							
							<a>Preferences</a>
						    <section>
						    <?php
								   		
							       	// $acf_form = acf_form(array(

							        //     'post_id' => $user_id,
							        //     'field_groups'       => array(6466),
							        //     'form' => true,
							        //     'submit_value' => __($updated , 'acf'),
							        //     'updated_message'    => 'Updated!',
							        //     'form_attributes' => array('class' => $class),
							        //     //'return' => add_query_arg( 'updated', false, get_permalink()), 
							        //    	'return' => $thank_you_url_val, 
					               
							        // ) ); 


						    $prefers[] = array("prefer_contact" => "Email", "prefer_order" => $prefer_order_email, "prefer_check" => "No", "prefer_label" => "Email");

						    $prefers[] = array("prefer_contact" => "SMS", "prefer_order" =>  $prefer_order_sms, "prefer_check" => 'No', "prefer_label" => "SMS Text message");

						    $prefers[] = array("prefer_contact" => "facebook", "prefer_order" =>  $prefer_order_facebook, "prefer_check" => 'No', "prefer_label" => "Facebook Messenger");

						    $prefers[] = array("prefer_contact" => "phone", "prefer_order" =>  $prefer_order_phone, "prefer_check" => 'No', "prefer_label" => "Phone Call");

						    //$prefers[] = array("prefer_contact" => "contact", "prefer_order" =>  $prefer_order_contact, "prefer_check" => 'No', "prefer_label" => "Contact my assistant/team mate");

						    //$prefers[] = array("prefer_contact" => "voxer", "prefer_order" =>  $prefer_order_voxer, "prefer_check" => 'No', "prefer_label" => "Voxer");

						   	$prefers[] = array("prefer_contact" => "whatsapp", "prefer_order" =>  $prefer_order_whatsapp, "prefer_check" => 'No', "prefer_label" => "Whatsapp");

						    //$prefers[] = array("prefer_contact" => "carrier", "prefer_order" =>  $prefer_order_carrier, "prefer_check" => 'No', "prefer_label" => "Carrier Pigeon");

							$columns = array_column($prefers, 'prefer_order');
							array_multisort($columns, SORT_ASC, $prefers);

							$class_output = "";

							if(isset($_POST['prefer_submitted'])) {

								$class_output = "prefer_updated";

							}
					

							?>
							<form action="<?php the_permalink(); ?>#!tabset_0=3" class="<?php echo $class_output; ?>" id="preferForm" method="post">

								 <table class="table table-striped">
								 	<thead class="thead-dark text-center">
									    <tr>
									      <th scope="col"><h4>#</h4></th>
									      <th scope="col"><h4>I prefer to be contacted by</h4></th>
									 
									  </tr>
									</thead>

									    <tbody>
									    
												<?php
													$num = 1;

													foreach($prefers as $prefer => $prefer_value) {
													
													
													  ?>
						 
														<tr class="rowNum=<?php echo $num; ?>">

															<td class="text-center" scope="col" width="10%">

																<input class="text-center"  min="0" type="number" name="prefer_order_<?php echo strtolower($prefers[$prefer]['prefer_contact']); ?>" id="preferOrder" countnum="<?php echo $num; ?>" value="<?php echo $prefers[$prefer]['prefer_order']; ?>" />
															</td>

														    <td class="text-center"  scope="col" width="80%"><p><?php echo $prefers[$prefer]["prefer_label"]; ?></p></td>
														      
														  <!--   <td class="text-center" scope="col" width="10%"> -->


														    	<?php

														    	 // $prefer_check = get_user_meta( $current_user->ID, 'prefer_check_'.strtolower($prefers[$prefer]['prefer_contact']), true);



														    	 // 	$prefer_check_output = "";

														    		// if($prefer_check == "Yes") {

														    		// 	$prefer_check_output = "checked";
														    		// }

														    	?>

														    <!-- 	<input type="checkbox" <?php //echo $prefer_check_output; ?> id="preferCheck" name="prefer_check_<?php //echo strtolower($prefers[$prefer]['prefer_contact']); ?>" value=""> -->
														    														    		
														<!--     </td> -->
														

													    </tr>

													<?php
													  $num++;
													}

												?>
										
										</tbody>
								 
								  	</table>

								  		<label for="workshop_materials"><p>Workshop Materials</p></label>

								  		<select name="workshop_materials" id="workshop_materials">

											<?php
														

												$pref_val = $this->contact_data[0]->{"f2377"};

													
													//echo '<pre>'.print_r(	$pref_val , true).'</pre>';
												?>

											  <option value="1413" <?php echo ($pref_val  == 1413 ? "selected" : ""); ?> >Yes, digital for me. I'll always want digital (NERD) version of workshop materials.</option>

											  <option value="1412" <?php echo ($pref_val  == 1412 ? "selected" : ""); ?> >No, let me choose. Ask me each time: I'll decide for each BBI and HTI on print digital.</option>
													
										</select>

							  		<p class="mt-4"><input type="submit" name="prefer_submitted" id="submitted" value="SAVE CHANGES" /></p>
								</form>

						    </section>

						</li>

						<li>

							<a>Belt Level</a>
						    <section>
						    	<?php


									$specifications_group_id = 6334; // Post ID of the specifications field group.
									$specifications_fields = array();
									
									$fields = acf_get_fields( $specifications_group_id );


									foreach ( $fields as $field ) {
										$field_value = get_field( $field['name'] );
										
										if ( $field_value && !empty( $field_value ) ) {
											$specifications_fields[$field['name']] = $field;
											$specifications_fields[$field['name']]['value'] = $field_value;
										}
									}
									
									//return $specifications_fields;


									//echo '<pre>'.print_r($specifications_fields , true).'</pre>';
						    	?>
						    	<div class="row belt-level-con">
						    		<div class="col-md-5">

						    		<div class="text-center">
						    			<h2 class="belt-level-label">Belt Level</h2>


						    			<p><strong>Current Belt Level</strong></p>
						    			<p><span style="font-weight: normal"><?php echo $contact_meta_blackbelt_color; ?></span></p>
						    			<p><strong>Next Highest Belt Achieved</strong></p>
						    			<p><span style="font-weight: normal"><?php echo $Blackbelt_next_color; ?></span></p>

						    			

						    				<p><span class="link-popup" data-toggle="modal" data-target="#infoModal"><strong>How Belts Work</strong></span></p>
						    				<p>To earn your next belt, revenue level at your company must to be consistent for 3 consecutive months.</p>

						    				<p>You maintan your current belt level if your revenue does not increase</p>
											
											<div class="row mb-4 no-gutters">
												<div class="col-md-12 align-middle">
													<p class="align-middle mt-2"><img src="<?php echo plugin_dir_url( __FILE__ ).'images/revenue-blackbelt.png'; ?>" /></p>
												</div>

												<div class="col-md-12 align-left">

													<p class="text-left"><a href="mailto: BlackBelt@moreclients.com.au" class="link-popup"><strong>Need Help?</strong></a></p>
												</div>
											</div>												    				
						    			
						    			
						    			</div>
						    		</div>

						    		<div class="col-md-5">

						    			<div class="text-center">
							    			<h2 class="belt-level-label">Revenue Accelerator</h2>

							    			<p><strong>Last Month's Revenue</strong></p>

							    			<?php

							    			$class_belt_output = "";

											if(isset($_POST['belt_submitted'])) {

												$class_belt_output = "belt_updated";

											}
									

							    			

							    			//echo $current_month;

										    $rows = get_field('tabs_revenue_accelerator', 'options');



												if($rows)
												{
													?>

													<form action="<?php the_permalink(); ?>#!tabset_0=4" id="acf-form" class="rev-acc-form <?php echo $class_belt_output; ?>" method="post">
														<div id="acf-form" class="rev-acc-form">
													    

															<?php


																$prevmonth = strtolower(date('F', strtotime('-1 months')));
																$current_year = date('Y');

																//echo '<pre>'.print_r($prevmonth, true).'</pre>';
																//echo '<pre>'.print_r($current_year, true).'</pre>';


																$acf = acf_get_field_groups();

															
																foreach($acf as $ac => $val) {

																	$title_t = $val['title'];

																	$firstCharacter = substr($title_t, 0, 1);
																	$secondCharacter = substr($title_t, 1, 2);

																	if($firstCharacter == 'T') {
																				//echo '<pre>'.print_r($secondCharacter, true).'</pre>';
																		if(filter_var($secondCharacter, FILTER_VALIDATE_INT) !== false ) {

																		
																			$max_h[] = $secondCharacter;
																		 	
																			//echo '<pre>'.print_r($title_t, true).'</pre>';
																		 	
																		 }

																	}
																
																		

																
																	
																}

																$tt = 't'.max($max_h).'_';
																$tt_o = preg_replace('/\s+/', '',$tt);

																$val_m_y = $tt_o.$current_year.'_'.$prevmonth.'_actual';
															
																$field = get_field_object($val_m_y, $user_id );

																// echo '<pre>'.print_r($val_m_y, true).'</pre>';
																// echo '<pre>'.print_r($user_id, true).'</pre>';

															?>

															<div class="acf-input">

																<p><input type="text" id="last_month_rev_input" class="last_month_rev_input" name="last_month_rev" value="<?php echo $field['value'][0]['actual']; ?> "></p>

															</div>

										
														   <p><input type="submit" name="belt_submitted" id="submitted" value="SAVE" /></p>
														

															
														</div>
													</form>

													<?php
												}



							    			?>
							    	
							    			<p>Revenue is defined as money in the bank<br/>
							    			(not booked future revenue)	
							    			</p>

							    			<p><strong>To Add Previous Months</strong><br/>
							    			<a class="link-popup" target="_blank" href="<?php echo get_bloginfo('url');?>/accelerator"><strong>Go here</strong></a></p>

											<p><span class="link-popup" data-toggle="modal" data-target="#infoModal"><strong>Questions?</strong></span></p>
												
						    			</div>
						    		</div>

						    	</div>
						    </section>


						</li>



				
					</ul>

					
				</div>
			
				<!-- Modal -->
				 <div class="modal fade" id="infoModal" role="dialog">

				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <button type="button" class="close" data-dismiss="modal">&times;</button>
				      <div class="modal-content">

				        <div class="modal-header">
				        
				           <h3>Information:</h3>
				        </div>
				        <div class="modal-body">
				          
							<p>REVENUE ACCELERATOR can be submitted on behalf of Member by partner or team member if they have been authorised to do so. One group of numbers per company.</p>


							<p>Your numbers must be full figures with thousands i.e. 35,000</p>



							<p>Using the dropdown menu, you may change your reporting currency.</p>



							<p>You may backfill numbers by selecting a tab for a group of months such as T1 2020 or T2 2020.</p>




							<p>BELTS: To earn your next belt, your revenue level must be consistent for 3 consecutive months. Revenue is defined as money collected in the bank (not booked future revenue).</p>


							<p>You maintain your current belt level if your revenue does not increase.</p>



							<p>Belt Ceremonies are awarded in March, July, and November.</p>
				        </div>
				   <!--      <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        </div> -->
				      </div>
				      
				    </div>
				</div>
			<?php

		

	   $output = ob_get_clean();

	   return $output;   

	}

}

