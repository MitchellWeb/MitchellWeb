<?php
session_start();

if(isset($_SESSION['validUser']))
{
    $validUser = true;
    $UserName = $_SESSION['UserName'];
    //already signed on 
}
else
{
    //not signed on yet. display form

    $userName = "";
    $passWord = "";
    
    $validUser = false;

        if(isset($_POST['submit']))
        {
            $validUser = true;
            $UserName = $_POST['UserName'];
            $Password = $_POST['Password'];
            
            require '../Unit 6/connectPDO.php';

            $sql = "SELECT count(*) FROM event_user WHERE event_user_name = :user AND event_user_name = :pass";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':user', $UserName);
            $stmt->bindParam(':pass', $Password);

            $stmt->execute();
            
            $rowCount = $stmt->fetchColumn();

            if($rowCount >0)
            {
                $validUser = true;
                
                //set validUser session variable
                $_SESSION['validUser'] = true;
                $_SESSION['UserName'] = $UserName;
            }
            else{
                $validUser = false;
                echo "invalidUser";
            }

            
        }
}






?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>

    <body>
        <?php
        if(!$validUser){

        ?>
        <form action="login.php" method="post">
            <label for="UserName">UserName</label>
            <input type="text" name="UserName"><br>
            <label for="Password">Password</label>
            <input type="text" name="Password">
            <input type="submit" value="sign on" name="submit">
        </form>
        <?php
        }else{
        ?>

        <h1>Welcome Back:<?php echo $UserName;?></h1>
        <h1>Admin Options</h1>
        <p><a href="../Unit 12/inputEvent.php">Input Event</a></p>
        
        <?php 
        
        } 
        ?>
    </body>

    </html>