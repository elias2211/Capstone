<?php include_once('includes/head.php'); ?>

<body>

<?php include_once('includes/header.php'); ?>

<div class="container-fluid">
<?php
    $restaurantId = $_POST["id"];
        if (!empty($restaurantId)) {

            $result = mysqli_query($db,
                "select r.name, r.description, i.image
                    from
                        restaurant r
                    left join 
                        image i on i.restaurant_id = r.id
                    where 
                        r.id=".htmlspecialchars($restaurantId).";");

            if ( $result ) {
                $row = mysqli_fetch_array( $result );
                echo "<div class='panel panel-default'>\n";
                    echo "<div class='panel-heading'><h3>".$row['name']."</h3></div>";

                    echo "<div class='panel-body'>\n";
                        echo "<img style='height: auto; width:100%;' src='images/".$row['image']."' class='img-responisve' alt='image'>\n";
                    echo "</div>\n";

                    echo"<h2>".$row['description']."</h2>";
                echo "</div>\n";

                 $result = mysqli_query($db,
                                "select r.*, u.username
                                    from
                                review r
                                    join
                                user u
                                    on
                                r.user_id = u.id
                                    where 
                                restaurant_id=".htmlspecialchars( $restaurantId ).";");

                    if( isset( $_SESSION['u_id'] ) ){

                        echo "<form action='includes/review.inc.php' method='POST'>";
                            echo "<label for='rating'>Rating:</label>";
                            echo "<select class='form-control' style='width:5%' id='rating' name='rating'>";
                                echo "<option value='1'>1</option>";
                                echo "<option value='2'>2</option>";
                                echo "<option value='3'>3</option>";
                                echo "<option value='4'>4</option>";
                                echo "<option value='5'>5</option>";
                            echo "</select>";

                            echo "<div class='form-group'>";
                                echo "<label for='review'>Review:</label>";
                                echo "<textarea class='form-control' rows='3' placeholder = 'Review ".$row['name']."' id='review' name='review'></textarea>";
                                echo "<button type='submit' style='margin-top:1em' class='btn btn-primary'>Submit</button>";
                                echo "<input type='hidden' name='restaurantId' id='restaurantId' value=".$restaurantId.">";
                            echo "</div>";
                        echo "</form>";

                    }

                if ( $result && $result->num_rows > 0 ) {

                     echo "<div class='panel-group'>";
                    while( $row = mysqli_fetch_array( $result ) ) {

                        $reviewId = $row['id'];
                        $rating = $row['rating'];

                        echo "<div class='panel panel-default'>";

                            echo "<div class='panel-body'>";

                                echo "<table class='restaurantInfo'>\n";

                                    echo "<tr>\n";

                                                $roundedRating = intval($rating);
                                                if($rating > 4.8){
                                                    $roundedRating=5;
                                                }

                                                $checked1 = '';
                                                $checked2 = '';
                                                $checked3 = '';
                                                $checked4 = '';
                                                $checked5 = '';

                                                if($rating==1){
                                                    $checked1 = "checked='checked'";
                                                }else if($rating==2){
                                                    $checked2 = "checked='checked'";
                                                }else if($rating==3){
                                                    $checked3 = "checked='checked'";
                                                }else if($rating==4){
                                                    $checked4 = "checked='checked'";
                                                } elseif($rating==5){
                                                    $checked5 = "checked='checked'";
                                                }

                                        echo "<td>\n";
                                            echo "<div id='rating-".$reviewId."' class='ratingDiv'>";
                                                echo "<fieldset class='rating'>\n";
                                                    echo "<input type='radio' id='rate5-".$reviewId."' name='review-".$reviewId."' value='5' onclick='return false;' ".$checked5." /><label class='full' for='rate5-".$reviewId."'></label>\n";
                                                    echo "<input type='radio' id='rate4-".$reviewId."' name='review-".$reviewId."' value='4' onclick='return false;' ".$checked4."  /><label class='full' for='rate4-".$reviewId."'></label>\n";
                                                    echo "<input type='radio' id='rate3-".$reviewId."' name='review-".$reviewId."' value='3' onclick='return false;' ".$checked3."  /><label class='full' for='rate3-".$reviewId."'></label>\n";
                                                    echo "<input type='radio' id='rate2-".$reviewId."' name='review-".$reviewId."' value='2' onclick='return false;' ".$checked2."  /><label class='full' for='rate2-".$reviewId."'></label>\n";
                                                    echo "<input type='radio' id='rate1-".$reviewId."' name='review-".$reviewId."' value='1' onclick='return false;' ".$checked1."  /><label class='full' for='rate1-".$reviewId."'></label>\n";
                                                echo "</fieldset>\n";
                                            echo "</div>\n";
                                        echo "</td>\n";

                                    echo "</tr>\n";

                                    echo "<tr>\n";

                                        echo "<td colspan='2'>\n";
                                            echo "<h4>".$row['text']."</h4>\n";
                                        echo "</td>\n";

                                    echo "</tr>\n";

                                echo "</table>\n";
                                echo "<div><p style='float:right'>Posted by: ".$row['username']." </p></div>";
                            echo "</div>";
                        echo "</div>";

                    }
                    echo "</div>";
                } else {

                    echo "<div class='form-group'>";
                        echo "<label for='review'>Review:</label>";
                            echo "<textarea class='form-control' rows='5' placeholder = 'Be the first to review ".$row['name']."' id='review'></textarea>";
                        echo "</div>";
                    echo "</div>";

                }
            }

}else{  
    echo "404 Page not found";
}


?>
</div>
</body>