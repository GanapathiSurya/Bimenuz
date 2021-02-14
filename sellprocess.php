<?php
require 'connection.php';
if(!empty($_SESSION))
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
    
}
if (isset($_POST['sell_upload'])) 
{
$itemname=$_POST['iname'];
$itemdes=$_POST['ides'];
$itemprice=$_POST['iprice'];
$itemper=$_POST['per'];
$currency=$_POST['currency'];
$shoptype=$_POST['shoptype'];
echo "17.auto image details".$_POST['items'];
if ($_POST['items']!='') 
{
	/*echo $_POST['items'].",";
	echo $_POST['iname'].",";
	echo $_POST['iprice'].",";
	echo $_POST['ides'].",";
	echo $_POST['per'].",";
	echo $_POST['currency'].",";*/
$itemimage=$_POST['items'];	
if(empty($_POST['iname'])||empty($_POST['ides'])||empty($_POST['iprice'])||empty($_POST['per'])||empty($_POST['items'])||empty($_POST['currency'])) 
{
	echo "28.items empty";
header("Location:sellaccount.php?Empty=Please Fill all the Blanks");
}
else
{
$checkproduct="select * from sellproducts where userid='$uid' and itemtitle='$itemname' and itemprice='$itemprice' and per='$itemper'";
$checkproductresult=mysqli_query($con,$checkproduct);
if(!$checkproductresult)
{
    echo mysqli_error($con);
}
if (mysqli_num_rows($checkproductresult)>0) 
{
echo "39.inside items  exist";
header("Location:sellaccount.php?itemexist=The present item has not added as it already exists.");
}
else
{
	$iteminsert="insert into sellproducts values('$itemname','$itemdes','$itemprice','$currency','$itemper','$itemimage','$uid','$shoptype')";
	$iteminsertresult=mysqli_query($con,$iteminsert);
	if ($iteminsertresult) 
	{
echo "48.autoupload";
    header("Location:sellaccount.php");
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
}
echo "58.manual image details".$_FILES['itemimagemanual']['name'];
if ($_FILES['itemimagemanual']!='') 
{ 
echo "<br>no64-".$_FILES['itemimagemanual'];;
//echo "itemimagemanual";
//$itemimage=$_POST['itemimagemanual'];
$itemimage=$_FILES["itemimagemanual"]["name"];
$dates=date("Ymdhis");
/*$uidext=$uid.$dates;
echo $uidext;
rename($itemimage,$uidext);*/
if(empty($_POST['iname'])||empty($_POST['ides'])||empty($_POST['iprice'])||empty($_POST['per'])||empty($_FILES['itemimagemanual'])||empty($_POST['currency'])) 
	{
		echo "71.empty manual";
		header("Location:sellaccount.php?Empty=Please Fill all the Blanks");
	}
else
{
$target_dir = "fruits/";
    $target_file = $target_dir . basename($_FILES["itemimagemanual"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["itemimagemanual"]["tmp_name"]);
    if ($check!==false) 
    {
      if ($_FILES["itemimagemanual"]["size"] > 500000) 
     {
     	echo "85.file large";
      header("Location:sellaccount.php?profileerror=Sorry, your image is too large."); 
     }
     else
     {
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
      echo "93.filetype not ";
      header("Location:sellaccount.php?profileerror=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
      }
      else
      {
        if (move_uploaded_file($_FILES["itemimagemanual"]["tmp_name"], $target_file)) 
       {
       	date_default_timezone_set("Asia/Kolkata");
       	$dates=date("Ymdhis");
        $uidext=$uid.$dates;
       rename("$target_file","fruits/$uidext");
       echo "103.The file ". basename( $_FILES["itemimagemanual"]["name"]). " has been uploaded.";
       $sql="insert into sellproducts values('$itemname','$itemdes','$itemprice','$currency','$itemper','$uidext','$uid','$shoptype')";
       $result=mysqli_query($con,$sql);
       if ($result) 
       {
       	echo "108.manual upload";
       header("Location:sellaccount.php"); 
       }
       else
       {
       	echo "113.insertion error";
       	//echo mysqli_error($con);
       header("Location:sellaccount.php?error=Error.");
       }
       }
       else 
       {
       	echo "119.error in image upload";
      header("Location:sellaccount.php?profileerror=Error in image uploading."); 
       }
      }
     }
    }
    else
    {
    	//echo "127.file is not an image";
      //header("Location:sellaccount.php?profileerror=File is not an image.");
    }
}
}
}
//echo "nothing";
?>