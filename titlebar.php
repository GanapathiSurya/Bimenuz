<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<div class="w3-row " style="background-color:rgb(77,166,255);">
  <div style="display:inline-block;border:0px solid black;float:left;" clas="w3-quarter">
   <a href="head.php"><img src="logosss.png" class="float-left mt-2 ml-2 mb-2 mr-2" width="45" height="50" id="logosss"></a>
   <img src="brandsss.png" class="float-left ml-4 mt-2 mb-2 mr-2" width='110' height="50" id="brandsss">
  </div>
  <?php
  if (!empty($_SESSION)) 
  { 
    //echo "hello";
   $profileget="select * from registration where userid='$uid'";
   $profilegetres=mysqli_query($con,$profileget);
   while ($row=mysqli_fetch_assoc($profilegetres)) 
   {
     $profile=$row['profile'];
   } 
  ?>
  <div class="w3-rest w3-margin-top">
    <a href="accountinfo.php"><img src="userprofiles/<?php echo $profile;?>" width='40' height='40' class='w3-round-xxlarge'></a>
    <?php
    echo "<span class='w3-text-white w3-large' id='name'><b>".$myname."</b></span>";
  }
  else 
  {
   echo "<a href='registerpage.php'><button class='w3-padding-small w3-round w3-border-0 w3-white  w3-margin sl'><i class='fa fa-user'></i></button></a>
<a href='loginpage.php'><button class='w3-padding-small w3-border-0 w3-round w3-white w3-margin sl'><i class='glyphicon glyphicon-log-in'></i></button></a>";
?>
<a href="registerpage.php"><button class="w3-padding-small w3-button w3-round w3-border-0 w3-white w3-margin slbig">Register</button></a>
<a href="loginpage.php"><button class="w3-padding-small w3-button w3-round w3-border-0 w3-white w3-margin slbig">Login</button></a>
<?php
  }
  ?>
  </div>
</div>
</body>
</html>