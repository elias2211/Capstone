<?php include_once('includes/head.php'); ?>

<body>

<?php include_once('includes/header.php'); ?>


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
                $restaurantName = $row['name'];

                $row = mysqli_fetch_array( $result );
                echo "<h3>".$restaurantName."</h3>";
                echo "<div class='panel panel-primary'>\n";

                     echo "<div class='panel-body'>\n";
                        echo "<img style='height: 300px; width:100%;' src='images/".$row['image']."' class='img-responisve' alt='image'>\n";
                    echo "</div>\n";

                    echo"<h2>".$row['description']."</h2>";
                echo "</div>\n";

                 $result = mysqli_query($db,
                            "select *
                                    from
                               review
                                    where 
                                restaurant_id=".htmlspecialchars($restaurantId).";");
                if ( $result ) {

                    while( $row = mysqli_fetch_array( $result ) ) {

                         echo "<table class='restaurantInfo'>\n";

                                    echo "<tr>\n";

                                        echo "<td>\n";
                                            echo "<div id='rating-".$restaurantId."' class='ratingDiv' onclick=\"showReviewModal(".$restaurantId."');\">\n";
                                                echo "<fieldset class='rating'>\n";
                                                    echo "<input type='radio' id='rate5-".$restaurantId."' name='test-".$restaurantId."' value='5' /><label class='full' for='rate5-".$restaurantId."'></label>\n";
                                                    echo "<input type='radio' id='rate4-".$restaurantId."' name='test-".$restaurantId."' value='4' /><label class='full' for='rate4-".$restaurantId."'></label>\n";
                                                    echo "<input type='radio' id='rate3-".$restaurantId."' name='test-".$restaurantId."' value='3' /><label class='full' for='rate3-".$restaurantId."'></label>\n";
                                                    echo "<input type='radio' id='rate2-".$restaurantId."' name='test-".$restaurantId."' value='2' /><label class='full' for='rate2-".$restaurantId."'></label>\n";
                                                    echo "<input type='radio' id='rate1-".$restaurantId."' name='test-".$restaurantId."' value='1' /><label class='full' for='rate1-".$restaurantId."'></label>\n";
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

                   

                    }
                }else{
                    echo"<h2>Be the first to review". $restaurantName."</h2>";
                }
            }

}else{  
    echo "404 Page not found";
}


?>
</body>