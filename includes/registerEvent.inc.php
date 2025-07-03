<?php
session_start();
require_once 'db.inc.php';

$userId=$_SESSION['id'] ?? null;
$eventId=$_POST['eventId'] ?? null;

if ($userId && eventId) {
    $sql = "INSERT IGNORE INTO user_events (id, eventId) VALUES (?, ?);";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "is",$userId,$eventId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

mysqli_close($connect);
header("Location: ../eventisplay.php?eventId=Successfully Registered to ".$eventId);
exit();

