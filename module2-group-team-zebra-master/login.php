<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>File Sharing Site</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="login.css" rel="stylesheet">
</head>
<body>

<div id="login" class="col-xs-1 text-center">	
	<h2> Login to FileShare </h2> <br/><br/>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" />
		 <br/>
		<input class="btn-outline-primary" type="submit" value="Submit" />
		<br/>
		<a href='createuser.php'>Sign Up</a>
	
	</form>
 
 
<?php
if(isset($_POST['username'])){
	$active_user = $_POST['username'];
	chdir("/srv/files/");
	$h = fopen('users.txt',"r");
	// info found from https://tecadmin.net/check-string-contains-substring-in-php/
	$user_found = "no";
	while( !feof($h) ){
		if ($_POST['username'] ==  trim(fgets($h)) &&  $_POST['username'] !== '') {
			$_SESSION["username"]=$active_user;
			chdir($active_user);
			$user_found = "yes";
			header("Location: index.php");
			exit; 
		} 
	}
	if ($user_found == "no" && $_POST['username'] !== ''){
		printf("No account associated with that username. Please ");

		

	}
	fclose($h);

}
?>


</div>




    
</body>
</html>
  