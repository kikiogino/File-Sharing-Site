<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">
    
    
</head>
<body> 
  
<nav class="navbar navbar-dark bg-dark">

<a class="navbar-brand" href="#" >FileShare</a>
  <a class = "navlabel" href="upload.php">Upload Files</a>
  <a class = "navlabel" href="recently-deleted.php">Recently Deleted</a>
  <a class = "navlabel" href="logout.php">Logout</a>
</nav>

<div class = content>
<?php
if(isset($_SESSION['username'])){
    $active_user = $_SESSION['username'];
    echo "Hello ".$active_user.", you are now logged in!";
}
    ?>


<br/>
<br/>
<a href="upload.php">Upload Files</a><br/>

<br/><br/>

<h2>Files:</h2>
<br/>

<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


chdir("/srv/uploads/");
$dir = sprintf("/srv/uploads/%s", $active_user);
$files2 = scandir($dir, 1);

for($i=0; $i<count($files2)-2; $i++){
    print_r($files2[$i]);
    echo "<br>";
}
 


?>
<br/>
<form action="readfile.php" method="POST" target="_blank">
		<label for="view-file">What file do you want to view?</label>
		<input type="text" name="view-file" id="view-file" />
		<input type="submit" value="Submit" />
</form> 
<br/>
<form action="delete.php" method="POST" >
		<label for="delete">What file do you want to delete?</label>
		<input type="text" name="delete" id="delete" />
		<input type="submit" value="Submit"/>
</form> 
<br/>
<form action="share.php" method="POST">
		<label for="share">What file do you want to share?</label>
		<input type="text" name="share" id="share" />
        <label for="user">Share with:</label>
        <input type = "text" name = "user" id = "user" />
        <input type="submit" value="Submit"/>
</form> 

</div>

</body>
</html>