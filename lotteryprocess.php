<?php
require 'connection.php';
if (isset($_POST['lottery_form_submit'])) 
{
$countfiles = count($_FILES['userprofile']['name']);
 for($i=0;$i<$countfiles;$i++){
  $filename = $_FILES['userprofile']['name'][$i];
  /*
 if ($i==0) 
 {
 	$var='first';
 }
 if ($i==1) 
 {
 	$var='second';
 }
 if ($i==2) 
 {
 	$var='third';
 }
 if ($i==3) 
 {
 	$var='fourth';
 }
 if ($i==4) 
 {
 	$var='fifth';
 }*/
  $tr=move_uploaded_file($_FILES['userprofile']['tmp_name'][$i],'lotteryproducts/'.$filename);
  $target_dir = "lotteryproducts/";
  $target_file = $target_dir . basename($filename);
  rename("$target_file","lotteryproducts/$i");
  echo $tr;
 }
}
if (isset($_POST['delete']))
{ 
$folder_path = "lotteryproducts"; 
   
// List of name of files inside 
// specified folder 
$files = glob($folder_path.'/*');  
  $n=count($files);
  echo $n;
// Deleting all the files in the list 
foreach($files as $file) 
{ 
   
    if(is_file($file))  
    
        // Delete the given file 
        unlink($file);  
} 
	/*
{
 $s=scandir("lotteryproducts/");
foreach ($s as $value) 
{
	echo $value;
unlink("$value");
}*/
}
if (isset($_POST['chance'])) 
{
	$chance=$_POST['chance'];
	$checkrecord="select * from lotteryresult where userid='$uid'";
	$checkrecordresult=mysqli_query($con,$checkrecord);
	if (mysqli_num_rows($checkrecordresult)==0) 
	{   
    $insertrecord="insert into lotteryresult(userid,gift) values('$uid','$chance')";
    $insertrecordresult=mysqli_query($con,$insertrecord);
    if ($insertrecordresult) 
    {
    	header("Location:lotterymain.php");
    }
	}
    else
    {
    	$updaterecord="update lotteryresult set gift='$chance' where userid='$uid'";
    	$updaterecordresult=mysqli_query($con,$updaterecord);
    	if ($updaterecordresult) 
    	{
    		header("Location:lotterymain.php");
    	}
    	else
    	{
    		echo mysqli_error($con);
    	}
    }
}
if (isset($_POST['lottery_timings'])) 
{
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];
	$starttime=$_POST['starttime'];
	$endtime=$_POST['endtime'];
	$rowcheck="select * from lotterytimings";
	$rowcheckresult=mysqli_query($con,$rowcheck);
	if (mysqli_num_rows($rowcheckresult)==0) 
	{
		$inserttimings="insert into lotterytimings values('$startdate','$starttime','$enddate','$endtime')";
		$inserttimingsresult=mysqli_query($con,$inserttimings);
		if ($inserttimingsresult) 
		{
			header("Location:lotterystart.php");
		}
    else
    {
      echo mysqli_error($con);
    }
	}
	else
	{
		header("Location:lotterystart.php?exist=lottery available already.");
	}
}
if(isset($_POST['lotteryaddress']))
{
    $place=$_POST['place'];
$update="update lotteryresult set deliveryplace='$place' where userid='$uid'";
$updateres=mysqli_query($con,$update);
header("Location:lotterymain.php");
}
?>