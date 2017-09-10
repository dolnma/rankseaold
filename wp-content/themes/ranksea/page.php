<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */

get_header(); ?>
	<div id="content" class="main-container">
<div class="carousel js-flickity" data-flickity='{ "pageDots": false }'>
  <!-- images from unsplash.com -->
  <div class="carousel-cell">
    <a href="main-page"><img class="responsive" src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_cache.png"></a>
  </div>
  <div class="carousel-cell">
<div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_dust2.png"></div>
  </div>
  <div class="carousel-cell">
      <div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_inferno.png"></div>
  </div>
  <div class="carousel-cell">
      <div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_mirage.png"></div>
  </div>
  <div class="carousel-cell">
      <div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_overpass.png"></div>
  </div>
  <div class="carousel-cell">
     <div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_cbble.png"></div>
  </div>
  </div>

		<section class="content-area <?php echo ( get_theme_mod( 'top_callout', true ) ) ? '' : ' pt0 ' ?>">
			<div id="main" class="<?php echo ( ! is_page_template( 'template-home.php' ) ) ? 'container' : ''; ?>"
			     role="main">
<?php $layout_class = ( function_exists( 'shapely_get_layout_class' ) ) ? shapely_get_layout_class() : ''; ?>
	<div class="row">
		<?php
		if ( $layout_class == 'sidebar-left' ):
			get_sidebar();
		endif;
		?>
		<div id="primary" class="col-md-12 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>"><?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop. ?>
		</div><!-- #primary -->
		<?php
		if ( $layout_class == 'sidebar-right' ):
			get_sidebar();
		endif;
		?>
	</div>
<?php
get_footer();
