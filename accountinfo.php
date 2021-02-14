<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
<title>My Bimenuz Account</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style type="text/css">
 a:link,a:visited
 {
 	text-decoration: none;
 }
 @media screen and (max-width:240px)
 {
 	#profile
 	{
 		display:block;
 	}
 }
 @media screen and (min-width:300px)
 {
 	#profile
 	{
 	display:none;
	 }
 }

@media screen and (max-width:768px)
{
  #name
  {
    display: none;
  }
  #addsearch
  {
    background-color: rgb(77,219,255);
  }
}
 </style>
 </head>
 <body>
  <?php
  require 'titlebar.php';
  ?>
  <?php
  if(!empty($_SESSION))
  {
echo "<ul class='w3-ul w3-padding'>";
echo "<li class='w3-rightbar w3-border-light-grey w3-padding'>UserId: ".$_SESSION['userid']."</li>";
echo "<li class='w3-leftbar w3-border-light-grey w3-padding'>Name: ".$_SESSION['firstname']."</li>";
echo "<li class='w3-rightbar w3-border-light-grey w3-padding'>Email: ".$_SESSION['email']."</li>";
echo "<li class='w3-leftbar w3-border-light-grey w3-padding'>Phone: ".$_SESSION['phone']."</li>";
echo "<li class='w3-rightbar w3-border-light-grey w3-padding'>Gender: ".$_SESSION['gender']."</li>";
echo "</ul>";   
?>
 <a href='logout.php'><button id='logout' class='w3-round w3-padding w3-border-0 w3-white w3-text-black w3-margin w3-bar-item w3-hover-gray'>Logout</button></a>
<?php
  }
  else
  {
  
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
  }
 ?>
 </body>
 </html>