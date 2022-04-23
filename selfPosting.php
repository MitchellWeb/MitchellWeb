<?php
include '../Unit 6/connectPDO.php';


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>tsst</title>
        <style>
            input#honeypot{
                display: none;
            }
        </style>
    </head>

    <body><?php
    $result = 0;
    $honeypot = 0;
        if( isset($_POST['submit'])){
            if($_POST['honeypot'] !=0)
            {
                echo "honeypot was set";
            }
            else{
            $name = $_POST['event_name'];
            $desc = $_POST['event_description'];
            $sql = "INSERT INTO wdv341_events (event_name, event_description)VALUES (:name, :desc)";
            
            $stmt = $conn->prepare($sql);
            
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':desc',$desc);
            

            $result = $stmt->execute();
            

            if($result >0)
            {
                echo "Form has been successfully submitted";
            }
            else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            }
            
        }else{
            
        ?>
        <form action="selfPosting.php" id="form_one" name="form_one" method="post">
            <label for="event_name">Event Name</label>
            <input type="text" name="event_name" id="event_name">
            <label for="event_description">Event Description</label>
            <input type="text" name="event_description" id="event_description">
            <input type="text" name="honeypot" id="honeypot"value = 0>
            <input type="submit" value="submit" name="submit">
        </form>
        
        <?php

        }
        ?>
        
    </body>

    </html>