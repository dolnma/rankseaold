<?php
		 
	require_once 'dbconfig.php';
	
	if (isset($_REQUEST['id'])) {
			
		$id = intval($_REQUEST['id']);
		$query = "SELECT n.id, nt.name AS name FROM nades n JOIN nades_type nt ON nt.id = n.help WHERE n.id=:id";
		$stmt = $DBcon->prepare( $query );
		$stmt->execute(array(':id'=>$id));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		?>
		<div class="popup_help">
<?php echo $row['name']; ?>
  </div>
			<?php				
	}
	?>