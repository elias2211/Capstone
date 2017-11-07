<head>
  <?php include_once('includes/head.php'); ?>
</head>

<?php
  include_once 'includes/header.php';
?>
<style>
.form-control{
  width:50%;
}
</style>

<div class="container">
    
        <h2>Signup</h2>
          <form action="includes/signup.inc.php" method="POST">
            <div class="form-group">
              <label for="first">First Name:</label>
              <input type="text" class="form-control" name="first" id="first" placeholder="First Name" />
            </div>
            <div class="form-group">
              <label for="last">Last Name:</label>
              <input type="text" class="form-control" name="last" id="last" placeholder="Last Name" />
            </div>
            <div class="form-group">
              <label type="email" for="email">Email:</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Email Address" />
            </div>
            <div class="form-group">
              <label for="uid">Username:</label>
              <input type="text" class="form-control" name="uid" id="uid" placeholder="Username" />
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Password" />
            </div>
            <button type="submit" name="submit">Sign up</button>
          </form>
        </div>
</div>


