<?php

session_start();

if (isset($_POST['submit'])) {
	
	include 'dbh.inc.php';

	$uid = mysqli_real_escape_string( $db, $_POST['uid']);
	$pwd = mysqli_real_escape_string( $db, $_POST['pwd']);
  


	//Error handlers
	//Check if inputs are empty
	if (empty($uid) || empty($pwd)) {
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM user WHERE username='$uid' OR email='$uid'";
		$result = mysqli_query( $db, $sql );
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				//De-hashing the password
				$hashedPwdCheck = password_verify($pwd, $row['password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../index.php?login=PasswordMismatch");
					exit();
				} else if ($hashedPwdCheck == true) {
					//Log in the user here
                  
                  
					$_SESSION['u_id'] = $row['username'];
					$_SESSION['u_email'] = $row['email'];
                    $_SESSION['u_type'] = $row['type'];
                    
                    if ($row['type'] == 1  ){
                     // echo "Admin Page";
                      header("Location: ../imageform.php");
                      exit();
                    }
                  
                    header("Location: ../index.php?login=success");
					exit();
                  
				
				}
			}
		}
	}
} else {
	header("Location: ../index.php?login=errorrr");
	exit();
}

