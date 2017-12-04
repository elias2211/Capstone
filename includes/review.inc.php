<?php

include 'dbh.inc.php';
session_start();

    if ( isset($_SESSION['u_id']) ) {

        $review = mysqli_real_escape_string( $db, $_POST['review']);
        $rating = mysqli_real_escape_string( $db, $_POST['rating']);
        $restaurantId = mysqli_real_escape_string( $db, $_POST['restaurantId']);

        $result = mysqli_query($db, "select id from user where username = '".$_SESSION['u_id']."';");

        if($result){

            $user_id = mysqli_fetch_array( $result )['id'];

            if( empty($user_id) || empty($rating) || empty($restaurantId) ||  empty($review)){
                header("Location: ../index.php?review=failure");
                exit();
            }else{
                $sql = "INSERT INTO review ( rating, text,  restaurant_id, user_id ) VALUES ( '$rating',  '$review', '$restaurantId', '$user_id' );";
                mysqli_query( $db, $sql );
                header("Location: ../index.php");
                exit();
            }
        }

    }

        header("Location: ../index.php?review=failure");
        exit();

?>