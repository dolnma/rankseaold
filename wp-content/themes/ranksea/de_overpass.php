<?php /* Template Name: de_overpass */ ?>
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
<head>
<link href='http://fonts.googleapis.com/css?family=Raleway:800,400' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- <link async="async" data-turbolinks-track="true" href="/wp-content/themes/ranksea/nades/assets/application7e76.css?body=1" media="all" rel="stylesheet" /> !-->
<link async="async" data-turbolinks-track="true" href="/wp-content/themes/ranksea/nades/style.css" media="all" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<script type="text/javascript">

	console.log("testtttttt");

document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById("smoke").addEventListener("click",function(){
	nadesCount("smoke");showSmoke();hideFire();hideFlash();nadenumbers_smoke();hideCT();
	});

	document.getElementById("fire").addEventListener("click",function(){
	nadesCount("fire");showFire();hideSmoke();hideFlash();nadenumbers_fire();
	});

	document.getElementById("flash").addEventListener("click",function(){
	nadesCount("flash");showFlash();hideSmoke();hideFire();nadenumbers_flash();
	});

	document.getElementById("callouts").addEventListener("click",function(){
	toggle();
	});
});

function nadenumbers_smoke() {
var length = document.getElementsByClassName("smoke_text").length;
for (var i = 0;i < length;i++) {
document.getElementsByClassName("smoke_text")[i].textContent = i+1;
}
	}
	function nadenumbers_fire() {
var length = document.getElementsByClassName("fire_text").length;
for (var i = 0;i < length;i++) {
document.getElementsByClassName("fire_text")[i].textContent = i+1;
	}
	}
function nadenumbers_flash() {
var length = document.getElementsByClassName("flash_text").length;
for (var i = 0;i < length;i++) {
document.getElementsByClassName("flash_text")[i].textContent = i+1;
	}
	}

  function callouts_on() {
    document.getElementById("map_image").setAttribute('href', "/wp-content/themes/ranksea/nades/assets/maps/de_overpass_callouts.png");
  }
  function callouts_off() {
    document.getElementById("map_image").setAttribute('href', "/wp-content/themes/ranksea/nades/assets/maps/de_overpass.png");
  }

	 function nadesCount(type) {
    var countofnades = document.getElementsByName(type).length;	
     
//     alert("tryed to count nades bitch" + type);
	document.getElementById("nadescount").innerHTML = countofnades;
    }
function showSmoke() {
	hideFlash();
	hideFire();
    var s = document.getElementsByName("smoke");
    var i;
	if (typeof(Storage) !== "undefined") {
   					 // Store
   						 localStorage.setItem("smokemap", "smoke");
					}

    for (i = 0; i < s.length; i++) {
    s[i].style.display = 'block';
    s[i].setAttribute("visibility", "visible");
    }
    $(s).show();
}

function hideSmoke() {
    var s = document.getElementsByName("smoke");
    var i;
    for (i = 0; i < s.length; i++) {
    s[i].style.display = "none";
    s[i].setAttribute("visibility", "hidden");
    }
    $(s).hide();
}

function showFlash() {
	hideSmoke();
	hideFire();
    var f = document.getElementsByName("flash");
    var i;
    	if (typeof(Storage) !== "undefined") {
   					 // Store
   						 localStorage.setItem("smokemap", "flash");
					}
    for (i = 0; i < f.length; i++) {
    f[i].style.display = 'block';
    f[i].setAttribute("visibility", "visible");
    }
    $("f").show();
}

function hideFlash() {
    var f = document.getElementsByName("flash");
    var i;
    for (i = 0; i < f.length; i++) {
    f[i].style.display = "none";
    f[i].setAttribute("visibility", "hidden");
    }
}

function showFire() {
	hideSmoke();
	hideFlash();
    var m = document.getElementsByName("fire");
    var i;
    	if (typeof(Storage) !== "undefined") {
   					 // Store
   						 localStorage.setItem("smokemap", "fire");
					}
    for (i = 0; i < m.length; i++) {
    m[i].style.display = 'block';
    m[i].setAttribute("visibility", "visible");
    }
}

function hideFire() {
    var m = document.getElementsByName("fire");
    var i;
    for (i = 0; i < m.length; i++) {
    m[i].style.display = "none";
    m[i].setAttribute("visibility", "hidden");
    }
}

//	var s = Snap("#map");
 //   var c = s.image("/nades/assets/maps/de_cache.png", 0, 0, 1100, 834);


</script>


<style type="text/css">
	.popup_help {
    overflow: hidden;
    position: fixed; /* Set the navbar to fixed position */
    bottom: 2%;
    left:2%; /* Position the navbar at the top of the page */
    z-index:99999;
	background-color:#00bbff;
	-moz-border-radius:20px;
	-webkit-border-radius:20px;
	border-radius:20px;
	border:1px solid #0081a1;
	color:#ffffff;
	font-family:"Raleway";
	font-size:52px;
	padding:22px 20px;
	text-decoration:none;
	text-shadow:0px 1px 0px #2f6627;
	opacity: 0.9;
	text-transform: uppercase;
}
.popup_help:hover {
	background-color:#29dfff;
}
@media only screen and (max-width: 768px) {
	.popup_help {
    overflow: hidden;
    position: fixed; /* Set the navbar to fixed position */
    bottom: 1%;
    left:2%; /* Position the navbar at the top of the page */
    z-index:99999;
	background-color:#00bbff;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	border:1px solid #0081a1;
	color:#ffffff;
	font-family:"Raleway";
	font-size:24px;
	padding:5px 16px;
	text-decoration:none;
	text-shadow:0px 1px 0px #2f6627;
}
}
</style>
<body data-no-turbolink class="cbp-spmenu-push">
	<div class = "mainContainer bg-3">

	<!-- Flickity HTML init -->
<div class="carousel js-flickity" data-flickity='{ "pageDots": false }'>
  <!-- images from unsplash.com -->
  <div class="carousel-cell">
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
  <div class="carousel-cell">
<div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_dust2.png"></div>
  </div>
  <div class="carousel-cell">
      <div class="img_map_gray"><img src="http://ranksea.com/wp-content/themes/ranksea/nades/assets/map_icon/de_inferno.png"></div>
  </div>
  </div>

<style type="text/css">
.bigContainer { width: 1170px !important; }
.nade_white{stroke:#FFFFFF;fill:#FFFFFF;stroke-miterlimit:10;stroke-width:0;}
.nade_ct{stroke:#9FBDD5;fill:#9FBDD5;stroke-miterlimit:10;stroke-width:0;opacity:0.7;}
.nade_ct:hover{stroke:#8FBDD5;fill:#8FBDD5;stroke-miterlimit:10;stroke-width:0;opacity:1;}
.nade_t{stroke:#E0C365;fill:#E0C365;stroke-miterlimit:10;stroke-width:0;opacity:0.7;padding:10px 10px 10px 10px;}
.nade_t:hover{stroke:#E0C365;fill:#E0C365;stroke-miterlimit:10;stroke-width:0;opacity:1;}
.nade_black{fill:#000000;stroke:#000000;stroke-miterlimit:10;}
.line_dot{stroke:#E0C365;fill:#E0C365;stroke-width:3}
.line_dot2{stroke:#9FBDD5;fill:#9FBDD5;stroke-width:3}
.line_dot:hover{stroke:#ffff00;fill:#ffff00 dotted;stroke-width:3}
.nade_gray{fill:#CDCDCD;}
.grenade {
	display:block;
	pointer-events:all;
	cursor:pointer;
	transition:.5s;
}
.js_grenade_hover{
	cursor:pointer;
	stroke:#ffff00;
	fill:#ffff00;
}
.red{
	color:red;
}
</style>

<!--
<div class="panel panel-default" style="width:auto;max-height:90vh;overflow-y:auto;overflow-x:hidden;position:fixed;margin-bottom:0px;bottom:0px;right:0px;z-index:11;width:250px;">
	<div class="panel-heading noMargin noPad">
		<span id = "hideNadeList" class="expander glyphicon glyphicon-chevron-down" ></span>
	</div>

	<div id = "grenadeList" class="panel-body panelback">
	            		<?php
            		
            		require_once 'popup/dbconfig.php';
            		
            		$query = "SELECT * FROM nades_de_overpass";
            		$stmt = $DBcon->prepare( $query );
            		$stmt->execute();
            		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						?>
			<div class = "row">
				<div class = "col-xs-4" style="font-size:12px;padding-right:0;">
				</div>
					<div class = "col-xs-12">
					<a id = "lg<?php echo $row['id'] ?>" data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['id']; ?>" id="getId" class="grenadeLink" style="white-space: nowrap;">
						<?php echo $row['title'] ?>
					</a>
				</div>
			</div>
						<?php
					}
            		?>
	</div> 
</div>
-->
<script type="text/javascript">
function toggle(callouts)
{
  if(document.getElementById("callouts").value=="OFF"){
   document.getElementById("callouts").value="ON";
document.getElementById("callouts").setAttribute("class", "callouts")
callouts_on();
}

  else if(document.getElementById("callouts").value=="ON"){
  document.getElementById("callouts").value="OFF";
document.getElementById("callouts").setAttribute("class", "callouts2")
callouts_off();
}
}
</script>
<div class="content-map" style="text-align:center">
        <button id="smoke"  class="btn-map">
          <span class="glyphicon glyphicon-cloud"></span> Smoke 
        </button>
         <button id="fire" class="btn-map">
          <span class="glyphicon glyphicon-fire"></span> Fire
        </button>
        <button id="flash" class="btn-map">
          <span class="glyphicon glyphicon-eye-close"></span> Flash
        </button>
	<button id="callouts" value="OFF" class="callouts2">
CALLOUTS
        </button>       
<!-- MAP (App Section) START -->
<div id="i">
        <div class="ads_right_side">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- ranksea_right_side -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3120726946262022"
     data-ad-slot="2761071899"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
        <div class="ads_bottom">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- ranksea_right_side -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3120726946262022"
     data-ad-slot="2761071899"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
		<svg id = "map" viewBox="0 0 1123 1024" style="cursor:default">
			<image id="map_image" style="pointer-events:none" height="1024" width="1024" y="0" x="0" class="map-image2" preserveAspectRatio="none" href="/wp-content/themes/ranksea/nades/assets/maps/de_overpass.png"></image>
            	<?php
            		
            		require_once 'popup/dbconfig.php';
            		
            		$query = "SELECT n.id, n.mode, n.title, n.side, n.line_x1, n.line_y1, n.line_x2, n.line_y2, n.type, n.middle_positions, no.name AS name, no.value AS value FROM nades_de_overpass n JOIN nades_options no ON no.id = n.mode";
            		$stmt = $DBcon->prepare( $query );
            		$stmt->execute();
            		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            			$translate_x = $row['line_x2']-20;
            			$translate_y = $row['line_y2']-29;
						?>
					<?php if( $row['side'] == 1 ) {  ?>
									<g id="g<?php echo $row['id']; ?>" name="<?php echo $row['name'] ?>" class="grenade terorrist" <?php if ($row['name'] == "smoke"){ echo "style=\"opacity:1; pointer-events:all;display:block;\"";}else{echo "style=\"opacity:1; pointer-events:all;display:none;\"";}?>>
					<a class="grenadeLink" data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['id']; ?>" id="getId" data-tooltip="{ 'offset': 20, 'class': 'alt-tooltip-t' }" title="<?php echo $row['title'] ?>">
						<circle cx="<?php echo $row['line_x1'] ?>" cy="<?php echo $row['line_y1'] ?>" r="5" class="line_dot"/>
						<polyline points="<?php echo $row['line_x1'] ?>,<?php echo $row['line_y1'] ?> <?php echo $row['middle_positions'] ?> <?php echo $row['line_x2'] ?>,<?php echo $row['line_y2'] ?>" class="line_dot" style="fill:none;"></polyline>

							<g transform="translate(<?php echo $translate_x; ?>,<?php echo $translate_y; ?>) scale(.1)">
<path d="<?php echo $row['value']; ?>" class="nade_t"/>
							<?php } else { ?>
											<g id="g<?php echo $row['id']; ?>" name="<?php echo $row['name'] ?>" class="grenade counter-terorrist" <?php if ($row['name'] == "smoke"){ echo "style=\"opacity:1; pointer-events:all;display:block;\"";}else{echo "style=\"opacity:1; pointer-events:all;display:none;\"";}?>>
						<a data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['id']; ?>" id="getId" class="grenadeLink" data-tooltip="{ 'offset': 20, 'class': 'alt-tooltip-ct' }" title="<?php echo $row['title'] ?>" class="cursor">
						<circle cx="<?php echo $row['line_x1'] ?>" cy="<?php echo $row['line_y1'] ?>" r="5" class="line_dot2"/>
						<polyline points="<?php echo $row['line_x1'] ?>,<?php echo $row['line_y1'] ?> <?php echo $row['middle_positions'] ?> <?php echo $row['line_x2'] ?>,<?php echo $row['line_y2'] ?>" class="line_dot2" style="fill:none;"></polyline>

							<g transform="translate(<?php echo $translate_x; ?>,<?php echo $translate_y; ?>) scale(.1)">
<path d="<?php echo $row['value']; ?>" class="nade_ct"/>
							<?php } ?>
		<?php if( $row['mode'] == 1 ) {  ?>					
<text class="smoke_text" x="200" y="300" style="font-family:'Montserrat', sans-serif;font-size:122.154px;"></text>	
<?php } elseif ( $row['mode'] == 2 ) { ?>
<text class="fire_text" x="200" y="370" style="font-family:'Montserrat', sans-serif;font-size:122.154px;"></text>	
<?php } else { ?>
<text class="flash_text" x="200" y="300" style="font-family:'Montserrat', sans-serif;font-size:122.154px;"></text>	
<?php } ?>
							</g>
					</a>
				</g>
				<?php } ?>
		</svg>
		</div>
		
		<script src="/wp-content/themes/ranksea/nades/assets/grenademaps/magnific.js"></script>
		<link href="/wp-content/themes/ranksea/nades/assets/magnific7e76.css?body=1" media="screen" rel="stylesheet" />
	<script src="/wp-content/themes/ranksea/nades/assets/grenademaps/nademap.js"></script>
		<script>
		</script>
</div>
	</div>

<div class="bg-8 col-md-12 text-center"><div class="row"><h2>Some important or cool spot is missing? Feel free to post it into our <a href="http://ranksea.com/forums/forum/nade-spots-topic/">Forums</a>!</h2></div></div>

	<!-- Modal fullscreen -->
<div class="modal modal-fullscreen fade col-xs-12" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div id="dynamic-content2"></div>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="popup_close btn-circle_close btn-xl" data-dismiss="modal"><span class="close_mobile" aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                             <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="/wp-content/themes/ranksea/popup/ajax-loader.gif">
                       	   </div>
                            
                           <!-- content will be load here -->                          
                           <div id="dynamic-content"></div>

      </div>
    </div>
  </div>
</div>
 </div>
<!-- Modal fullscreen END--> 
<script type="text/javascript" src="/wp-content/themes/ranksea/js/nadesCount.js"></script>
<script type="text/javascript">

//    var s = Snap("#map");
//    var c = s.image("/wp-content/themes/ranksea/nades/assets/maps/de_cache.png", 0, 0, 1100, 834);
showSmoke();
nadenumbers_smoke();
</script>
</body>
</html>
<script src="/wp-content/themes/ranksea/js/Tooltip.js" type="text/javascript"></script>
<script src="/wp-content/themes/ranksea/js/popup_de_overpass.js" type="text/javascript"></script>
<?php
get_footer();
