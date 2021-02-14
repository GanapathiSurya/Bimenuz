<?php
require 'connection.php';
$fname=$_SESSION['firstname'];
$lname=$_SESSION['lastname'];
$email=$_SESSION['email'];
$phone=$_SESSION['phone'];
$uid=$_SESSION['userid'];
//$password=$_SESSION['password'];
if (isset($_POST['sell_submit'])) 
{
  echo "17";
$sname=$_POST['sshopn'];
$city=$_POST['scity'];
$state=$_POST['sstate'];
$country=$_POST['scountry'];  
$address=$_POST['saddress'];
$phonepegooglepay=$_POST['phonepegooglepay'];
/*echo $_POST['sshopn'];
echo $_POST['scity'];
echo $_POST['sstate'];
echo $_POST['scountry'];  
echo $_POST['saddress'];
echo $_FILES['profile']['name'];*/
$dup="select * from seller where userid='$uid'";
 $dupresult=mysqli_query($con,$dup);
 if (mysqli_num_rows($dupresult)>0) 
 {
  echo "exist";
 header("Location:sellform.php?accountexist=The shop with this userid already exists.");
 }
 else
 {
  if (!isset($_POST['sell_type'])) 
  {
    echo "ggsg";
    header("Location:sellform.php?Empty=Please Fill all the blanks");

  }
  else
  {
    echo "45";
    $shoptype=$_POST['sell_type'];
    $stype=implode(",", $shoptype);
   $profile=$_FILES["profile"]["name"];
  if(empty($_POST['sshopn']) || empty($_POST['scity']) || empty($_POST['scountry']) || empty($_POST['sstate']) || empty($_POST['saddress']) || empty($profile)) 
 {
  echo "empty";
 header("Location:sellform.php?Empty=Please Fill all the Blanks");
 }
  else
  {
    echo "hello";
  $target_dir = "sellerprofiles/";
    $target_file = $target_dir . basename($_FILES["profile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["profile"]["tmp_name"]);
    if ($check!==false) 
    {
      if ($_FILES["profile"]["size"] > 500000) 
     {
      header("Location:sellform.php?profileerror=Sorry, your profile is too large."); 
     }
     else
     {
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
        echo "ext";
      header("Location:sellform.php?profileerror=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
      }
      else
      {
        if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) 
       {
       rename("$target_file","sellerprofiles/$uid");
       echo "The file ". basename( $_FILES["profile"]["name"]). " has been uploaded.";
        $sql="insert into seller(fname,lname, email,phone,shopname, shoptype,city,state,country,userid,address,profile,phonepegooglepay) values ('$fname','$lname','$email','$phone','$sname','$stype','$city','$state','$country','$uid','$address','$uid','$phonepegooglepay')";
       $result=mysqli_query($con,$sql);
       if ($result) 
       {
       header("Location:sellaccount.php"); 
       }
       else
       {
           echo mysqli_error($con);
        //header("Location:sellform.php?error=Error.");
       }
       }
       else 
       {
        echo "not uploaded";
       header("Location:sellform.php?profileerror=Error in profile uploading."); 
       }
      }
     }
    }
    else
    {
      header("Location:sellform.php?profileerror=profile is not an image.");
    }
  }
  }
}
}
?>
