<?php
// Pinkstone 2013
// Podcast Badge functions
// since @1.5

function versluis2013_add_badge ($content){
	
	$appleBadge = get_stylesheet_directory_uri() . "/images/Apple-Podcasts-Badge.png";
	$stitcherBadge = get_stylesheet_directory_uri() . "/images/Stitcher-Badge.png";
	
	if (in_category ('Podcast')) {
		
		// iOS Dev Diary Podcast
		$apple = "Catch this episode on my iOS Dev Diary Podcast:<br><a href='https://itunes.apple.com/us/podcast/the-ios-dev-diary/id865706315' target='_blank'><img id='apple-badge' src='".$appleBadge . "'></a>";
		
		$stitcher = "<br><a href='https://www.stitcher.com/s?fid=228530&refid=stpr' target='_blank'><img id='stitcher-badge' src='".$stitcherBadge . "'></a>";
		
		$after = $apple . $stitcher;
		
	} else {
		
		// it's not a Podcast
		$after = '';	
	}

	$content = $content . $after;
	return $content;
}
add_filter ('the_content', 'versluis2013_add_badge');

?>