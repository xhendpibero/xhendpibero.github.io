<?php

$allowedOrigins = [
   'http://localhost:5173',
   'https://airbnb-react-simple.vercel.app',
];
 
if(in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins))
{
 $http_origin = $_SERVER['HTTP_ORIGIN'];
} else {
 $http_origin = "https://chipkoding.tech";
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: $http_origin");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

// include 'dbconfig.php'; // include database connection file

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
	
$fileName  =  $_FILES['sendimage']['name'];
$tempPath  =  $_FILES['sendimage']['tmp_name'];
$fileSize  =  $_FILES['sendimage']['size'];
		
$newName = uniqid();

if(empty($fileName))
{
	$errorMSG = json_encode(array("message" => "please select image", "status" => false));	
	echo $errorMSG;
}
else
{
	$upload_path = 'upload/'; // set upload folder path 
	
	$fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
		
	// valid image extensions
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
					
	// allow valid image file formats
	if(in_array($fileExt, $valid_extensions))
	{				
		//check file not exist our upload folder path
		if(!file_exists($upload_path . $newName . "." . $fileExt))
		{
			// check file size '5MB'
			if($fileSize < 5000000){
				move_uploaded_file($tempPath, $upload_path . $newName . "." . $fileExt); // move file from system temporary path to our upload folder path 
			}
			else{		
				$errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));	
				echo $errorMSG;
			}
		}
		else
		{		
			$errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));	
			echo $errorMSG;
		}
	}
	else
	{		
		$errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));	
		echo $errorMSG;		
	}
}
		
// if no error caused, continue ....
if(!isset($errorMSG))
{
	// $query = mysqli_query($conn,'INSERT into tbl_image (name) VALUES("'.$fileName.'")');
			
	echo json_encode(array("message" => "Image Uploaded Successfully", "fileName" => $newName . "." . $fileExt, "status" => true));	
}

?>

