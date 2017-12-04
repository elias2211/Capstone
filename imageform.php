
<?php
  include_once('includes/head.php'); 
  include_once('includes/header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Image Upload</title>
	<style type="text/css">
		#content{
			width: 50%;
			margin: 20px auto;
			border: 2px solid #cbcbcb;
		}
		form{
			width: 50%;
			margin: 20px auto;
		}
		form div{
			margin-top: 5px;
		}
		#img_div{
			width: 50%;
			padding: 5px;
			margin: 15px auto;
			border: 5px solid #cbcbcb;
		}
      #text_area{
        background: black;
        color: white;
        display: inline;
        float: left;
        text-align: center;
      }
		#img_div::after{
			content: "";
			display: block;
			clear: both;
		}
		img{
			float: left;
			margin: 5px;
			width: 300px;
			height: 140px;
		}
	</style>
	
  </head>
<body>



<div id="content">

    <h3>Welcome Admin!</h3>

	<form method="POST" action="Classes/imageLoader.php" enctype="multipart/form-data">
		<input type="hidden" name="size" value="1000000">
		<div>
			<input type="file" name="image">
		</div>

		<?php
              $result = mysqli_query($db, "select id, name from restaurant order by name asc;");
              
            if ( $result ) {
				echo "<div class='form-group'>";
                    echo "<select class='form-control' style='width:50%' id='restaurantSelect' name='restaurantId'>";
                    echo "<option value='' disabled selected>Restaurant</option>";
                while( $row = mysqli_fetch_array( $result ) ) {

                                echo "<option value=".$row['id'].">".$row['name']."</option>";

                }
                echo "</select>";
                echo "</div>";
            }

        ?>
		<div>
			<textarea id="text" cols="40" rows="4" name="image_text" placeholder="Say something about this image..."></textarea>
		</div>
		<div>
			<button type="submit" name="upload">POST</button>
		</div>
	</form>
</div>

</body>
</html>