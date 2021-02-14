<!DOCTYPE html>
<html>
<head>
    
<link rel="icon" type="image/gif" href="icon.png" sizes="500*500">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script type="text/javascript" src="w3js.js"></script>
	<title>Images</title>
<style>
      
     .w3-quarter img
     { 
     	margin-bottom: 4px; cursor: pointer;opacity: 1;
     }
     .w3-quarter img:hover
     {
     	opacity: 0.6; transition: 0.3s
     }
	</style>
</head>
<body class="w3-large">
<?php

require 'connection.php';
error_reporting(0);
$image=$_GET['folder'];
$dir="folders/".$image."/";
$a=scandir($dir);
error_reporting(0);
?>
<div class="w3-bar w3-border-bottom w3-xxlarge w3-padding" style="height:80px;">
<div class="w3-bar-item">
<!--<i class='far fa-image w3-text-blue' style='font-size:50px'></i>-->
<img src="icon.png" width="60" height="60">
</div>
<div class="w3-bar-item  w3-xxlarge" style="font-family: aerial;color:#0066cc">
MiniGallery
</div>
</div>
<center>
<button class="w3-border-0 w3-blue w3-margin w3-round w3-padding-small w3-button" onclick="document.getElementById('form').style.display='block'">Add Photos</button>
<a href="whatsapp://send?text=minigallery.000webhostapp.com/gallerymain.php?folder=<?php echo $image;?>" data-action="share/whatsapp/share" class="w3-button  w3-padding-small"><i class='fab fa-whatsapp-square ' style='font-size:48px;color:rgb(51,204,0)'></i></a>
</center>
<div id="form" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('form').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
<form action="addimages.php" method="post" class=" w3-padding">
<center>
<input type="text" name="folder" value="<?php echo $image;?>" style="display:none;">
<input type="text" name="name" class="w3-margin" placeholder="Username" required><br>
<input type="password" name="password" class="w3-margin" placeholder="Password" required><br>
<input type="submit" name="loginsubmit" class="w3-blue w3-padding-small w3-border-0">
</center>
</form>
    </div>
  </div>
</div>

<div class="container">
<div class="w3-main w3-content" style="max-width:1600px;margin-top:10px">
 <div class="w3-row w3-border-top">
<?php
$count=1;
foreach ($a as $folder) 
{
	if ($count==5) 
	{
	$count=1;
	}
if($folder != '.' and $folder != '..')
{ 
?>
<?php
//echo $count;
if ($count==1) 
{
?>
   <div class="w3-quarter">
<img src="folders/<?php echo $image;?>/<?php echo $folder;?>" style="width:100%;height:300px;border-right:2px solid #ff9900;border-bottom:2px solid #ff9900;" onclick="onClick(this)" class="item" >
   </div>
<?php
}
?>

<?php
if ($count==2) 
{
?>
<div class="w3-quarter">
<img src="folders/<?php echo $image;?>/<?php echo $folder;?>" style="width:100%;height:300px;border-right:2px solid blue;border-bottom:2px solid blue" onclick="onClick(this)" class="item ">
   </div>
<?php
}
?>
<?php
if ($count==3) 
{
?>
<div class="w3-quarter">
<img src="folders/<?php echo $image;?>/<?php echo $folder;?>" style="width:100%;height:300px;border-right:2px solid #77b300;border-bottom:2px solid #77b300" onclick="onClick(this)" class="item ">
   </div>
<?php
}
?>
<?php
if ($count==4) 
{
?>
<div class="w3-quarter">
<img src="folders/<?php echo $image;?>/<?php echo $folder;?>" style="width:100%;height:300px;border-right:2px solid #ff99cc;border-bottom:2px solid #ff99cc" onclick="onClick(this)" class="item w3-border-pink">
   </div>
<?php
}
?>
<?php
}
$count=$count+1;
}
?>
</div>
</div>
</div>

<div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $location) {
    $scope.myUrl = $location.absUrl();
});


function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>
</body>
</html>