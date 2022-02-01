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
    <title>Create User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="createuser.css" rel="stylesheet">
    
</head>
<body>
<div id="createuser" class="col-xs-1 text-center">	
<h1> Create New Account </h1>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
	<p>
		<label for="username">New Username:</label>
		<input type="text" name="username" id="username" />
	</p>
	<p>
		<input type="submit" value="Submit" />
	</p> 
	
</form> 

<?php
if(isset($_POST['username'])){
	$active_user = $_POST['username'];
    chdir("/srv/files/");
    //use w to write in users.txt file to add account 
	$fp = fopen('users.txt',"a+");
    print($active_user);

    // write username at end of users.txt file 
    fwrite($fp, $active_user."\n");
    //create directory for new user
    chdir("/srv/uploads/");
    mkdir("/srv/uploads/$active_user/", 0700);
    mkdir("/srv/uploads/deleted/$active_user", 0700);
	
    fclose($fp);
    
    
echo ", new account successful";
echo "<br/>";
echo  "<a href='login.php'>Login</a>";

}
?>




    </div>
</body>
</html>
 