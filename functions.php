<?php /*

  This file is part of a child theme called Pinkstone 2016.
  Functions in this file will be loaded before the parent theme's functions.
  For more information, please read https://codex.wordpress.org/Child_Themes.

  Add your own functions below this line.
  ========================================== */ 

// pull in parent theme's styles

add_action( 'wp_enqueue_scripts', 'pinkstone_enqueue_assets' );
function pinkstone_enqueue_assets() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

include 'includes/podcast-badge.php';

// extract JetPack pageviews
// courtesy of Topher: http://wpgr.org/2013/03/02/rendering-jetpack-stats/
/*
function get_page_views($post_id) {

  if (function_exists('stats_get_csv')) {

    $args = array('days'=>-1, 'limit'=>-1, 'post_id'=>$post_id);
    $result = stats_get_csv('postviews', $args);
    $views = $result[0]['views'];

  } else {

     $views = 0;

    }
  return number_format_i18n($views);
}
*/

/* remove JetPack upsell messages */
/* https://mattreport.com/disable-jetpack-upsell-ads/ */
add_filter( 'jetpack_just_in_time_msgs', '_return_false' );

/* Word Count functions */

function guru_getWordCountFromPosts () {
	
	$count = 0;
	$posts = get_posts( array(
			'numberposts' => -1,
			'post_type' => 'any'
	));
	
	foreach( $posts as $post ) {
		$count += str_word_count( strip_tags( get_post_field( 'post_content', $post->ID )));
	}
	$num =  number_format_i18n( $count );
	
	return $count;
}

function guru_getWordCountCommentsCurrentUser() {
	
	$count = 0;
	$user_id = get_current_user_id();
	$comments = get_comments( array(
			'user_id' => $user_id
	));
	foreach( $comments as $comment ) {
		$count += str_word_count( $comment->comment_content );
	}
	return $count;
}