<?php
session_start();
if(isset($_SESSION['username'])){
    $active_user = $_SESSION['username'];
}
if(isset($_POST['delete-file'])){
    $file = $_POST['delete-file'];
}
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$filename = $file;

// We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
// To perform the check, we will use a regular expression.
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}
 

$full_path = sprintf("/srv/uploads/deleted/%s/%s", $active_user, $filename);

// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
chdir(sprintf("/srv/uploads/deleted/%s", $active_user));
unlink(realpath($filename));
header('Location: index.php');
?>