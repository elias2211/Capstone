<!DOCTYPE html>
<html lang="en-us">

<?php include_once('includes/head.php'); ?>

<body>

<?php include_once('includes/header.php'); ?>
<?php include_once('Classes/imageLoader.php'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-LQpvLKX7cmjcdKsjLgE_9dXUCOcm_H0"></script>

<script type="text/javascript">


    function usePosition( position ){

         new google.maps.Geocoder().geocode(
            {'latLng': new google.maps.LatLng(position.coords.latitude, position.coords.longitude)},
            function (result, status) {
                updateLocation(result[0].address_components[7].short_name);
            }
        );
    }

    function sortBasedOnRating(){
        var columnCount = 0;
        var rowCount = -1;

        $('.restaurant').sort(ratingComparator).each( function(){
            if(columnCount++%3==0){
                ++rowCount;
            }

            $( this ).appendTo('#row-' + rowCount);
        });
    }


    function updateLocation(updatedZip){

        var zipRegex = /\d{5}/;
        if(   !zipRegex.test(updatedZip)){
            alert("Invalid zip code, please enter a 5 digit zip code.");
            return;
        }

        if ( "undefined" !== typeof(Storage) ) {
            localStorage.setItem("user_zip", updatedZip);
        }

        distanceMatrixService = new google.maps.DistanceMatrixService();

        var destinationList = [];
        var distances = [];
        var i=0;
        $('.restaurant').each(function(){
            destinationList.push($( this ).attr("zip") + ", USA");
        });

        distanceMatrixService.getDistanceMatrix( {
            origins: [updatedZip + ", USA"],
            destinations: destinationList,
            travelMode: google.maps.TravelMode.DRIVING,
            avoidHighways: false,
            avoidTolls: false,
            unitSystem: google.maps.UnitSystem.IMPERIAL },
            function(response, status){

                if(status=="OK") {
                    for(var i=0; i<response.rows[0].elements.length;i++){
                        distances.push( response.rows[0].elements[i].distance.value );
                    }
                } else {
                    alert("Error");
                }

            var iter =0;
            $('.restaurant').each(function(){
                    $( this ).attr("distance", distances[iter++]);
                });

            var columnCount = 0;
            var rowCount = -1;

            $('.restaurant').sort(distanceComparator).each( function(){
                if(columnCount++%3==0){
                    ++rowCount;
                }
                
                $( this ).appendTo('#row-' + rowCount);
                });

            });

        }

    function distanceComparator( div1 , div2 ){

        if( parseInt(div1.getAttribute("distance"),10) > parseInt(div2.getAttribute("distance"),10) ){
            return 1;
        }else{
            return -1;
        }

    }

    function ratingComparator( div1 , div2 ){

        if( parseInt(div1.getAttribute("rating"),10) < parseInt(div2.getAttribute("rating"),10) ){
            return 1;
        }else{
            return -1;
        }

    }

    function showZipModal(){
         $('#zipModal').modal('show');
    }

    function getUserLocation(){

        if ( "undefined" !== typeof(Storage) ) {
            var storedZip = localStorage.getItem("user_zip");
            if(storedZip){
                updateLocation(storedZip);
                return;
            }
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(usePosition, showZipModal);
        }
    }

    $(window).on('load', getUserLocation);

    function showReviewModal(restaurantId, restaurantName){
        
        <?php

            if(!isset($_SESSION['u_id'])){
                echo("return;");
            }else{
                echo "$('#reviewModal #hiddenValue').val( restaurantId );";
                echo "$('#reviewModal .modal-header .modal-title').text( 'Review ' + restaurantName );";
                echo "$('#reviewModal').modal('show');";
            }
        ?>
        
    }



    function submitReview(){
        alert("test");
        $.ajax({
                url: "includes/review.inc.php",
                type: "POST",
                data: $("#reviewContent").serialize(),
                success: function(data){
                    alert("Successfully submitted.")
                }
        });
    }


</script>

<div class="container-fluid" id="sortableRestaurants">

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

                    $rowId = $row['id'];
                    $resultCount++;

                    if( $resultCount % 3 == 0 ){
                        echo "<div class='row' id='row-".$rowCount."' name='row-".$rowCount."'>\n";
                        $rowCount++;
                    }
                                    $rating = number_format(round($row['avg_rating'], 1), 1);
                                    
                                    if(!$rating){
                                        $rating='0.0';
                                    }
                    echo "<div class='col-sm-4 restaurant' id='restaurantColumn-".$rowId."' zip='".$row['zip']."' distance='' rating ='".$rating."'>\n";

                        echo "<div class='panel panel-primary'>\n";

                            echo "<div class='panel-body'>\n";
                                echo "<img style='height: 300px; width:100%; cursor: pointer;' onclick=\"$('#restaurantForm-".$row['id']."').submit()\" src='images/".$row['image']."' class='img-responisve' alt='image'>\n";
                            echo "</div>\n";

                            echo "<div class='panel-footer'> \n";

                                echo "<table class='restaurantInfo'>\n";

                                    echo "<tr>\n";

                                        echo "<td colspan='2'>\n";
                                            echo "<h3 style='color:#000000' onclick=\"$('#restaurantForm-".$row['id']."').submit()\"><a style='color:#000000' href=''>".$row['name']."</a></h3>\n";
                                        echo"</td>\n";

                                    echo "</tr>\n";

                                    echo "<tr>\n";

                                    

                                        echo "<td>\n";
                                            echo "<h4>".$rating."</h4>\n";
                                        echo"</td>\n";

                                        echo "<td>\n";
                                            echo "<div id='rating-".$rowId."' class='ratingDiv' onclick=\"showReviewModal(".$rowId.", '".$row['name']."');\">\n";
                                                echo "<fieldset class='rating'>\n";
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

                                                    echo "<input type='radio' id='rate5-".$rowId."' name='star-".$rowId."' value='5' onclick='return false;' ".$checked5." /><label class='full' for='rate5-".$rowId."'></label>\n";
                                                    echo "<input type='radio' id='rate4-".$rowId."' name='star-".$rowId."' value='4' onclick='return false;' ".$checked4." /><label class='full' for='rate4-".$rowId."'></label>\n";
                                                    echo "<input type='radio' id='rate3-".$rowId."' name='star-".$rowId."' value='3' onclick='return false;' ".$checked3." /><label class='full' for='rate3-".$rowId."'></label>\n";
                                                    echo "<input type='radio' id='rate2-".$rowId."' name='star-".$rowId."' value='2' onclick='return false;' ".$checked2." /><label class='full' for='rate2-".$rowId."'></label>\n";
                                                    echo "<input type='radio' id='rate1-".$rowId."' name='star-".$rowId."' value='1' onclick='return false;' ".$checked1." /><label class='full' for='rate1-".$rowId."'></label>\n";
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
                    <form id="reviewContent" action='includes/review.inc.php' method='POST'>
                        <div class="form-group">
                            <select class='form-control' style='width:10%' placeholder="1" id='ratingSelect' name='rating'>
                                <option value="" disabled selected>Rating</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label  for="reviewBody">Review:</label>
                            <textarea class="form-control" name='review' rows="3" id = "reviewBody" placeholder="..."></textarea>
                            <input type="hidden" name="restaurantId" id="hiddenValue" value="" />
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <div class='form-group'>
                        <button type="submit" class="btn btn-default" onclick="submitReview()" data-dismiss="modal">save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
