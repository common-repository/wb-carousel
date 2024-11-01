<?php

add_filter('manage_edit-wb_carousel_columns', 'add_new_wb_carousel_columns');
function add_new_wb_carousel_columns($wb_carousel_columns) {


  $new_columns= array(
    'cb' => '<input type="checkbox" />',
    'title' => __( 'Title' ),
    'featured_image' => __( 'Carousel Images' ),
    'carousel_cat'=>_('Carousel Category'),
    'author' => __( 'Author' ),
    'date' => __( 'Date' )
  );


    return $new_columns;
}

add_action('manage_wb_carousel_posts_custom_column', 'manage_wb_carousel_columns', 10, 2);

function get_wb_carousel($post_ID)
{
    $wbcarouse_id = get_post_thumbnail_id($post_ID);
    return $wbcarouse_url = wp_get_attachment_image_src($wbcarouse_id, array(40,40), true);
}

function manage_wb_carousel_columns( $column,$post_ID) {
  $wbcarouse=get_wb_carousel($post_ID);
    switch ( $column ) {
	case 'featured_image' :
		global $post;
		$slug = '' ;
		$slug = $post->ID;
    $featured_image ='<img src="' . $wbcarouse[0] . '" width="90px"/>';
    echo $featured_image;
    break;
  case 'carousel_cat' :
   $carousel_cats = wp_get_post_terms($post_ID, 'carousel_category', array("fields" => "names"));
     foreach ( $carousel_cats as $carousel_cat ) {
           echo $carousel_cat.'<br>';

   }
    break;
    }
}


 ?>
