<?php

 function wpbrim_carousel_get_option( $option, $section, $default = '' ) {

     $options = get_option( $section );

     if ( isset( $options[$option] ) ) {
         return $options[$option];
     }

     return $default;
 }

function wpbrim_trigger(){
  
?>
<style media="screen">

/* Navigation */
.wbowl-wrap .owl-theme .owl-nav [class*='owl-'] {
 background-color: <?php echo wpbrim_carousel_get_option('navigation-color', 'wb_carousel_others', '#000' ); ?>;
}
 .wbowl-wrap .owl-theme .owl-nav [class*='owl-']:hover {
  background-color: <?php echo wpbrim_carousel_get_option('navigation-hover-color', 'wb_carousel_others', '#343434' ); ?>;

 }
/* Dots */
.wbowl-wrap .owl-theme .owl-dots .owl-dot span {
 background:<?php echo wpbrim_carousel_get_option('dots-color', 'wb_carousel_others', '#000' ); ?>;
}
.wbowl-wrap .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
 background:<?php echo wpbrim_carousel_get_option('dots-hover-color', 'wb_carousel_others', '#343434' ); ?>;
}
</style>

<script type="text/javascript">

jQuery(document).ready(function(){
    jQuery(".owl-carousel").owlCarousel({
      // control
          autoplay:<?php echo wpbrim_carousel_get_option('auto-play','wb_carousel_basics', 'true' ); ?>,
          autoplayHoverPause:<?php  echo wpbrim_carousel_get_option('stop-onhover','wb_carousel_basics', 'true' ); ?>,
          autoplayTimeout:<?php echo wpbrim_carousel_get_option('auto_play_timeout','wb_carousel_basics', 1000 ); ?>,
          loop:<?php echo wpbrim_carousel_get_option('loop','wb_carousel_basics', 'true' ); ?>,
          // Advances
          margin:<?php echo wpbrim_carousel_get_option('margin-val','wb_carousel_advanced',5); ?>,
          nav:<?php echo wpbrim_carousel_get_option('nav-val','wb_carousel_advanced', 'true' ); ?>,
          navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
          autoHeight:<?php echo wpbrim_carousel_get_option('autoheight','wb_carousel_advanced', 'false' ); ?>,
          autoWidth:<?php echo wpbrim_carousel_get_option('autoheight','wb_carousel_advanced', 'false' ); ?>,
          center:<?php echo wpbrim_carousel_get_option('autoheight','wb_carousel_advanced', 'false' ); ?>,
          stagePadding:<?php echo wpbrim_carousel_get_option('stage-padding','wb_carousel_advanced', 'false' ); ?>,
          rtl:<?php echo wpbrim_carousel_get_option('rtl-val','wb_carousel_advanced', 'false' ); ?>,
          dots:<?php echo wpbrim_carousel_get_option('dots-val','wb_carousel_advanced', 'true' ); ?>,
          responsiveClass:true,
          responsive:{
              0:{
                  items:1,
              },
              600:{
                  items:<?php echo wpbrim_carousel_get_option('items-tablet-val','wb_carousel_basics', '3' ); ?>,

              },
              1000:{
                  items:<?php  echo wpbrim_carousel_get_option('medium-desktops','wb_carousel_basics', '4' ); ?>,

              }

          }

  });

});


</script>

<?php
}
add_action('wp_footer','wpbrim_trigger');

add_shortcode('wb-carousel', 'wpbrim_carousel_view' );


function wpbrim_carousel_view($atts) {

	// Attributes
extract( shortcode_atts(
	array(
		'posts_num' => "-1",
		'order' => 'DESC',
		 'carousel_cat'=>'',

	), $atts )
);


$args = array(
		'orderby' => 'date',
		 'order' => $order,
			'carousel_category' =>$carousel_cat,
			 'showposts' => $posts_num,
			'post_type' => 'wb_carousel'
);
  $wpbrim_owl_loop = new WP_Query($args);

  $output = '<div class="wbowl-wrap wb-carousel-container">';
  $output .= '<div class="owl-carousel owl-theme tcowl-nav">';

  if($wpbrim_owl_loop->have_posts()){
      while($wpbrim_owl_loop->have_posts()) {
          $wpbrim_owl_loop->the_post();

          $wpbrim_owl_thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');

          $output .= '<div class="carousel-item">';
             $output .= $wpbrim_owl_thumbnail;

					$output .= '</div>';

      }
  } else {
      echo 'No Carousel Was Found.';
  }
  wp_reset_postdata();
  wp_reset_query();
  $output .= '</div><!--/.wb-carousel-containe-->';
  $output .= '</div><!--/.wb-carousel-demo-->';

  ?>


  <?php
  return $output;

 }


 ?>
