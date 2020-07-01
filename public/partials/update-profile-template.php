<?php
/**
 *
 * Template Name: Update Profile
 * Description: Update Profile template
 *
 */

  get_header();

  /**
   * Fires after the header, before the content sidebar wrap.
   *
   * @since 1.0.0
   */
  do_action( 'genesis_before_content_sidebar_wrap' );

  genesis_markup(
    array(
      'open'    => '<div %s>',
      'context' => 'content-sidebar-wrap',
    )
  );

    /**
     * Fires before the content, after the content sidebar wrap opening markup.
     *
     * @since 1.0.0
     */
    do_action( 'genesis_before_content' );

    genesis_markup(
      array(
        'open'    => '<main %s>',
        'context' => 'content',
      )
    );

      /**
       * Fires before the loop hook, after the main content opening markup.
       *
       * @since 1.0.0
       */
      do_action( 'genesis_before_loop' );

      /**
       * Fires to display the loop contents.
       *
       * @since 1.1.0
       */
      //do_action( 'genesis_loop' );

        global $current_user;
                
        $user_id = 'user_' . $current_user->ID;


        $updated = "Save";
        $class = "";

        if($_GET['updated'] == true) {
          $updated = "Saved";
          $class = "bb-form-updated";
        }

        $field_groups_ids = 6379;
        $field_groups_ids = explode(',', $field_groups_ids);
     
         $acf_form = acf_form(array(

              'post_id' => $user_id,
              'field_groups'       => $field_groups_ids,
              'form' => false,
              'submit_value' => __($updated , 'acf'),
              'updated_message'    => 'Updated!',
              'form_attributes' => array('class' => $class),
              //'return' => add_query_arg( 'updated', 'true', get_permalink().  $html_e ), 
              //'return' => get_bloginfo('url').'/the-half-time-intensive/thank-you/', 

                  
                 
          ) ); 


        //$output = ob_get_clean();

        //return $output;   

      /**
       * Fires after the loop hook, before the main content closing markup.
       *
       * @since 1.0.0
       */
      do_action( 'genesis_after_loop' );

    genesis_markup(
      array(
        'close'   => '</main>', // End .content.
        'context' => 'content',
      )
    );

    /**
     * Fires after the content, before the main content sidebar wrap closing markup.
     *
     * @since 1.0.0
     */
    do_action( 'genesis_after_content' );

  genesis_markup(
    array(
      'close'   => '</div>',
      'context' => 'content-sidebar-wrap',
    )
  );

  /**
   * Fires before the footer, after the content sidebar wrap.
   *
   * @since 1.0.0
   */
  do_action( 'genesis_after_content_sidebar_wrap' );

  get_footer();

  ?>