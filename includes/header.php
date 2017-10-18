<?php
	session_start();
?>



<!DOCTYPE html>
<html>
<head>
  <title>EthioEnjoy</title>
  <link rel="stylesheet" href="../styles.css" />
  <title>Capstone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="javascript.js"></script>
</head>
<body style="background: #eee;">

<header>
  <nav>
    <div class="main-wrapper">
      <ul>
        <li><a href="index.php">Home</a></li>
      </ul>  
    </div>
    <div class="login">
     
     <?php
      
      if(isset($_SESSION['u_id']))
      {
        
        echo '<form action="includes/logout.inc.php" method="POST">
              <button type="submit" name="submit">Logout</button>
              </form>';
        
      }
      
      else
      {
        echo '<form action="includes/login.inc.php" method="POST">
              <input type="text" name="uid" placeholder="Username/e-mail">
              <input type="password" name="pwd" placeholder="Password">
              <button type="submit" name="submit">Login</button>
              </form>
              <a href="signup.php">Sign up</a>';
      }
      
      
      ?>
    
    </div>
  </nav>
    
</header>