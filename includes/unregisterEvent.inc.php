<?php
session_start();
require_once 'db.inc.php';

$userId=$_SESSION['id'] ?? null;
$eventId=$_POST['eventId'] ?? null;

if ($userId && eventId) {
    $sql = "DELETE FROM user_events WHERE id=? AND eventId=?;";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "is",$userId,$eventId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

mysqli_close($connect);
header("Location: ../eventisplay.php?eventId=Successfully Unregistered from ".$eventId);
exit();