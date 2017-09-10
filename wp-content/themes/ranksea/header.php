<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shapely
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="/wp-content/themes/ranksea/inc/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/ranksea/inc/slick/slick-theme.css"/>
<script type="text/javascript" src="/wp-content/themes/ranksea/inc/slick/slick.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <script src="/wp-content/themes/ranksea/validator.js"></script>
        <script src="/wp-content/themes/ranksea/contact.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="/wp-content/themes/ranksea/inc/slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <link rel="stylesheet" type="text/css" href="/wp-content/themes/ranksea/style.css"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<!-- Google Analaytics -->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102750647-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Google Analaytics -->
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

   // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
      });
    } // End if
  });
})
</script>
<!-- Map aplication start -->

<!-- Map aplication end -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <row>
      <a class="navbar-brand" href="http://ranksea.com"><img class="header_logo" src="http://ranksea.com/wp-content/themes/ranksea/assets/images/logo.png"></a>
          <div class="header_icons navbar-icons">
<a href="https://www.facebook.com/RankSea-159574507918464" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
<a href="https://twitter.com/RankSeaCOM" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></i></a>
<a href="http://steamcommunity.com/groups/ranksea" target="_blank"><i class="fa fa-steam" aria-hidden="true"></i></a>
<a href="https://www.instagram.com/ranksea/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://ranksea.com">HOME</a></li>
        <li><a href="http://ranksea.com/#news">NEWS</a></li>
        <li><a href="http://ranksea.com/forums">FORUMS</a></li>
        <li><a href="http://ranksea.com/#about">ABOUT US</a></li>
        <li><a href="http://ranksea.com/#contact">CONTACT</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">MAPS
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/de_cache">de_Cache</a></li> 
            <li><a href="/de_mirage">de_Mirage</a></li> 
            <li><a href="/de_cobblestone">de_Cobblestone</a></li> 
            <li><a href="/de_overpass">de_Overpass</a></li> 
          </ul>
        </li>
         <li>
   <?php wpsap_button_login(); ?>
								 <?php wpsap_button_sync(); ?>
								 <?php if ( is_user_logged_in() ) {
									$user_id = get_current_user_id(); 
									  $steam_avatar = get_user_meta($user_id, 'steam_avatar', true);
									  $steam_nick = get_user_meta($user_id, 'personaname', true);
  										?>
  										</li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown">
     <img class="img-circle" src="<?php echo $steam_avatar; ?>" alt="icon"></a>
          <ul class="dropdown-menu">
           <li><a href="http://ranksea.com/support-us/">Support us!</a></li>
            <li><?php echo '<a href="'.wpsap_button_logout_url().'">Logout</a>'; ?></li>
          </ul>
        </li>
        	<?php } ?>
      </ul>
    </div>
  </div>
</nav>
