<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Venus Template 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("footer-widget-area") ) : ?>
	<?php endif; ?>
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
