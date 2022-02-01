<?php
session_start();
if(isset($_SESSION['username'])){
    $active_user = $_SESSION['username'];
}
if(isset($_POST['view-file'])){
    $file = $_POST['view-file'];
}
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$filename = $file;

ini_set('upload_max_filesize', '15M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
// We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
// To perform the check, we will use a regular expression.
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}
 
// Get the username and make sure that it is alphanumeric with limited other characters.
// You shouldn't allow usernames with unusual characters anyway, but it's always best to perform a sanity check
// since we will be concatenating the string to load files from the filesystem.
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

$full_path = sprintf("/srv/uploads/%s/%s", $active_user, $filename);

// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.


$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);

$stf = $filename;
  
if (strpos($stf, 'pdf') !== false) {
    header('Content-Type: application/pdf');
}
if (strpos($stf, 'xlsx') !== false) {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header("Content-Disposition: attachment; filename=$filename");
      header('Cache-Control: no-cache');
      header('Content-Transfer-Encoding: chunked'); 
      readfile($full_path);
}
if (strpos($stf, 'mp3') !== false) {
      header('Content-Type: audio/mpeg');
      header("Content-Disposition: attachment; filename=$filename");
      header('Cache-Control: no-cache');
      header('Content-Transfer-Encoding: chunked'); 
      readfile($full_path);
      exit;
    }

if (strpos($stf, 'mpeg') !== false) {
        header('Content-Type: video/mpeg');
        header("Content-Disposition: attachment; filename=$filename");
        header('Cache-Control: no-cache');
        header('Content-Transfer-Encoding: chunked'); 
        readfile($full_path);
        exit;
 }
 if (strpos($stf, 'mp4') !== false) {
    header('Content-Type: video/mp4');
    header("Content-Disposition: attachment; filename=$filename");
    header('Cache-Control: no-cache');
    header('Content-Transfer-Encoding: chunked'); 
    readfile($full_path);
    exit;
}
if (strpos($stf, 'mov') !== false) {
    header('Content-Type: video/quicktime');
    header("Content-Disposition: attachment; filename=$filename");
    header('Cache-Control: no-cache');
    header('Content-Transfer-Encoding: chunked'); 
    readfile($full_path);
    exit;
}

// Finally, set the Content-Type header to the MIME type of the file, and display the file.
header('Content-Type:'.$mime);

readfile($full_path);

?>