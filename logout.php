<?php
//ob_start();
if(!empty($_SESSION))
{

session_unset();
header("Location:head.php");
    
}
?>