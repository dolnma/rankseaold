<?php
		 
	require_once 'dbconfig.php';
	
	if (isset($_REQUEST['id'])) {
		
		$id = intval($_REQUEST['id']);
		$query = "SELECT * FROM nades_de_cobblestone WHERE id=:id";
		$stmt = $DBcon->prepare( $query );
		$stmt->execute(array(':id'=>$id));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);			
		?>
      <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="row">
  <div class="col col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="popup_item img-zoomin">
          <img class="img3" src="/wp-content/themes/ranksea/nades/screens/de_cobblestone/<?php echo $image1; ?>" alt="">
          <div class="caption">
              <p>Spot location</p>
          </div>
      </div></div>
    <div class="col col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="popup_item img-zoomin">
          <img  class="img3" src="/wp-content/themes/ranksea/nades/screens/de_cobblestone/<?php echo $image2; ?>" alt="">
          <div class="caption">
              <p>Cross Target</p>
          </div>
      </div>
      </div>
      </div>
<div class="row">
        <div class="col col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="popup_item img-zoomin">
          <img class="img3" src="/wp-content/themes/ranksea/nades/screens/de_cobblestone/<?php echo $image3; ?>" alt="">
          <div class="caption">
              <p>Nade target place</p>
          </div>
      </div>
  </div>
      <div class="col col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <?php if (empty($youtube)) { ?>
      <div class="text-center video_missing">Video isnt available. We are working on it!</div>
      <?php } else { ?>
      <div class="popup_item video-container2"><iframe src="<?php echo $youtube; ?>" frameborder="0" allowfullscreen /></div>
      <?php } ?>
      </div>

  </div>
    </div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->

<!-- Columns are always 50% wide, on mobile and desktop -->
			
			<?php				
	}
	?>