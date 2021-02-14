<?php
require 'connection.php';
$myname=$_SESSION['firstname'];
$myphone=$_SESSION['phone'];
if (isset($_POST['fest_create_submit'])) 
{
$festname=$_POST['festname'];
$festdate=$_POST['festdate'];
$festtime=$_POST['festtime'];
$festcity = $_POST['festcity'];
$feststate = $_POST['feststate'];
$festcountry= $_POST['festcountry'];
$festpincode = $_POST['festpincode'];
$festvenue = $_POST['festvenue'];
if(empty($_POST['festname'])||empty($_POST['festdate'])||empty($_POST['festtime'])||empty($_POST['festcity'])||empty($_POST['feststate'])||empty($_POST['festcountry'])||empty($_POST['festpincode'])||empty($_POST['festvenue'])||empty($_FILES['festprofile']['name'])) 
  {
    echo "empty";
    echo $_FILES['festprofile']['name'];
    header("Location:liveevents.php?error=Please Fill all the Blanks");
  }
 elseif(!empty($_POST['festname']) && !empty($_POST['festdate']) && !empty($_POST['festtime']) && !empty($_POST['festcity']) && !empty($_POST['feststate']) && !empty($_POST['festcountry']) && !empty($_POST['festpincode']) && !empty($_POST['festvenue']) && !empty($_FILES['festprofile']['name']))
 {
       $festsql="select * from fests where userid='$uid'";
       $festcheckid=mysqli_query($con,$festsql);
       if (mysqli_num_rows($festcheckid)>0) 
        {
          echo "27";
         header("Location:liveevents.php?error=The Fest already exists with this IdOnly one fest at a time is allowed.");
        }
        else
        {
    $target_dir = "festprofiles/";
    $target_file = $target_dir . basename($_FILES["festprofile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["festprofile"]["tmp_name"]);
         if ($check!==false) 
    {
      if ($_FILES["festprofile"]["size"] > 500000) 
     {
      echo "41.file large";
     header("Location:liveevents.php?error=Sorry, your image is too large."); 
     }
     else
     {
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
      echo "49.filetype not ";
      header("Location:liveevents.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
      }
      else
      {
        if (move_uploaded_file($_FILES["festprofile"]["tmp_name"], $target_file)) 
       {
        date_default_timezone_set("Asia/Calcutta");
        $dates=date("Ymdhis");
        $uidext=$uid.$dates;
       rename("$target_file","festprofiles/$uidext");
       echo "103.The file ". basename( $_FILES["festprofile"]["name"]). " has been uploaded.";
       $query="insert into fests(festname,festdate,festtime,festcity,feststate,festpincode,festcountry,festvenue,festprofile,userid) values('$festname','$festdate','$festtime','$festcity','$feststate','$festpincode','$festcountry','$festvenue','$uidext','$uid')";
       $result=mysqli_query($con,$query);
       if($result)
       {
          echo "65";
             header("Location:liveevents.php");

       }
       else
       {
        echo "71.insertion error";
      echo mysqli_error($con);
      //header("Location:liveevents.php?error=Error.");
       }
       }
       else 
       {
        echo "78.error in image upload";
     // header("Location:liveevents.php?profileerror=Error in image uploading."); 
       }
      }
     }
    }
  }
 } 
}
?>
<?php
if (isset($_POST['add_fest_shops_submit'])) 
{ 
$festerid=$_POST['festerid'];
$festshoppers=$_POST['festshopowners'];
$arrayfestshoppers=explode(",",$festshoppers);
date_default_timezone_set("Asia/Kolkata");
$dates=date("M d");
$timing=date("h:ia");
echo "101";
    if(empty($_POST['festshopowners'])) 
    {
       echo $_POST['festerid'];
       echo $_POST['festshopowners'];
       //header("Location:myfests.php?error=Please Fill all the Blanks");
    }
    elseif(!empty($_POST['festshopowners'])) 
    {
      echo count($arrayfestshoppers)."jj";
    if (count($arrayfestshoppers)>5) 
    {
      echo "111";
      //header("Location:myfests.php?error=Maximum five receipients are allowed at a time.");
    }  
    else
    {
      echo "117";
      foreach ($arrayfestshoppers as $value) 
      {
        echo $value;
    $sql="select * from festshoppers where festshopperid='$value' and festerid='$festerid'";
    $checkid=mysqli_query($con,$sql);
     if (mysqli_num_rows($checkid)>0) 
     {
     header("Location:myfests.php?error=One or some of the receipients added already.");      
     }
     else
     {
      $query="INSERT INTO festshoppers values('$festerid','$value')";
      $result=mysqli_query($con,$query);
      if ($result)
      {
        echo "130";
        header("Location:myfests.php");
      }
      
      } 
      }
    }
 }
}
?>
<?php
if (isset($_POST['fest_add_shop'])) 
{
    $festname=$_POST['festname'];
    $festdate=$_POST['festdate'];
    $festtime=$_POST['festtime'];
    $festprofile=$_POST['festprofile']; 
    $festerid=$_POST['festerid'];
    echo "153".$festerid;
    $festvenue=$_POST['festvenue'];
$checkfestshop="select * from festshopperdetails where festerid='$festerid' and festshopperid='$uid'";
$checkfsresult=mysqli_query($con,$checkfestshop);
if (mysqli_num_rows($checkfsresult)==0) 
{
$sql="insert into festshopperdetails(festname,festdate,festtime,festvenue,festprofile,festerid,festshopperid,festshopperphone,festshoppername) values('$festname','$festdate','$festtime','$festvenue','$festprofile','$festerid','$uid','$myphone','$myname')";
$rres=mysqli_query($con,$sql);
header("Location:festaccount.php?festerid=".$festerid);
}
else
{
header("Location:festaccount.php?festerid=".$festerid);
}
}
?>
<?php
if (isset($_POST['fest_product_upload'])) 
{
$itemname=$_POST['itemname'];
$itemprice=$_POST['itemprice'];
$itemper=$_POST['itemper'];
$itemcurrency=$_POST['itemcurrency'];
$festerid=$_POST['productfesterid'];
if(empty($_POST['itemname'])||empty($_POST['itemprice'])||empty($_POST['itemper'])||empty($_POST['itemcurrency'])||empty($_FILES['itemimage']['name'])) 
{
  echo "28.items empty";
header("Location:festaccount.php?error=Please Fill all the Blanks&festerid=".$festerid);
}
else
{
$checkproduct="select * from festproducts where festshopperid='$uid' and itemname='$itemname' and itemprice='$itemprice' and itemper='$itemper'";
$checkproductresult=mysqli_query($con,$checkproduct);
if (mysqli_num_rows($checkproductresult)>0) 
{
echo "39.inside items  exist";
header("Location:festaccount.php?itemexist=The present item has not added as it already exists.&festerid=".$festerid);
}
else
{
$itemimage=$_FILES["itemimage"]["name"];
$dates=date("Ymdhis");
$target_dir = "festproducts/";
    $target_file = $target_dir . basename($_FILES["itemimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
    if ($check!==false) 
    {
      if ($_FILES["itemimage"]["size"] > 500000) 
     {
      echo "85.file large";
      header("Location:festaccount.php?error=Sorry, your image is too large.&festerid=".$festerid); 
     }
     else
     {
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
      echo "93.filetype not ";
    header("Location:festaccount.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed.&festerid=".$festerid);
      }
      else
      {
        if (move_uploaded_file($_FILES["itemimage"]["tmp_name"], $target_file)) 
       {
        date_default_timezone_set("Asia/Kolkata");
        $dates=date("Ymdhis");
        $uidext=$uid.$dates;
       rename("$target_file","festproducts/$uidext");
       echo "103.The file ". basename( $_FILES["itemimage"]["name"]). " has been uploaded.";
       $iteminsert="insert into festproducts values('$itemname','$itemprice','$itemcurrency','$itemper','$uidext','$uid','$festerid')";
       $iteminsertresult=mysqli_query($con,$iteminsert);
       if ($iteminsertresult) 
         { 
         echo "202.uploaded.";
         header("Location:festaccount.php?festerid=".$festerid);
         }
        else
         {
         echo mysqli_error($con);
         } 
       }
       else 
       {
        echo "119.error in image upload";
      header("Location:festaccount.php?error=Error in image uploading.&festerid=".$festerid); 
       }
      }
     }
    }
    else
    {
      echo "127.file is not an image";
      header("Location:festaccount.php?error=File is not an image.&festerid=".$festerid);
    }
}
}
}
?>
<?php
if (isset($_POST['end_fest'])) 
{
  $delete1="delete from fests where userid='$uid'";
  mysqli_query($con,$delete1);

  $delete2="delete from festproducts where festerid='$uid'";
  mysqli_query($con,$delete2);

  $delete3="delete from festshoppers where festerid='$uid'";
  mysqli_query($con,$delete3);

  $delete4="delete from festshopperdetails where festerid='$uid'";
  mysqli_query($con,$delete4);
  //header("Location:myfests.php");
}
?>
<?php
if (isset($_POST['gotofest'])) 
{
  $festerid=$_POST['festerid'];
  $festprofile=$_POST['festprofile'];
  header("Location:gotofest.php?festerid=".$festerid."&festprofile=".$festprofile);
}
?>

<?php
if (isset($_POST['myfestgo'])) 
{
  $festerid=$_POST['festerid'];
  $festprofile=$_POST['festprofile'];
  header("Location:gotofest.php?festerid=".$festerid."&festprofile=".$festprofile);
}
?>
<?php
if (isset($_POST['fest_shop_name_submit'])) 
{
  $festshopname=$_POST['festshopname'];
  $festerid=$_POST['festerid'];
  $shopnameupdate="update festshopperdetails set festshopname='$festshopname' where festerid='$festerid' and festshopperid='$uid'";
  mysqli_query($con,$shopnameupdate);
   header("Location:festaccount.php?festerid=".$festerid);
}
?>
<?php
if (isset($_POST['festshopperproducts'])) 
{
  echo "shop";
 $festerid=$_POST['festerid'];
 $festshoppername=$_POST['festshoppername'];
 $festshopperphone=$_POST['festshopperphone'];
 $festshopname=$_POST['festshopname'];
 $festshopperid=$_POST['festshopperid'];
 header("Location:festshopitemsdisplay.php?festerid=".$festerid."&festshopperid=".$festshopperid."&festshopname=".$festshopname."&festshoppername=".$festshoppername."&festshopperphone=".$festshopperphone);
}
?>
<?php
if(isset($_POST['orders_submit']))
{
  $festerid=$_POST['festerid'];
  header("Location:festorderstoseller.php?festerid=".$festerid);
}
?>

















 











