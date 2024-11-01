<?php
/*
Plugin Name: WP Responsive Video
Plugin URI: http://www.brandonorndorff.com/wordpress/plugins/wp-responsive-video-wordpress-plugin/
Description: Simple plugin to allow you to make embedded videos site wide from Youtube and Vimeo responsive without having to change the embed code at all.
Version: 1.0
Author: Brandon Orndorff
Author URI: http://www.brandonorndorff.com
License: GPL2
*/
?>
<?php
function moki_add_responsive_video_support($content) {
?>

<script type="text/javascript">
/* <![CDATA[ */
(function($) {
	// Responsive videos
	var all_videos = $( 'iframe[src^="http://player.vimeo.com"], iframe[src^="http://www.youtube.com"], object, embed' );

	all_videos.each(function() {
		var el = $(this);
		el
			.attr( 'data-aspectRatio', el.height() / el.width() )
			.attr( 'data-oldWidth', el.attr( 'width' ) );
	} );
	
	$(window)
		.resize( function() {
			all_videos.each( function() {
				var el = $(this),
					newWidth = el.parents( 'p' ).width(),
					oldWidth = el.attr( 'data-oldWidth' );
	
				if ( oldWidth > newWidth ) {
					el
						.removeAttr( 'height' )
						.removeAttr( 'width' )
						.width( newWidth )
				    		.height( newWidth * el.attr( 'data-aspectRatio' ) );
				}
			} );
		} )
		.resize();
})(jQuery);
/* ]]> */
</script>

<?php
} //end function
add_action('wp_footer', 'moki_add_responsive_video_support');
?>