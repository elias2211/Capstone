<?php
  ini_set('mysqli.connect_timeout',300);
ini_set('default_socket_timeout', 300);
?>
 

 <html>
  <head>
    <title>image uploader</title>
  </head>
  <body>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="image" />
      <input type="submit" name="submit" value="upload" />
    </form>
    
    <?php
      if(isset($_POST['submit']) && isset($_FILES['file']))
      {
        
        $file_temp = $_FILES['file']['tmp_name'];
        if(getimagesize($file_temp) == FALSE)
        {
          echo "please select an image.";
        }
        
        else
        {
          
          $image = addslashes($_FILES['image']['tmp_name']);
          $name = addslashes($_FILES['image']['name']);
          $image = file_get_contents($image);
          $image = base64_encode($image);
          saveimage($name, $image);
          
        
        }
      }
    
    function saveimage($name, $image)
    {
       $dbServername = "localhost:8889";
      $dbUsername = "root";
      $dbPassword = "root";
      $dbName = "ethioEnjoy";

      $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
      
      if($conn){
        echo 'database connected';
      }
      $qry = "INSERT INTO images (name,image) VALUES ('$name','$image')";
      $result = mysqli_query($conn, $qry);
      
      if($result)
      {
        echo "<br /> Image uploaded.";
      }
      
      else
      {
        echo "<br /> Image not uploaded.";
      }
    }
    
    ?>
    
    
    
    
    
    
    
  </body>
</html>