<?php
		 
	require_once 'dbconfig.php';
	
	if (isset($_REQUEST['id'])) {
			
		$id = intval($_REQUEST['id']);
		$query = "SELECT * FROM nades WHERE id=:id";
		$stmt = $DBcon->prepare( $query );
		$stmt->execute(array(':id'=>$id));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);			
		?>
		  <div class="col col-lg-8 col-md-12 col-sm-12 col-xs-12"><div class="video-container2"><iframe width="853" height="480" src="<?php echo $youtube; ?>" frameborder="0" allowfullscreen /></div></div>
  <div class="row">
  <div class="col col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="thumbnail img-zoomin">
          <img class="img3" src="http://ranksea.com/wp-content/themes/ranksea/nades/screens/de_cache/<?php echo $id; ?>_1.jpg" alt="">
          <div class="caption">
              <p>Spot location</p>
          </div>
      </div>
<div class="row">
  <div class="col col-lg-12 col-md-6 col-sm-12 col-xs-12">
      <div class="thumbnail img-zoomin">
          <img  class="img3" src="<?php echo $image2; ?>" alt="">
          <div class="caption">
              <p>Cross Target</p>
          </div>
      </div>
</div>

  <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="thumbnail img-zoomin">
          <img class="img3" src="<?php echo $image3; ?>" alt="">
          <div class="caption">
              <p>Nade target place</p>
          </div>
      </div>
  </div>


  </div>
</div>
</div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->

<!-- Columns are always 50% wide, on mobile and desktop -->
      </div>
			
			<?php				
	}
	?>