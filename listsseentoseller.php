<?php
/*session_start();
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
$con=mysqli_connect("localhost","root","","bimenuz");
if (!$con) 
{
  die("Connection failed".mysqli_error());
}
$countlist=0;
$number="select * from list where sellerid='$uid'";
$numberresult=mysqli_query($con,$number);
if (mysqli_num_rows($numberresult)>0) 
{
	while ($row=mysqli_fetch_assoc($numberresult)>0) 
	{
		$countlist=$countlist+1;
	}
	echo $countlist;
	$checklistnumber="select * from numberoflists where shopkeeperid='$uid'";
	$checklistnumberresult=mysqli_query($con,$checklistnumber);
	if (mysqli_num_rows($checklistnumberresult)==0) 
	{
	 $insertnumber="insert into numberoflists values('$uid','$countlist')";
	 mysqli_query($con,$insertnumber);	
	 echo "25.".$uid."<br>";
	}
	else
	{
	echo "35.".$uid."<br>";
	while($row=mysqli_fetch_assoc($checklistnumberresult))
	{
	 $listseen=$countlist-$row['listseen'];
	 echo "34".$listseen;
	 echo $uid;
	 $update="update numberoflists set listseen='$listseen' where shopkeeperid='$uid'";
	  $resultu=mysqli_query($con,$update);
	  if (!$resultu) 
	 {
	 	echo "41.".mysqli_error($con);
	 }
	}	
	}
	//header("Location:orderlists.php");
}
else
{
//header("Location:orderlists.php");
}
   ?>