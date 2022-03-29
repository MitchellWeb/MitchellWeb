<?php


include 'connectPDO.php'; //brings in connectPDO.php

$sql = "SELECT event_name,event_description FROM wdv341_events";

$stmt = $conn->prepare($sql);

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

while( $row=$stmt->fetch())
{
    echo "<p>";
        echo "<span>";
        echo $row['event_name'];
        echo "</span>";
        echo "<span>";
        echo $row['event_description'];
        echo "</span>";
    echo "</p>";
}

?>

<style>

    span
    {
        margin-right: 10px;
    }

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Events</title>
</head>
<body>
    
</body>
</html>