<?php

	$msg = "";


	if (isset($_POST['upload'])) {
		$target = "../images/".basename($_FILES['image']['name']);


		$image = $_FILES['image']['name'];
		$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
		$restaurantId = mysqli_real_escape_string($db, $_POST['restaurantId']);


		$sql = "INSERT INTO images ( restaurant_id, image, text) VALUES ( '$restaurantId', '$image', '$image_text')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}


?>

