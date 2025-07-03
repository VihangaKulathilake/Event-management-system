<?php
include_once 'header.php';
require_once 'includes/db.inc.php';

$eventId=$_GET["eventId"] ?? null;
$userId=$_SESSION["id"] ?? null;

if(!$eventId){
    echo "<p>No events selected.</p>";
    include_once 'footer.php';
    exit();
}

$sql = "SELECT * FROM events WHERE eventId=?;";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $eventId);
mysqli_stmt_execute($stmt);
$eventResults = mysqli_stmt_get_result($stmt);

echo '<div class="eventdetailspage">';

 if ($event=mysqli_fetch_assoc($eventResults)) {
        $coverImgPath = 'coversuploads/' . htmlspecialchars($event['coverImg'] ?? 'default.png');
        echo '<div class="eventFulldetails" style="background-image: url(\'' . $coverImgPath . '\');">';
        echo '<div class="overlay">';
        echo "<h1>".htmlspecialchars($event['eventName'])."</h1>";
        echo "<p><strong>Date:</strong> ".htmlspecialchars($event['eventDate'])."</p>";
        echo "<p><strong>Time:</strong> ".htmlspecialchars($event['eventTime'])."</p>";
        echo "<p><strong>Location:</strong> ".htmlspecialchars($event['location'])."</p>";
        echo "<p><strong>Description:</strong> ".htmlspecialchars($event['description'])."</p>";
        

        if ($userId) {
            $checkSql="SELECT * FROM user_events WHERE id=? AND eventId=?;";
            $checkStmt = mysqli_prepare($connect, $checkSql);
            mysqli_stmt_bind_param($checkStmt, "is",$userId,$eventId);
            mysqli_stmt_execute($checkStmt);
            $checkEventResults = mysqli_stmt_get_result($checkStmt);

            if (mysqli_num_rows($checkEventResults)>0) {
                echo '<form action="includes/unregisterEvent.inc.php" method="post">';
                echo '<input type="hidden" name="eventId" value="'.$eventId.'">';
                echo '<button type="submit" class="unreg">Unregister</button>';
                echo '</form>';
            }else{
                echo '<form action="includes/registerEvent.inc.php" method="post">';
                echo '<input type="hidden" name="eventId" value="'.$eventId.'">';
                echo '<button type="submit" class="reg">Register</button>';
                echo '</form>';
            }
            mysqli_stmt_close($checkStmt);
        }else{
            echo '<p>Please login to register this event.</p>';
        }
        echo "</div>";
        echo "</div>";
    echo "</div>";
    }else {
        echo "<p>Event not found.</p>";
    }

mysqli_stmt_close($stmt);
mysqli_close($connect);
include_once 'footer.php';
?>