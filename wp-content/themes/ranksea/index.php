<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */
get_header(); ?>

	<div id="content" class="main-container">

  <style type="text/css">
    .slider {
        width: 60%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 10%;
    }
    .slider img {
      width: 150px;
      height: 150px;
    }
    .slick-prev:before,
    .slick-next:before {
        color: black;
    }
  </style>
<script type="text/javascript">
$(window).scroll(function() {
  $(".slideanim").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide");
    }
  });
});
</script>
    <!--Video Section-->
<div class="video-container">
       <video autoplay loop muted>
             <source src="https://thv1.uloz.to/9/4/a/94a7acd1701a94c86d74b0d31b6800ad.720.mp4?fileId=161602869" type="video/mp4">
             Your browser does not support the video tag.
       </video>
<div class="overlay-desc2">
TRAINING NADE SPOTS
    </div>

         <div class="overlay-desc">
  <!-- Flickity HTML init -->
<div class="carousel2 js-flickity" data-flickity='{ "pageDots": false }'>
  <!-- images from unsplash.com -->
  <div class="carousel-cell2">
    <a href="de_cache"><img class="responsive" src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_cache.png"></a>
  </div>
      <div class="carousel-cell">
      <a href="de_mirage"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_mirage.png"></a>
  </div>
        <div class="carousel-cell">
      <a href="de_cobblestone"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_cbble.png"></a>
  </div>
        <div class="carousel-cell">
      <a href="de_overpass"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_overpass.png"></a>
  </div>
  <div class="carousel-cell2">
<div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_dust2.png"></div>
  </div>
  <div class="carousel-cell2">
      <div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_inferno.png"></div>
  </div>
  </div>
    </div>

     </div>
     <div class="mobile-slider col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <!-- Flickity HTML init -->
<div class="carousel js-flickity" data-flickity='{ "pageDots": false }'>
  <!-- images from unsplash.com -->
  <div class="carousel-cell col-sm-1">
    <a href="de_cache"><img class="responsive" src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_cache.png"></a>
  </div>
    <div class="carousel-cell col-sm-1">
<a href="de_mirage"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_mirage.png"></a>
  </div>
      <div class="carousel-cell col-sm-1">
<a href="de_cobblestone"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_cobblestone.png"></a>
  </div>
      <div class="carousel-cell col-sm-1">
<a href="de_overpass"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_overpass.png"></a>
  </div>
  <div class="carousel-cell col-sm-1">
<div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_dust2.png"></div>
  </div>
  <div class="carousel-cell col-sm-1">
      <div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_inferno.png"></div>
  </div>
</div>
  </div>
<!--Video Section Ends Here-->
<div id="news">
<div class="text-center container-main about bg-3 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<div class="row">
    <h3>Last News</h3>
  <hr class="style2 col-xs-12">
  </div>
  <div class="row">
  <div class="news-panel">
		<?php
		if ( $layout_class == 'sidebar-left' ):
			get_sidebar();
		endif;
		?>
		<div id="primary" class="col-md-12 mb-xs-12 <?php echo esc_attr( $layout_class ); ?>"><?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php esc_html( single_post_title() ); ?></h1>
					</header>

					<?php
				endif;

				$layout_type = get_theme_mod( 'blog_layout_view', 'grid' );

				get_template_part( 'template-parts/layouts/blog', $layout_type );

				if ( function_exists( "shapely_pagination" ) ):
					shapely_pagination();
				endif;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		</div><!-- #primary -->
		<?php
		if ( $layout_class == 'sidebar-right' ):
			get_sidebar();
		endif;
		?>
	</div></div>
	</div>
	</div>

  <!-- Container (The Band Section) -->
<div id="about" class="text-center container-main about bg-1 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <h3>Road to Global with us!</h3>
  <hr class="style2 col-xs-12">
  <p><em>We will help you with getting new skills and gaming sense!</em></p>
  <p>Are you still stock on Silver or Gold Nova? This site could be a solution for your troubles. We are introducing new ways how to make sharp your gameplay and teach a key factors during matches. </p>
  <br>
  <div class="row">
    <div class="col-sm-4 slideanim">
      <p class="text-center"><h3>Train your aim!</h3></p><br>
      <div class="bg1-icons">
        <img src="wp-content/themes/ranksea/assets/images/homepage1.png" class="img-responsive">
        </div>
    </div>
    <div class="col-sm-4 slideanim">
      <p class="text-center"><h3>Practice nades on maps!</h3></p><br>
              <div class="bg1-icons">
        <img src="wp-content/themes/ranksea/assets/images/homepage2.png" class="img-responsive">
        </div>
    </div>
    <div class="col-sm-4 slideanim">
      <p class="text-center"><h3>Boost your rank!</h3></p><br>
         <div class="bg1-icons">
        <img src="wp-content/themes/ranksea/assets/images/homepage4.png" class="img-responsive">
        </div>
    </div>
  </div>
</div>
    <!-- Container (The Band Section) -->
<div id="about" class="container-main about bg-9 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="slideanim">
  </div>
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2 slideanim">
        <img src="wp-content/themes/ranksea/assets/images/content_1.png" class="img-responsive">
    </div>
        <div class="col-sm-6 slideanim">
        <ul>
  <li>Support Computer, Mobile or Tablet</li>
  <li>Clear overview about all spots on maps</li>
  <li>Compatible with Steam browser through ingame overlay</li>
</ul>
        </div>
    </div>
  </div>
    <!-- Container (The Band Section) -->
<div id="about" class="text-center container-main about bg-2 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <h3 class="slideanim">A lot of training stuff incoming!</h3>
  <hr class="style2 col-xs-12">
  <div class="row">
    <div class="col-sm-6">
      <p class="text-center"><h3>Aim training</h3></p><br>
      <div class="bg1-icons">
        <i class="fa fa-crosshairs" aria-hidden="true"></i>
        </div>
    </div>
    <div class="col-sm-6 newsletter">
     <span>Dedicated servers with support</span>
    </div>
  </div>
</div>
<!-- Container (Contact Section) -->
<div id="contact" class="text-center container-main contact bg-7 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                <h2>Contact</h2>
                                </div>
                                 <div class="col-12">
                                <hr class="style2 col-xs-12">
                                </div>
                            </div>
                    <form id="contact-form" method="post" action="wp-content/themes/ranksea/contact.php" role="form">

                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea id="form_message" name="message" class="form-control" placeholder="Message for us *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <!-- Replace data-sitekey with your own one, generated at https://www.google.com/recaptcha/admin -->
                                        <div class="g-recaptcha" data-sitekey="6LcCyyMUAAAAAJo2e7QgbvKihoYMovijXok98n2z"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success btn-send" value="Send message">
                                </div>
                            </div>
                        </div>

                    </form>
    </div>

  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: false,
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".variable").slick({
        dots: false,
        infinite: false,
        variableWidth: true
      });
    });
  </script>
  <script type="text/javascript">
    
$('.center').slick({
  centerMode: true,
  centerPadding: '60px',
  pageDots: false,
  slidesToShow: 3,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
  </script>
<?php
get_footer();
