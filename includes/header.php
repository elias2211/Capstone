<?php
  session_start();
?>



<div class="masthead">
    <div class="container">
       <h1>EthioEnjoy</h1>
       <h4>Local Ethiopian Restaurants</h4>
    </div>
</div>

<div class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="\Capstone\index.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Restaurants<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php
              $result = mysqli_query($db, "select id, name from restaurant order by id asc;");
              
              if ( $result ) {

                while( $row = mysqli_fetch_array( $result ) ) {
                  echo "<li role='presentation'>
                    <form id='restaurantForm-".$row['id']."' action='restaurant.php' method='POST' class='navbar-form'>
                      <input type='hidden' name='id' value='".$row['id']."'>
                      <a href='#' onclick=\"$('#restaurantForm-".$row['id']."').submit()\"> ".$row['name']."</a>
                    </form></li>";
                }

              }

            ?>
          </ul>
        </li>
        <li><a onclick="$('#zipModal').modal('show');" href="#">Change Location</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php

            if(isset($_SESSION['u_id'])){

              echo '<li><form action="includes/logout.inc.php" class="navbar-form" method="POST">
                <button type="submit" name="submit">Logout</button>
                </form></li>';

            } else {

              echo '<li><form action="includes/login.inc.php" method="POST" id="login" class="navbar-form navbar-right">
                <div class="input-group">
                <input class="form-control" type="text" name="uid" placeholder="Username/e-mail">
                </div>
                 <div class="input-group">
                <input class="form-control" type="password" name="pwd" placeholder="Password">
                </div>
                <div class="input-group">

                <button type="submit" name="submit">Login</button>

                </div>
                </form>
                </li>

                <li><a href="signup.php" >Sign up</a></li>';
            }
          ?>
      </ul>
    </div>
  </div>
</div>

<div class="modal fade" id="zipModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Please enter zip code</h4>
        </div>
        <div class="modal-body">
          <input id = "zipInput"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="updateZip()" data-dismiss="modal">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>