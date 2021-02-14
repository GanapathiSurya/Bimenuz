<?php
require 'connection.php';
$userid=$_POST['userid'];
$password=$_POST['password'];
$uppassword=md5($password);
if (isset($_POST['login'])) 
{
	if(empty($_POST['userid'])||empty($_POST['password'])) 
	{

		header("Location:loginpage.php?Empty=Please Fill all the Blanks");
	}
	elseif((!empty($_POST['userid'])) && (!empty($_POST['password']))) 
	  {
	  $query="select * from registration where userid='$userid' and password='$uppassword'";
	  $result=mysqli_query($con,$query);
	    if (mysqli_num_rows($result)>0) 
	    {
	    	echo "string";
	     while ($row=mysqli_fetch_assoc($result)) 
	    {
	      $_SESSION['firstname']=$row['firstname'];
	      $_SESSION['lastname']=$row['lastname'];
	      $_SESSION['email']=$row['email'];
	      $_SESSION['phone']=$row['phone'];
	      $_SESSION['password']=$row['password'];
	      $_SESSION['gender']=$row['gender'];
	      $_SESSION['userid']=$row['userid'];	
	    }
	    	echo $_SESSION['userid'];
	    	header("Location:head.php");
	    }
	  
	  else
	  {
        header("Location:loginpage.php?Invalid=Invalid login details");
	  }
	}
}
?>