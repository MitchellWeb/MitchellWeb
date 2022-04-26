<?php
$validForm = "";

$name = "";
$desc = "";
$pres = "";
$date = "";
$time = "";

$nameErrorMsg = "";
$descErrorMsg = "";
$presErrorMsg = "";
$dateErrorMsg = "";
$timeErrorMsg = "";

if(isset($_POST['submit']))
{
    $validForm = true;

    $name = $_POST['event_name'];
    $desc = $_POST['event_description'];
    $pres = $_POST['event_presenter'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $date_insert = date("Y/m/d");
    $date_update = $date_insert;

    if($_POST['honeyot'] != 0){
        $validForm = false;
        echo "unable to submit form";
    }
    if($name == "")
    {
        $nameErrorMsg = "Name field Required";
        $validForm = false;
    }
    if($desc == "")
    {
        $descErrorMsg = "Description field Required";
        $validForm = false;
    }
    if($pres == "")
    {
        $presErrorMsg = "presenter field Required";
        $validForm = false;
    }
    if($date == "")
    {
        $dateErrorMsg = "Date field Required";
        $validForm = false;
    }
    if($time == "")
    {
        $timeErrorMsg = "Time field Required";
        $validForm = false;
    }
    if($validForm)
    {
        require '../Unit 6/connectPDO.php';
        $sql = "INSERT INTO wdv341_events (event_name,event_description,event_presenter, event_date,event_time, event_date_inserted, event_date_updated ) VALUES (:name, :desc, :pres, :date, :time, :inDate, :upDate)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':desc',$desc);
        $stmt->bindParam(':pres',$pres);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':time',$time);
        $stmt->bindParam(':inDate',$date_insert);
        $stmt->bindParam(':upDate',$date_update);
        

        $result = $stmt->execute();
    }
}






?>    
    
    
    
    
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Events Form</title>
    </head>

    <body>
         
        <?php
        if($validForm)
        {
            echo "Thank you, your form was submitted";
        }
        else{
        ?>
        <form action="eventsForm.php" method="post">
            <label for="event_name">Name</label>
            <input type="text" name="event_name" id="event_name" placeholder="Name" value = "<?php echo $name;?>">
            <span><?php echo $nameErrorMsg;?></span><br>

            <label for="event_description">Description</label>
            <input type="text" name="event_description" id="event_description" value = "<?php echo $desc;?>">
            <span><?php echo $descErrorMsg;?></span><br>

            <label for="event_presenter">Presenter</label>
            <input type="text" name="event_presenter" id="event_presenter" value = "<?php echo $pres;?>">
            <span><?php echo $presErrorMsg;?></span><br>

            <label for="event_date">Date</label>
            <input type="date" name="event_date" id="event_date" value = "<?php echo $date;?>">
            <span><?php echo $dateErrorMsg;?></span><br>

            <label for="event_time">Time</label>
            <input type="time" name="event_time" id="event_time" value = "<?php echo $time;?>">
            <span><?php echo $timeErrorMsg;?></span><br>

            <input style="display:none" type="text" name="honeypot" value = 0>

            <input type="submit" name="submit" id="submit"><br>
        </form>
        <?php
        }
        ?>
    </body>

    </html>