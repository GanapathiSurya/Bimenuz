<!DOCTYPE html>
<html>
<?php
require 'connection.php';?>
<head>
  <title>Login page</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
input
{
  background-color:#f3f3f3;
}
</style>
<body class="w3-light-grey">
    <br><br><br><br><br><br>
<div class="w3-container " style="max-width:600px;margin:auto;">
<table class="w3-table" style="background-color: rgb(77,166,255);">
<thead>
</thead>
<tbody>
<td>
<img src="logosss.png" width="45" height="50">
</td>
<td>
<img src="brandsss.png" width="110" height="50">
</td>
<td>
New User?<br><a href="registerpage.php" target="_self"><span class="w3-text-white">Register</span></a>
</td>
</tbody>	
</table>
<div>
        <form action="login.php" method="post" class="w3-container w3-white  " >
        <!--Printing Error message-->
         <?php
        if (@$_GET['Empty']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['Empty'];?></div>  
        <?php
        }
         ?> 
          <?php
        if (@$_GET['Invalid']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['Invalid'];?></div>  
        <?php
        }
         ?> 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-large fas fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border-0" name="userid" type="text" placeholder="Userid">
    </div>
</div>


<div class="w3-row w3-section">
	<div class="w3-col" style="width:50px;"><i class="w3-large fas fa-key"></i></div>
	<div class="w3-rest">
		<input class="w3-input w3-border-0" type="password" name="password" placeholder="Password">
   </div>
</div>
<input type="submit" value="Login" class="w3-button  w3-block w3-hover-blue w3-section  w3-ripple w3-padding" style="background-color: rgb(77,166,255);color:black" name="login">

</form>
 <?php
  if (isset($_GET['newpwd'])) {
    if ($_GET['newpwd']=="password updated") {
      echo "<p>password has been updated</p>";
    }
  }

 ?>
   <!--<a href="reset-password.php">Forgot Password</a>-->
      </div>
    </div>

</body>
</html>