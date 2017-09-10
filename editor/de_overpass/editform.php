<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM '.$table_name.' WHERE id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$title = $_POST['title'];// user name
		$help = $_POST['help'];// user email
		$line_x1 = $_POST['line_x1'];// user email
		$line_y1 = $_POST['line_y1'];// user email
		$line_x2 = $_POST['line_x2'];// user email
		$line_y2 = $_POST['line_y2'];// user email
		$middle_positions = $_POST['middle_positions'];// user email
		$mode = $_POST['mode'];// user email
		$side = $_POST['side'];// user email
		$youtube = $_POST['youtube'];// user email

		$imgFile = $_FILES['image1']['name'];
		$tmp_dir = $_FILES['image1']['tmp_name'];
		$imgSize = $_FILES['image1']['size'];

		$imgFile2 = $_FILES['image2']['name'];
		$tmp_dir2 = $_FILES['image2']['tmp_name'];
		$imgSize2 = $_FILES['image2']['size'];

		$imgFile3 = $_FILES['image3']['name'];
		$tmp_dir3 = $_FILES['image3']['tmp_name'];
		$imgSize3 = $_FILES['image3']['size'];
		 
$stmt = ('SELECT COUNT(*) FROM '.$table_name.'');
$result = $DB_con->prepare($stmt); 
$result->execute(); 
$rows = $result->fetchColumn(); 
$number_of_rows = $rows + 1; 

		if($imgFile)
		{
			$upload_dir = $upload_path; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg'); // valid extensions
			$userpic = $number_of_rows."_1.".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['image1']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['image1']; // old image from database
		}	
				if($imgFile2)
		{
			$upload_dir = $upload_path; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg'); // valid extensions
			$userpic2 = $number_of_rows."_2.".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize2 < 5000000)
				{
					unlink($upload_dir.$edit_row['image2']);
					move_uploaded_file($tmp_dir2,$upload_dir.$userpic2);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic2 = $edit_row['image2']; // old image from database
		}	

		if($imgFile3)
		{
			$upload_dir = $upload_path; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile3,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg'); // valid extensions
			$userpic3 = $number_of_rows."_3.".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize3 < 5000000)
				{
					unlink($upload_dir.$edit_row['image3']);
					move_uploaded_file($tmp_dir3,$upload_dir.$userpic3);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic3 = $edit_row['image3']; // old image from database
		}
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE '.$table_name.'
									     SET title=:title, 
										     help=:help, 
										     line_x1=:line_x1, 
										     line_y1=:line_y1, 
										     line_x2=:line_x2, 
										     line_y2=:line_y2, 
										     middle_positions=:middle_positions, 
										     mode=:mode, 
										     side=:side, 
										     image1=:image1, 
										     image2=:image2, 
										     image3=:image3, 
										     youtube=:youtube 
								       WHERE id=:uid');

			$stmt->bindParam(':title',$title);
			$stmt->bindParam(':help',$help);
			$stmt->bindParam(':line_x1',$line_x1);
			$stmt->bindParam(':line_y1',$line_y1);
			$stmt->bindParam(':line_x2',$line_x2);
			$stmt->bindParam(':line_y2',$line_y2);
			$stmt->bindParam(':middle_positions',$middle_positions);
			$stmt->bindParam(':mode',$mode);
			$stmt->bindParam(':side',$side);
			$stmt->bindParam(':image1',$userpic);
			$stmt->bindParam(':image2',$userpic2);
			$stmt->bindParam(':image3',$userpic3);
			$stmt->bindParam(':youtube',$youtube);
			$stmt->bindParam(':uid',$id);

				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='index.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
		
						
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $map_name; ?>  Edit spot</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="jquery-1.11.3-jquery.min.js"></script>
</head>
<body>

<div class="container">


	<div class="page-header">
    	<h1 class="h2"><?php echo $map_name; ?>  Edit spot id <?php echo $id; ?> <a class="btn btn-default" href="index.php"> all spots </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Title <span class="help_text">(From (place) to (Place))</span></label></td>
        <td><input class="form-control" type="text" name="title" placeholder="Enter title of nade" value="<?php echo $title; ?>" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Help <span class="help_text">(1(throw),2(jump&throw),3(run&throw),4(run&jump&throw),5(catwalk&throw),6(catwalk&jump&throw),7(crouch&throw))</span></label></td>
        <td><input class="form-control" type="text" name="help" placeholder="Enter type of smoke" value="<?php echo $help; ?>" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">line_x1 <span class="help_text">(x position of spot point on line)</span></label></td>
        <td><input class="form-control" type="text" name="line_x1" placeholder="Enter line_x1" value="<?php echo $line_x1; ?>" /></td>
    </tr>
        <tr>
    	<td><label class="control-label">line_y1 <span class="help_text">(y position of spot point on line))</span></label></td>
        <td><input class="form-control" type="text" name="line_y1" placeholder="Enter line_y1" value="<?php echo $line_y1; ?>" /></td>
    </tr>
        <tr>
    	<td><label class="control-label">line_x2 <span class="help_text">(x position of target point on line))</span></label></td>
        <td><input class="form-control" type="text" name="line_x2" placeholder="Enter line_x2" value="<?php echo $line_x2; ?>" /></td>
    </tr>
        <tr>
    	<td><label class="control-label">line_y2 <span class="help_text">(y position of target point on line)</span></label></td>
        <td><input class="form-control" type="text" name="line_y2" placeholder="Enter line_y2" value="<?php echo $line_y2; ?>" /></td>
    </tr>   
      <tr>
    	<td><label class="control-label">Middle Positions <span class="help_text">(for bounce of nade (by wall,skybox etc...), usage x,y x1,y2 x2,y2 ... (example 456,125))</span></label></td>
        <td><input class="form-control" type="text" name="middle_positions" placeholder="Enter middle_positions" value="<?php echo $middle_positions; ?>" /></td>
    </tr>  
       <tr>
    	<td><label class="control-label">Mode <span class="help_text">(1(smoke), 2(fire), 3(flash))</span></label></td>
        <td><input class="form-control" type="text" name="mode" placeholder="Enter mode" value="<?php echo $mode; ?>" /></td>
    </tr>
      <tr>
    	<td><label class="control-label">Side <span class="help_text">(1(T Side), 2(CT Side))</span></label></td>
        <td><input class="form-control" type="text" name="side" placeholder="Enter side" value="<?php echo $side; ?>" /></td>
    </tr>       
    <tr>
    	<td><label class="control-label">Spot image</label></td>
        <td><input class="input-group" type="file" name="image1" accept="image/*" /></td>
    </tr>
        <tr>
    	<td><label class="control-label">Cross image</label></td>
        <td><input class="input-group" type="file" name="image2" accept="image/*" /></td>
    </tr>
        <tr>
    	<td><label class="control-label">Target image</label></td>
        <td><input class="input-group" type="file" name="image3" accept="image/*" /></td>
    </tr>
          <tr>
    	<td><label class="control-label">Youtube link</label></td>
        <td><input class="form-control" type="text" name="youtube" placeholder="Enter Youtube link" value="<?php echo $youtube; ?>" /></td>
    </tr> 
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>


<div class="alert alert-info">
    <strong>RankSea.com Spots Admin</strong>!
</div>

</div>
</body>
</html>