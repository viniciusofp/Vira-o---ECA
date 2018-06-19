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
	<div class="menu-row">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-lg-1">
					<h5>MENU</h5>
				</div>
				<div class="col-sm-9 col-lg-11 menu">
					<?php wp_nav_menu(); ?>
				</div>
			</div>
		</div>	
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<?php if ( is_active_sidebar( 'contato-footer' ) ) : ?>
						<?php dynamic_sidebar( 'contato-footer' ); ?>
				<?php endif; ?>
			</div>
			<div class="col-sm-6 col-lg-3">
				<?php if ( is_active_sidebar( 'social-footer' ) ) : ?>
				<ul class="menu" style="padding-left: 0">
						<?php dynamic_sidebar( 'social-footer' ); ?>
				</ul>
				<?php endif; ?>
			</div>
			<div class="col-sm-12 col-lg-6">
				<?php if ( is_active_sidebar( 'creditos-footer' ) ) : ?>
						<?php dynamic_sidebar( 'creditos-footer' ); ?>
				<?php endif; ?>
				<a target="_blank" href="http://viracao.org/"><img src="<?php echo get_template_directory_uri(); ?>/img/viracao-logo.png" alt="" class="mb-3"></a>
			</div>

		</div>
	</div>
</div>
</div><!-- #page -->

		<script>
			if (jQuery('.loggedornot').html()) {
				jQuery('.nav-item:last-child .nav-link').html('Sair').attr('href', jQuery('.logouturl').html())
			} else {
				jQuery('.menu-item-42, .menu-item-37, .menu-item-179').addClass('d-none')
			}
		</script>
<?php wp_footer(); ?>

</body>
</html>
