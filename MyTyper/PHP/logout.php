<?php
session_start();

if(isset($_SESSION['validUser']))
{
  session_unset();
  session_destroy();
  header("Location: ../pages/index.php");
    
}
else
{
    header("Location: ../pages/index.php");
}

?>