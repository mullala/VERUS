<?php
/**
 * venus functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, venus_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'venus_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Venus
 * @since Venus Template 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run venus_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'venus_setup' );

if ( ! function_exists( 'venus_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override venus_setup() in a child theme, add your own venus_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Venus Template 1.0
 */
function venus_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'venus', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'venus' ),
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background' );

	// The custom header business starts here.

	add_theme_support( 'custom-header', array(
		// The default image to use.
		// The %s is a placeholder for the theme template directory URI.
		'default-image' => '%s/images/headers/path.jpg',
		// The height and width of our custom header.
		'width' => apply_filters( 'venus_header_image_width', 940 ),
		'height' => apply_filters( 'venus_header_image_height', 198 ),
		// Support flexible heights.
		'flex-height' => true,
		// Don't support text inside the header image.
		'header-text' => false,
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'venus_admin_header_style',
	) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( get_theme_support( 'custom-header', 'width' ), get_theme_support( 'custom-header', 'height' ), true );

	// ... and thus ends the custom header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'venus' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'venus' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'venus' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'venus' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'venus' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'venus' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'venus' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'venus' )
		)
	) );
}
endif;

if ( ! function_exists( 'venus_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in venus_setup().
 *
 * @since Venus Template 1.0
 */
function venus_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If header-text was supported, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Venus Template 1.0
 */
function venus_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'venus_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Venus Template 1.0
 * @return int
 */
function venus_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'venus_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Venus Template 1.0
 * @return string "Continue Reading" link
 */
function venus_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'venus' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and venus_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Venus Template 1.0
 * @return string An ellipsis
 */
function venus_auto_excerpt_more( $more ) {
	return ' &hellip;' . venus_continue_reading_link();
}
add_filter( 'excerpt_more', 'venus_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Venus Template 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function venus_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= venus_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'venus_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Venus Template's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Venus Template 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Venus Template 1.0
 * @deprecated Deprecated in Venus Template 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function venus_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'venus_remove_gallery_css' );

if ( ! function_exists( 'venus_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own venus_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Venus Template 1.0
 */
function venus_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'venus' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'venus' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'venus' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'venus' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'venus' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'venus' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override venus_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Venus Template 1.0
 * @uses register_sidebar
 */
function venus_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'venus' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'venus' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'venus' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'venus' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Social Networks Widget Area', 'venus' ),
		'id' => 'social-widget-area',
		'description' => __( 'The social widget area', 'venus' ),
		'before_widget' => '<div id="%1$s" class="widget-social %2$s">',
		'after_widget' => '</div>',
	) );
	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'venus' ),
		'id' => 'footer-widget-area',
		'description' => __( 'The footer widget area', 'venus' ),
		'before_widget' => '<div id="%1$s" class="widget-copyright %2$s">',
		'after_widget' => '</div>',
	) );


}
/** Register sidebars by running venus_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'venus_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Venus Template 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Venus Template styling.
 *
 * @since Venus Template 1.0
 */
function venus_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'venus_remove_recent_comments_style' );

if ( ! function_exists( 'venus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Venus Template 1.0
 */
function venus_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'venus' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'venus' ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'venus_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Venus Template 1.0
 */
function venus_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'venus' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'venus' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'venus' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

?>
<?php
// =============================== My Social Networks Widget ====================================== //
class My_SocialNetworksWidget extends WP_Widget {

	function My_SocialNetworksWidget() {
		$widget_ops = array('classname' => 'social_networks_widget', 'description' => __('Link to your social networks.'));
		$this->WP_Widget('social_networks', __('My - Social Networks'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$networks['Twitter']['link'] = $instance['twitter'];
		$networks['Facebook']['link'] = $instance['facebook'];
		$networks['Google']['link'] = $instance['google'];
		$networks['Feed']['link'] = $instance['feed'];
		$networks['Linkedin']['link'] = $instance['linkedin'];
		$networks['Delicious']['link'] = $instance['delicious'];
		$networks['Youtube']['link'] = $instance['youtube'];
		
		$networks['Twitter']['label'] = $instance['twitter_label'];
		$networks['Facebook']['label'] = $instance['facebook_label'];
		$networks['Google']['label'] = $instance['google_label'];
		$networks['Feed']['label'] = $instance['feed_label'];
		$networks['Linkedin']['label'] = $instance['linkedin_label'];
		$networks['Delicious']['label'] = $instance['delicious_label'];
		$networks['Youtube']['label'] = $instance['youtube_label'];

		$display = $instance['display'];
		

		echo $before_widget;
		if ( $title )
    		echo $before_title . $title . $after_title;
		?>
		
			<ul class="social-networks">
				
					<?php foreach(array("Facebook", "Twitter", "Google", "Feed", "Linkedin", "Delicious", "Youtube") as $network) : ?>
			    		<?php if (!empty($networks[$network]['link'])) : ?>
						<li>
							<a rel="external" title="<?php echo strtolower($network); ?>" href="<?php echo $networks[$network]['link']; ?>">
						    		<?php if (($display == "both") or ($display =="icons")) { ?>
									<img src="<?php bloginfo( 'template_url' ); ?>/images/icons/<?php echo strtolower($network);?>.png" alt="">
								<?php } if (($display == "labels") or ($display == "both")) { ?> 
									<?php if (($networks[$network]['label'])!=="") { echo $networks[$network]['label']; } else { echo $network; } ?>
								<?php } ?>
							</a>
						</li>
					<?php endif; ?>
					<?php endforeach; ?>
			      
      		</ul>
      
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['google'] = $new_instance['google'];
		$instance['feed'] = $new_instance['feed'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['delicious'] = $new_instance['delicious'];
		$instance['youtube'] = $new_instance['youtube'];
		
		$instance['twitter_label'] = $new_instance['twitter_label'];
		$instance['facebook_label'] = $new_instance['facebook_label'];
		$instance['google_label'] = $new_instance['google_label'];
		$instance['feed_label'] = $new_instance['feed_label'];
		$instance['linkedin_label'] = $new_instance['linkedin_label'];
		$instance['delicious_label'] = $new_instance['delicious_label'];
		$instance['youtube_label'] = $new_instance['youtube_label'];

		$instance['display'] = $new_instance['display'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
			
		$twitter = $instance['twitter'];		
		$facebook = $instance['facebook'];
		$google = $instance['google'];		
		$feed = $instance['feed'];
		$linkedin = $instance['linkedin'];	
		$delicious = $instance['delicious'];
		$youtube = $instance['youtube'];
		
		$twitter_label = $instance['twitter_label'];
		$facebook_label = $instance['facebook_label'];
		$google_label = $instance['google_label'];
		$feed_label = $instance['feed_label'];
		$linkedin_label = $instance['linkedin_label'];
		$delicious_label = $instance['delicious_label'];
		$youtube_label = $instance['youtube_label'];

		$display = $instance['display'];		


		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
    
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Facebook'); ?>:</legend>
			
			<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>
			
			<p><label for="<?php echo $this->get_field_id('facebook_label'); ?>"><?php _e('Facebook label:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook_label'); ?>" name="<?php echo $this->get_field_name('facebook_label'); ?>" type="text" value="<?php echo esc_attr($facebook_label); ?>" /></p>
		</fieldset>	
		
        <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Twitter'); ?>:</legend>	
		<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('twitter_label'); ?>"><?php _e('Twitter label:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" name="<?php echo $this->get_field_name('twitter_label'); ?>" type="text" value="<?php echo esc_attr($twitter_label); ?>" /></p>
        </fieldset>	
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Linkedin'); ?>:</legend>	
		<p><label for="<?php echo $this->get_field_id('Linkedin'); ?>"><?php _e('Linkedin URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('linkedin_label'); ?>"><?php _e('Linkedin label:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin_label'); ?>" name="<?php echo $this->get_field_name('linkedin_label'); ?>" type="text" value="<?php echo esc_attr($linkedin_label); ?>" /></p>
        </fieldset>	
		<!--
        <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Google'); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('Google URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo esc_attr($google); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('google_label'); ?>"><?php _e('Google label:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google_label'); ?>" name="<?php echo $this->get_field_name('google_label'); ?>" type="text" value="<?php echo esc_attr($google_label); ?>" /></p>
        </fieldset>	
		-->
		<!--
        <fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('RSS feed'); ?>:</legend>
		<p><label for="<?php echo $this->get_field_id('feed'); ?>"><?php _e('RSS feed:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feed'); ?>" name="<?php echo $this->get_field_name('feed'); ?>" type="text" value="<?php echo esc_attr($feed); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('feed_label'); ?>"><?php _e('RSS label:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('feed_label'); ?>" name="<?php echo $this->get_field_name('feed_label'); ?>" type="text" value="<?php echo esc_attr($feed_label); ?>" /></p>
        </fieldset>	
    -->

		<p>Display:</p>
		<label for="<?php echo $this->get_field_id('icons'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="icons" id="<?php echo $this->get_field_id('icons'); ?>" <?php checked($display, "icons"); ?>></input>  Icons</label>
		<label for="<?php echo $this->get_field_id('labels'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="labels" id="<?php echo $this->get_field_id('labels'); ?>" <?php checked($display, "labels"); ?>></input> Labels</label>
		<label for="<?php echo $this->get_field_id('both'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="both" id="<?php echo $this->get_field_id('both'); ?>" <?php checked($display, "both"); ?>></input> Both</label>

    
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("My_SocialNetworksWidget");'));




