<?php

    include_once 'includes/header.php';
    include_once ('Classes/imageLoader.php');

?>


<section class="main-container">
    <div class="main-wrapper">
        <h2></h2>
        
   
    
        <?php
        if (isset($_SESSION['u_id'])) {
          
          echo "<h1>Welcome  "; 
          echo $_SESSION['u_first'] ."!</h1>"; 
          echo "<br /><br />";
  
          
          ?>
          
          
    
<!--<div id="discription"></div> -->
          
          <?php

		  }
      ?>
      
      
      
      
      <div class="jumbotron">
  <div class="container text-center">
    <h1>Restaurants</h1>      
    <p>Local Restaurants</p>
  </div>
</div>

<div class="container">    
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
</section>


<?php 

    include_once 'includes/footer.php';

?>


<?php 

echo "githut test";

?>

