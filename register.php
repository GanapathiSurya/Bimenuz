<?php
require 'connection.php';
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$uid=$_POST['userid'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$uppassword=md5($password);
$upcpassword=md5($cpassword);
$gender = $_POST['gender'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
if (isset($_POST['submit'])) 
{
	if(empty($_POST['fname'])||empty($_POST['userid'])||empty($_POST['lname'])||empty($_POST['email'])||empty($_POST['phone'])||empty($_POST['password'])||empty($_POST['cpassword'])||empty($_POST['gender'])||empty($_FILES['userprofile']['name'])) 
	{
		header("Location:registerpage.php?Empty=Please Fill all the Blanks");
	}
	elseif(!empty($_POST['fname']) && !empty($_POST['userid']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['cpassword']) && !empty($_POST['gender']) && !empty($_FILES['userprofile']['name'])) 
	  {
        $sql="select * from registration where userid='$uid'";
       $checkid=mysqli_query($con,$sql);
         if (mysqli_num_rows($checkid)>0) 
        {
         header("Location:registerpage.php?exist=Please choose another id.Entered id already exists.please choose another one.");
        }
        else
        {
     if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
       {
        header("Location:registerpage.php?invemail=please enter a valid email");
       } 
     else 
        {
          if (filter_var($phone, FILTER_VALIDATE_INT) === false || strlen($phone)!=10) 
          {
            header("Location:registerpage.php?invnum=please enter a valid number");
          }
         else 
          {
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) 
           {
          header("Location:registerpage.php?invpassword=password must contain atleast 8 characters,Out of them atleast 1 special symbol,1 uppercase,1 lowercase,1 digit.");
           }
        else
           {
           if ($password!=$cpassword) 
           {
            header("Location:registerpage.php?matchpassword=passwords are not same.");
           }
           else
           {
            
                $target_dir = "userprofiles/";
    $target_file = $target_dir . basename($_FILES["userprofile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["userprofile"]["tmp_name"]);
    if ($check!==false) 
    {
      if ($_FILES["userprofile"]["size"] > 500000) 
     {
      echo "85.file large";
      header("Location:registerpage.php?profileerror=Sorry, your image is too large."); 
     }
     else
     {
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
      echo "93.filetype not ";
      header("Location:registerpage.php?profileerror=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
      }
      else
      {
        if (move_uploaded_file($_FILES["userprofile"]["tmp_name"], $target_file)) 
       {
        date_default_timezone_set("Asia/Calcutta");
        //$dates=date("Ymdhis");
        $uidext=$uid;
       rename("$target_file","userprofiles/$uidext");
       echo "103.The file ". basename( $_FILES["userprofile"]["name"]). " has been uploaded.";
       $query="insert into registration(firstname,lastname,email,phone,password,confirmpassword,gender,profile,userid) values('$fname','$lname','$email','$phone','$uppassword','$upcpassword','$gender','$uidext','$uid')";
       $result=mysqli_query($con,$query);
       if($result)
       {
         
         $_SESSION['firstname']=$fname;
             $_SESSION['lastname']=$lname;
             $_SESSION['email']=$email;
             $_SESSION['phone']=$phone;
            // $_SESSION['password']=$password;
             $_SESSION['gender']=$gender;
             $_SESSION['userid']=$uid;
             $_SESSION['profile']=$uidext;
             header("Location:head.php");

       }
       else
       {
        echo "113.insertion error";
      echo mysqli_error($con);
      //echo strlen($password);
      header("Location:registerpage.php?error=Error.");
       }
       }
       else 
       {
        echo "119.error in image upload";
      header("Location:registerpage.php?profileerror=Error in image uploading."); 
       }
      }
     }
    }
    else
    {
      //echo "127.file is not an image";
      //header("Location:head.php?profileerror=File is not an image.");
    }

             
           }
         }
         } 
        }
        }  
	  }
}

?>










