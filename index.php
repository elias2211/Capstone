<!DOCTYPE html>
<html lang="en-us">

<?php include_once('includes/head.php'); ?>

<body>

<?php include_once('includes/header.php'); ?>
<?php include_once('Classes/imageLoader.php'); ?>

<script type="text/javascript">

        $(window).on('load',function(){
            $('#zipModal').modal('show');
        });

        function showReviewModal(restaurantId, restaurantName){
            $('#reviewModal #hiddenValue').val( restaurantId );
            $('#reviewModal .modal-header .modal-title').text( "Review " + restaurantName );
            $('#reviewModal').modal('show'); 
        }

</script>

<div class="container-fluid">

        <?php
                     $result = mysqli_query($db,
                            "select r.*, i.image, v.text, avg(rating) as avg_rating, v.id as review_id
                                    from
                                restaurant r
                                    join 
                                image i on i.restaurant_id = r.id 
                                    left join
                                review v on v.restaurant_id = r.id
                                where (v.id is null or v.id in (select max(id) from review group by restaurant_id)) 
                                    group by r.id;");

            if ( $result ) {

                $resultCount = -1;
                $rowCount = 0;

                while( $row = mysqli_fetch_array( $result ) ) {

                    $resultCount++;

                    $rowId = $row['id'];

                    if( $resultCount % 3 == 0 ){
                        echo "<div class='row' name='row-".($rowCount++)."'>\n";
                    }

                    echo "<div class='col-sm-4'>\n";

                        echo "<div class='panel panel-primary'>\n";

                            echo "<div class='panel-body'>\n";
                                echo "<img style='height: 300px; width:100%;' src='images/".$row['image']."' class='img-responisve' alt='image'>\n";
                            echo "</div>\n";

                            echo "<div class='panel-footer'> \n";

                                echo "<table class='restaurantInfo'>\n";

                                    echo "<tr>\n";

                                        echo "<td colspan='2'>\n";
                                            echo "<h3>".$row['name']."</h3>\n";
                                        echo"</td>\n";

                                    echo "</tr>\n";

                                    echo "<tr>\n";

                                    $rating = number_format(round($row['avg_rating'], 1), 1);
                                    
                                    if(!$rating){
                                        $rating='0.0';
                                    }

                                        echo "<td>\n";
                                            echo "<h4>".$rating."</h4>\n";
                                        echo"</td>\n";

                                        echo "<td>\n";
                                            echo "<div id='rating-".$rowId."' class='ratingDiv' onclick=\"showReviewModal(".$rowId.", '".$row['name']."');\">\n";
                                                echo "<fieldset class='rating'>\n";
                                                    echo "<input type='radio' id='rate5-".$rowId."' name='test-".$rowId."' value='5' /><label class='full' for='rate5-".$rowId."'></label>\n";
                                                    echo "<input type='radio' id='rate4-".$rowId."' name='test-".$rowId."' value='4' /><label class='full' for='rate4-".$rowId."'></label>\n";
                                                    echo "<input type='radio' id='rate3-".$rowId."' name='test-".$rowId."' value='3' /><label class='full' for='rate3-".$rowId."'></label>\n";
                                                    echo "<input type='radio' id='rate2-".$rowId."' name='test-".$rowId."' value='2' /><label class='full' for='rate2-".$rowId."'></label>\n";
                                                    echo "<input type='radio' id='rate1-".$rowId."' name='test-".$rowId."' value='1' /><label class='full' for='rate1-".$rowId."'></label>\n";
                                                echo "</fieldset>\n";
                                            echo "</div>\n";
                                        echo "</td>\n";

                                    echo "</tr>\n";

                                    echo "<tr>\n";

                                        echo "<td colspan='2'>\n";
                                            echo "<h4>".$row['description']."</h4>\n";
                                        echo "</td>\n";

                                    echo "</tr>\n";

                                echo "</table>\n";

                                echo "</div>\n";

                            echo "</div>\n";

                        echo "</div>\n";

                    if( $resultCount % 3 == 2 ){
                        echo "</div>\n";
                    }
                }
            }
        ?>

</div><br><br>

<div class="modal fade" id="reviewModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" style="float:right;" data-dismiss="modal">&times;</span>
                    <h4 class="modal-title"></h4>

                </div>
                <div class="modal-body">
                    <form id="reviewContent">
                        <div class="form-group">
                            <label for="reviewTitle">Review Title:</label>
                            <input class="form-control" id = "reviewTitle" placeholder="Review Title"/>
                        </div>
                        <div class="form-group">
                            <label  for="reviewBody">Review Body:</label>
                            <input class="form-control" id = "reviewBody" placeholder="..."/>
                            <input type="hidden" name="hiddenValue" id="hiddenValue" value="" />
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="submitReview" data-dismiss="modal">save</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
