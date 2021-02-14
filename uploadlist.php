<?php
$myname=$_SESSION['firstname'];
require 'connection.php';
if (isset($_POST['list_submit'])) 
{
if ($_FILES['list']!='') 
{ 
$sellerid=$_POST['sellerid'];
$target_dir = "lists/";
    $target_file = $target_dir . basename($_FILES["list"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["list"]["tmp_name"]);
    if ($check!==false) 
    {
      if ($_FILES["list"]["size"] > 500000) 
     {
      echo "85.file large";
      header("Location:shopitemsdisplay.php?profileerror=The list has not been uploaded since your image is too large.&id=".$sellerid); 
     }
     else
     {
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
      echo "93.filetype not ";
      header("Location:shopitemsdisplay.php?profileerror=The list has not been uploaded since only JPG, JPEG, PNG & GIF files are allowed.&id=".$sellerid);
      }
      else
      {
        if (move_uploaded_file($_FILES["list"]["tmp_name"], $target_file)) 
       {
        date_default_timezone_set("Asia/Kolkata");
        $dates=date("Ymdhis");
        $present=date("Y-m-d h:i:sa");
        $uidext=$uid.$dates;
       rename("$target_file","lists/$uidext");
       echo "103.The file ". basename( $_FILES["list"]["name"]). " has been uploaded.";
       $sql="insert into list values('$uid','$uidext','$sellerid','$present','notdelivered')";
       $result=mysqli_query($con,$sql);
       if ($result) 
       {
        echo "108.manual upload";
       header("Location:shopitemsdisplay.php?id=".$sellerid); 
       }
       else
       {
        echo "113.insertion error";
        //echo mysqli_error($con);
       header("Location:shopitemsdisplay.php?error=The list has not been uploaded since error.&id=".$sellerid);
       }
       }
       else 
       {
        echo "119.error in image upload";
      header("Location:shopitemsdisplay.php?profileerror=The list has not been uploaded since error in image uploading.&id=".$sellerid); 
       }
      }
     }
    }
    else
    {
    header("Location:shopitemsdisplay.php?profileerror=The list has not been uploaded since file is not an image.&id=".$sellerid);
    }
}
}
if (isset($_POST['yes_list'])) 
{
$datetimebuy=$_POST['orderlistdate'];
$delivered="update list set status='delivered' where userid='$uid' and datetime='$datetimebuy'";
$deliveredresult=mysqli_query($con,$delivered);
if (!$deliveredresult) 
{
echo mysqli_error($con);
}
else
{
echo "jj";
header("Location:mylists.php"); 
}
}

?>