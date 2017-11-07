<?php

$db = mysqli_connect("127.0.0.1:3306", "root", "root", "ethioEnjoy");
	$msg = "";


	if (isset($_POST['upload'])) {
		$target = "../images/".basename($_FILES['image']['name']);


		$image = $_FILES['image']['name'];
		$image_text = mysqli_real_escape_string($db, $_POST['image_text']);


		$sql = "INSERT INTO images (image, text) VALUES ('$image', '$image_text')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}


?>

