<?php
session_start();
if(isset($_SESSION['username'])){
    $active_user = $_SESSION['username'];
}
if(isset($_POST['share'])){
    $file = $_POST['share'];
}
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//make sure filename is valid format
$filename = $file;

if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	
}
//make sure username inputted is valid
if(isset($_POST['user'])){
	$user_share = $_POST['user'];
}

$my_path = sprintf("/srv/uploads/%s/%s", $active_user, $filename);
$share_path = sprintf("/srv/uploads/%s/%s", $user_share, $filename);

//copy file to another user directory
copy($my_path, $share_path); 

//go to home
header("Location: index.php");
?>