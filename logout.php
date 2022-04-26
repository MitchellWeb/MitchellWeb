<?php
session_start();

if(isset($_SESSION['validUser']))
{
  session_unset();
  session_destroy();
  header("Location: ../Unit 13/login.php");
    
}
else
{
    header("Location: ../Unit 13/login.php");
}

?>