<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ECA_-_Viração
 */

?>

	</div><!-- #content -->

<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 text-right"><h3>MENU</h3></div>
			<div class="col-lg-4 menu">
				<?php wp_nav_menu(); ?>
			</div>
			<div class="col-lg-2"></div>
			<div class="col-lg-2"></div>
			<div class="col-lg-2"></div>
			<div class="col-lg-2"></div>
		</div>
	</div>
</div>


	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'eca-viracao' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'eca-viracao' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'eca-viracao' ), 'eca-viracao', '<a href="http://viniciusofp.com.br/">Vinícius Pereira</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
