<?php
/**
 * WordPress settings API demo class
 *
 *
 */
if ( !class_exists('Wpbrim_Carousel_Settings_API_Test' ) ):
class Wpbrim_Carousel_Settings_API_Test {

    private $settings_api;

    function __construct() {
        $this->settings_api = new Wpbrim_Carousel_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'sub_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'edit.php?post_type=wb_carousel', 'Settings API', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
    }

     function sub_menu()
    {
      add_submenu_page( 'edit.php?post_type=wb_carousel','Carousel Settings','Carousel Settings', 'manage_options','carousel-settings',array($this, 'plugin_page'));
    }

    function my_custom_submenu_page_callback() {

    	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    		echo '<h2>My Custom Submenu Page</h2>';
    	echo '</div>';

    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'wb_carousel_basics',
                'title' => __( 'Basic Settings', 'wb-carousel' )
            ),
            array(
                'id' => 'wb_carousel_advanced',
                'title' => __( 'Advanced Settings', 'wb-carousel' )
            ),
            array(
                'id' => 'wb_carousel_others',
                'title' => __( 'General Styling', 'wb-carousel' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wb_carousel_basics' => array(

              array(
                  'name'    => 'auto-play',
                  'label'   => __( 'Auto Play', 'wb-carousel' ),
                  'desc'    => __( 'By default  Auto Play is active.', 'wb-carousel' ),
                  'type'    => 'select',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'    => 'auto_play_timeout',
                  'label'   => __( 'Auto Play Timeout', 'wb-carousel' ),
                  'desc'    => __( 'Set autoplay Timeout', 'wb-carousel' ),
                  'type'              => 'text',
                  'default'           => 1000,
                  'sanitize_callback' => 'intval'
              ),
              array(
                  'name'    => 'stop-onhover',
                  'label'   => __( 'Stop On Hover', 'wb-carousel' ),
                  'desc'    => __( 'By default  Stop On Hover is active.', 'wb-carousel' ),
                  'type'    => 'select',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'    => 'loop',
                  'label'   => __( 'Carousel Loop', 'wb-carousel' ),
                  'desc'    => __( 'By default Loop is active.', 'wb-carousel' ),
                  'type'    => 'select',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),

              array(
                  'name'              => 'medium-desktops',
                  'label'             => __( 'Items Number ( Desktop )', 'wb-carousel' ),
                  'desc'              => __( 'Any Numaric value. 4 is recomended', 'wb-carousel' ),
                  'type'              => 'text',
                  'default'           => 4,
                  'sanitize_callback' => 'intval'
              ),

              array(
                  'name'              => 'items-tablet-val',
                  'label'             => __( 'Items Number ( Tablet )', 'wb-carousel' ),
                  'desc'              => __( 'Any Numaric value. 2 is recomended', 'wb-carousel' ),
                  'type'              => 'text',
                  'default'           => 2,
                  'sanitize_callback' => 'intval'
              )


            ),
            'wb_carousel_advanced' => array(

                array(
                    'name'    => 'nav-val',
                    'label'   => __( 'Navigation ', 'wb-carousel' ),
                    'desc'    => __( 'DroEnable/Disable Navigation', 'wb-carousel' ),
                    'type'    => 'select',
                    'default' => 'true',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),
                array(
                    'name'    => 'dots-val',
                    'label'   => __( 'Dots ', 'wb-carousel' ),
                    'desc'    => __( 'Enable/Disable Dots', 'wb-carousel' ),
                    'type'    => 'select',
                    'default' => 'true',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),
                array(
                    'name'    => 'autoheight',
                    'label'   => __( 'Auto Height', 'wb-carousel' ),
                    'desc'    => __( 'Enable/Disable Auto Height', 'wb-carousel' ),
                    'type'    => 'select',
                    'default' => 'false',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),
                array(
                    'name'    => 'auto-width',
                    'label'   => __( 'Auto Width', 'wb-carousel' ),
                    'desc'    => __( 'Image width will be automatic', 'wb-carousel' ),
                    'type'    => 'select',
                    'default' => 'false',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),
                array(
                    'name'    => 'center',
                    'label'   => __( 'Center Images', 'wb-carousel' ),
                    'desc'    => __( 'Center the carousel Image.', 'wb-carousel' ),
                    'type'    => 'select',
                    'default' => 'false',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),
                array(
                    'name'    => 'rtl-val',
                    'label'   => __( 'Right To Left', 'wb-carousel' ),
                    'desc'    => __( 'Right To Left', 'wb-carousel' ),
                    'type'    => 'select',
                    'default' => 'false',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),

                array(
                    'name'              => 'stage-padding',
                    'label'             => __( 'Stage Padding', 'wb-carousel' ),
                    'desc'              => __( 'Any Numaric value. 2 is recomended', 'wb-carousel' ),
                    'type'              => 'text',
                    'default'           => 0,
                    'sanitize_callback' => 'intval'
                ),
                array(
                    'name'              => 'margin-val',
                    'label'             => __( 'Margin', 'wb-carousel' ),
                    'desc'              => __( 'Any Numaric value.', 'wb-carousel' ),
                    'type'              => 'text',
                    'default'           => 5,
                    'sanitize_callback' => 'intval'
                )

            ),
            'wb_carousel_others' => array(

              array(
                  'name'    => 'navigation-color',
                  'label'   => __( 'Navigation Color', 'wb-carousel' ),
                  'desc'    => __( 'navigation Button Color', 'wb-carousel' ),
                  'type'    => 'color',
                  'default' => '#282830'
              ),
              array(
                  'name'    => 'navigation-hover-color',
                  'label'   => __( 'Navigation Hover Color', 'wb-carousel' ),
                  'desc'    => __( 'Navigation Hover Color', 'wb-carousel' ),
                  'type'    => 'color',
                  'default' => '#60646D'
              ),
              array(
                  'name'    => 'dots-color',
                  'label'   => __( 'Dots Color', 'wb-carousel' ),
                  'desc'    => __( 'Dots Button Color', 'wb-carousel' ),
                  'type'    => 'color',
                  'default' => '#000000'
              ),
              array(
                  'name'    => 'dots-hover-color',
                  'label'   => __( 'Dots Hover Color', 'wb-carousel' ),
                  'desc'    => __( 'Dots Hover Color', 'wb-carousel' ),
                  'type'    => 'color',
                  'default' => '#343434'
              )
            )

        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap-setting-carousel">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
