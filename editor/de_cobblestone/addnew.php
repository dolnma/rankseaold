<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'dbconfig.php';
	
	if(isset($_POST['btnsave']))
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
		
		if(empty($title)){
			$errMSG = "Please fill Title";
		}
		else if(empty($help)){
			$errMSG = "Please fill help";
		}
		else if(empty($line_x1)){
			$errMSG = "Please fill line_x1";
		}
		else if(empty($line_y1)){
			$errMSG = "Please fill line_y1";
		}
		else if(empty($line_x2)){
			$errMSG = "Please fill line_x2";
		}
		else if(empty($line_y2)){
			$errMSG = "Please fill line_y2";
		}
		else if(empty($mode)){
			$errMSG = "Please fill mode";
		}
		else if(empty($side)){
			$errMSG = "Please fill side";
		}
		else
		{
			$upload_dir = $upload_path; // upload directory

			// IMAGE 1
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg'); // valid extensions
		
			// rename uploading image
			$userpic = $number_of_rows."_1.".$imgExt;

				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 10000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG files are allowed or you didnt inserted the file.";		
			}

			// IMAGE 2
			$imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension
		
		
			// rename uploading image
			$userpic2 = $number_of_rows."_2.".$imgExt;

				
			// allow valid image file formats
			if(in_array($imgExt2, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize2 < 10000000)				{
					move_uploaded_file($tmp_dir2,$upload_dir.$userpic2);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG files are allowed or you didnt inserted the file.";		
			}

			// IMAGE 3
			$imgExt3 = strtolower(pathinfo($imgFile3,PATHINFO_EXTENSION)); // get image extension
		
			// rename uploading image
			$userpic3 = $number_of_rows."_3.".$imgExt;

				
			// allow valid image file formats
			if(in_array($imgExt3, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize3 < 10000000)				{
					move_uploaded_file($tmp_dir3,$upload_dir.$userpic3);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG files are allowed or you didnt inserted the file.";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO '.$table_name.'(title,help,line_x1,line_y1,line_x2,line_y2,middle_positions,mode,side,image1,image2,image3,youtube) VALUES(:title, :help, :line_x1, :line_y1, :line_x2, :line_y2, :middle_positions, :mode, :side, :image1, :image2, :image3, :youtube)');

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

			
			if($stmt->execute())
			{
				$successMSG = "new spot succesfully added ...";
				header("refresh:5;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $map_name; ?> Add new spot</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

</head>
<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
    </div>
</div>

<div class="container">


	<div class="page-header">
    	<h1 class="h2"><?php echo $map_name; ?> Add new spot <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
    </div>
    

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
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
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; save
        </button>
        </td>
    </tr>
    
    </table>
    
</form>



<div class="alert alert-info">
    <strong>RankSea.com Spots Admin</strong>!
</div>

    

</div>



	


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>