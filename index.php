<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  
<?php




include 'connect.php';






if ($_SERVER["REQUEST_METHOD"] == "POST") {


 $username = test_input($_POST["name"]);
 $password = test_input($_POST["password"]);

  
  $hashname = hash('sha256', $username);
 $hashpassword = password_hash ( $password ,PASSWORD_DEFAULT);
 
 
$encrypt_method = "AES-256-CBC";
$length = 256;
$key = openssl_random_pseudo_bytes($length);
$keyoutput = base64_encode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($encrypt_method));
$ivoutput = base64_encode($iv);
$outputu = openssl_encrypt($username, $encrypt_method, $key, 0, $iv);


		
$checkuser = $conn->query("SELECT `userhash`  FROM `login` WHERE `userhash` = '$hashname'");
$data = mysqli_fetch_object($checkuser);

if(!empty($data))
{
$userr=$data->userhash;

	
	if ($userr == $hashname )
	{
		
	
		echo"user is already existed, please choose another username";
		
	}
	
}



else {
 $result = $conn->query("INSERT INTO `login` (`userhash`, `password`,`encryptuser`,`IV`) VALUES ('$hashname','$hashpassword','$outputu','$ivoutput')");
 
echo "<br>";
echo "<br>";

 
	
echo "Thanks ";
echo $username;
echo " for singing up, please proceed to Sign-in page ";
echo "<br>";
echo "<br>";		


}	





$outputud = openssl_decrypt($outputu, $encrypt_method, $key, 0, $iv);


}

function test_input($data) {
  $data = htmlspecialchars($data);
  return $data;
}


?>

<h2>Sign-up form :</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 
  Username: <br><br>    <input type="text" name="name">
  <br><br>
  Password:<br><br> <input type="password" name="password">
  <br><br>
  <input type="submit" name="submit" value="Sign Up">  
</form>
<br><br>
<b>or Sign-in here</b> 
<br><br>


<a href="login.php">Sign-in</a>



<?php


echo "<br>";
echo "<br>";
echo 'Current PHP version: ' . phpversion();


?>

</body>
</html>