<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="recently-deleted.css">


</head>
<body>
<nav class="navbar navbar-dark bg-dark">
<a class="navbar-brand" href="index.php" >FileShare</a>
  <a class = "navlabel" href="upload.php">Upload Files</a>
  <a class = "navlabel" href="recently-deleted.php">Recently Deleted</a>
  <a class = "navlabel" href="logout.php">Logout</a>
</nav>
<div class="box">
<h4>Delete forever.</h4>
<?php
session_start();
$active_user = $_SESSION['username'];
$directory = sprintf("/srv/uploads/deleted/%s", $active_user);
$files3 = scandir($directory);

for($i=0; $i<count($files3); $i++){
    if($files3[$i] !== '.' && $files3[$i] !== '..'){

    
    print_r($files3[$i]);
    echo "<br>";
    }
} 
?>
<form action="delete-forever.php" method="POST" >
	<p>
		<label for="delete-file">What file do you want to delete?</label>
		<input type="text" name="delete-file" id="delete-file" />
	</p>
	<p>
		<input type="submit" value="Submit"/>
	</p> 
</form> 

</div>
</body>
</html>