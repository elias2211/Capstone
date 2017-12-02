<?php

if (isset($_POST['submit'])) {
	
	include_once 'dbh.inc.php';

	$email = mysqli_real_escape_string( $db, $_POST['email']);
	$username = mysqli_real_escape_string( $db, $_POST['uid']);
	$pwd = mysqli_real_escape_string( $db, $_POST['pwd']);

	//Error handlers
	//Check for empty fields
	if ( empty($email) || empty($username) || empty($pwd) ) {
		header("Location: ../signup.php?signup=empty");
		exit();
	 } else {
			//Check if email is valid
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signup.php?signup=email");
			exit();
		} else {
			$sql = "SELECT * FROM user WHERE username='$username'";
			$result = mysqli_query( $db, $sql);
			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck > 0) {
				header("Location: ../signup.php?signup=usertaken");
				exit();
			} else {
				//Hashing the password
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
				//Insert the user into the database
				$sql = "INSERT INTO user ( username, password,  email, type ) VALUES ( '$username',  '$hashedPwd', '$email', 0 );";
				mysqli_query( $db, $sql );
				header("Location: ../index.php?signup=success");
				exit();
			}
		}
	}
}

?>