<?php

    include_once ('Classes/imageLoader.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles.grid.css">
</head>
<body style="background: #888;">

<nav class="navbar navbar-inverse"  style="background-image: url('images/header.jpg');">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><img width="30px height="10px" " src=images/nav.jpg /></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center" >    
  <div class="row content">
    <div class="col-sm-2 sidenav" style="background: red; color: black;">
     <h4>List Restaurants by:</h4>
     <div class="well">
      <p><a href="#">Rating</a></p>
     </div>
     <div class="well">
      <p><a href="#">Price</a></p>
     </div>
     <div class="well">
      <p><a href="#">Nearest</a></p>
     </div>
    </div>
    <div class="col-sm-10 text-left"> 
      <?php
        if (isset($_SESSION['u_id'])) {
		  
          
          ?>
          
          
    
<div id="discription"></div>
          
          <?php

		  }
      ?>
      
      
      
      
      <div class="jumbotron" style="background-image: url('images/nav.jpg');">
  <div class="container text-center">      
    <h2>Local Restaurants</h2>
  </div>
</div>

<div class="container-fluid">    
  <div class="row">
  
      <?php
   
           $result = mysqli_query($db, "SELECT * FROM images");
      
         $fieldcount=mysqli_num_rows($result);
      
      for($i = 1; $i <= $fieldcount;){
        
        $damn = mysqli_query($db, "SELECT * FROM images WHERE id=$i");
        
        $row = mysqli_fetch_array($damn);
        
        echo "<div class='col-sm-4'>";
        echo "<div class='panel panel-primary'>";
                    echo "<div class='panel-body'><img style='width: 300px; height: 200px;' src='images/".$row['image']." ' class='img-responisve' style='width:100%' alt='image'> </div>";
                    echo "<div class='panel-footer'> ";
                    echo "<p>".$row['text']."</p>";
                    echo "</div>";
                echo "</div>";
        echo "</div>";
        
        $i++;
        
         $damn = mysqli_query($db, "SELECT * FROM images WHERE id=$i");
        
        $row = mysqli_fetch_array($damn);
        
        echo "<div class='col-sm-4'>";
        echo "<div class='panel panel-danger'>";
                    echo "<div class='panel-body'><img style='width: 300px; height: 200px;' src='images/".$row['image']." ' class='img-responisve' style='width:100%' alt='image'> </div>";
                    echo "<div class='panel-footer'> ";
                    echo "<p>".$row['text']."</p>";
                    echo "</div>";
                echo "</div>";
        echo "</div>";
        
        $i++;
        
         $damn = mysqli_query($db, "SELECT * FROM images WHERE id=$i");
        
        $row = mysqli_fetch_array($damn);
        
        echo "<div class='col-sm-4'>";
        echo "<div class='panel panel-success'>";
                    echo "<div class='panel-body'><img style='width: 300px; height: 200px;' src='images/".$row['image']." ' class='img-responisve' style='width:100%' alt='image'> </div>";
                    echo "<div class='panel-footer'> ";
                    echo "<p>".$row['text']."</p>";
                    echo "</div>";
                echo "</div>";
        echo "</div>";
        
        $i++;
      }
    
    ?>
    
    

    
   
  </div>
</div><br><br>
    </div>
   <!-- <div class="col-sm-0 sidenav" style="background:red; ">
      <div class="well" >
        <p>Fasika</p>
      </div>
      <div class="well">
        <p>Bole</p>
      </div>
    </div> -->
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
