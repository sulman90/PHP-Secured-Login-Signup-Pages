<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  
<?php




include 'connect.php';






if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$name = $password = "";
	
$username = test_input($_POST["name"]);
 $password = test_input($_POST["password"]);
  

 
	 
	 
$hashname = hash('sha256', $username);	 

	
$hashpass = $conn->query("SELECT `password`, `iv`  FROM `login` WHERE `userhash` = '$hashname'");	


$data = mysqli_fetch_object($hashpass);

if(!empty($data))
{
$passhash = $data->password;
$myiv = $data->iv;




if (password_verify($password,$passhash)) {
    echo 'Welcome ';
	echo $username ;
	echo "<br>";
	
	
} else {
    echo ' username or password is Invalid.';
}
}

 else {
    echo 'username or password is Invalid.';
}



  }


function test_input($data) {
  $data = htmlspecialchars($data);
  return $data;
}


?>

<h2>Login page :</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 
  Username:<br><br> <input type="text" name="name">
  <br><br>
  Password: <br><br> <input type="password" name="password">
  <br><br>
  <input type="submit" name="submit" value="Sign in">  
</form>
<br><br>
<b>or sign-up here</b> 
<br><br>

<a href="index.php">Sign-up</a>
 
</form>


</body>
</html>
