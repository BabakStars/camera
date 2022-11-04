<?php


$target_dir = "uploads/";
$datum = mktime(date('H')+0, date('i'), date('s'), date('m'), date('d'), date('y'));
$target_file = $target_dir . date('Y.m.d_H:i:s_', $datum) . basename($_FILES["imageFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//*******************************************************************************
$link = mysqli_connect("localhost","Database username","Database password","Database name");
							mysqli_set_charset($link, "utf8");
							if(mysqli_connect_errno())
							{
								//exit("ERROR");
							}
							$querys = "SELECT * FROM `photograf` WHERE 1";
				            $result = mysqli_query($link,$querys);
				            $row = mysqli_fetch_array($result);
							$lastpath = $row['name'];
							unlink($lastpath);
							
							
							
							$query = "UPDATE photograf SET name='$target_file' WHERE 1";
							if(mysqli_query($link,$query)===true)
									{
										//echo("OKOK");
									}
//*******************************************************************************

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  }
  else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["imageFile"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else {
  if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["imageFile"]["name"]). " has been uploaded.";
	//unlink($target_file);
  }
  else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>