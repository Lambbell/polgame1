<?php
include 'connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$con = OpenCon();
$uquery = 'UPDATE accounts SET influence = influence * .97';
$stmt = $con->prepare($uquery);
$stmt->execute();
$stmt->fetch();
$stmt->close();

$con = OpenCon();
$uquery = 'UPDATE accounts SET action = action + 5';
$stmt = $con->prepare($uquery);
$stmt->execute();
$stmt->fetch();
$stmt->close();

$con = OpenCon();
$uquery = 'UPDATE accounts SET recognitionbase = recognitionbase * .8';
$stmt = $con->prepare($uquery);
$stmt->execute();
$stmt->fetch();
$stmt->close();

$con = OpenCon();
$uquery = "UPDATE accounts SET action = action + 5 WHERE seat = 'gov'";
$stmt = $con->prepare($uquery);
$stmt->execute();
$stmt->fetch();
$stmt->close();