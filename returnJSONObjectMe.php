<?php
$eventID = 1;

include '../Unit 6/connectPDO.php'; //brings in connectPDO.php

$sql = "SELECT event_name,event_description FROM wdv341_events WHERE event_id=:eventID";

$stmt = $conn->prepare($sql);

$stmt->bindParam(':eventID',$eventID);

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

$row = $stmt->fetch();

echo $row['event_name'];
echo $row['event_description'];



$eventObj = new stdClass();//connot echo a php object

//fill in properties
$eventObj->eventName = $row['event_name'];
$eventObj->eventDescription = $row['event_description'];
$eventJSON = json_encode($eventObj);
echo $eventJSON;
?>