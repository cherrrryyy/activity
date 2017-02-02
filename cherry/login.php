<?php session_start(); 

?>
<hmtl>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="#">

		<h1>LOGIN</h1>
		<input type="text" name="username" placeholder="Enter Username" /><br/><br/>
		<input type="password" name="password" placeholder="Enter Password" /><br/>
		<input type="submit" name="submit" value="GO!" /><br/>	
	</form>

	<?php 
		$c = oci_connect("cherr","cherr","localhost/XE");

		if(!$c){
			$e = oci_error();
			trigger_error('Could not connect to database: '.$e['message'], E_USER_ERROR);
		}
		if(isset($_POST['submit'])){
			$username = $_POST['username'];
			$password = $_POST['password'];

		$s = oci_parse($c, "Select * From USER_2 Where Username ='" . $username ."' and Password ='" . $password ."'");
		if(!$s){
			$e = oci_error($c);
			trigger_error('Could not parse statement: ' .$e['message'], E_USER_ERROR);
		}
		$r = oci_execute($s);
		if(!$r){
			$e = oci_error($c);
			trigger_error('Could not execute statement: ' .$e['message'], E_USER_ERROR);
		}
		$row = oci_fetch_array($s);

		$a = oci_num_rows($s);
		if(!$a){
			echo "Incorrect Username and Password";
		}
		else {
			$_SESSION['token']=$username;
			header("Location:index.php");	
		}
		
		}	
	?>	
</body>
</html>
