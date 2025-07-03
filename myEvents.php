<?php
    include_once 'header.php';
    require_once 'includes/db.inc.php';

    $userId=$_SESSION["id"] ?? null;

    echo '<div class="myeventscontainer">';

    if ($userId===null) {
        echo "<p>Please log into view your events.</p>";
    }else {
        $sql = "SELECT e.eventId,e.eventName,e.description,e.eventDate,e.eventTime,e.location,e.coverImg FROM events e NATURAL JOIN user_events u WHERE u.id=?;";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $myRegResults = mysqli_stmt_get_result($stmt);

        echo "<h2>My Registered Events</h2>";

        if (mysqli_num_rows($myRegResults)>0) {

                echo '<button class="scrollbtnleft" onclick="scrollEvents(-300)"><img src="imgs\la.png" class="scrollbtnleftimg" alt="leftarrow"></button>';
            
            echo '<div class="myRegEvents">';
            while ($row=mysqli_fetch_assoc($myRegResults)) {
                echo '<a href="eventDisplay.php?eventId=' . urlencode($row['eventId']) . '" class="eventlink">';
                echo '<div class="myEventsDetails">';
                echo '<img src="coversuploads/' . htmlspecialchars($row['coverImg'] ?? 'default.png') . '" alt="cvrimg" class="cvrimg">';
                echo '<div class="myEventsDetailsText">';
                echo "<h2>".htmlspecialchars($row['eventName'])."</h2>";
                echo "<p><strong>Date:</strong> ".htmlspecialchars($row['eventDate'])."</p>";
                echo "</div>";
                echo "</div><br>";
                echo "</a>";
            }
            echo '</div>';
            
                echo '<button class="scrollbtnright" onclick="scrollEvents(300)"><img src="imgs\ra.png" class="scrollbtnrightimg" alt="right8arrow"></button>';
            

        } else {
        echo "<p>You have not registered for any events yet.</p>";
        }

        $sql = "SELECT e.eventId,e.eventName,e.description,e.eventDate,e.eventTime,e.location,e.coverImg FROM events e WHERE createrId=?;";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $myCreResults = mysqli_stmt_get_result($stmt);

        echo "<h2>My Created Events</h2>";

        if (mysqli_num_rows($myCreResults)>0) {

                echo '<button class="scrollbtnleft" onclick="scrollEvents(-300)"><img src="imgs\la.png" class="scrollbtnleftimg" alt="leftarrow"></button>';
            
            echo '<div class="myCreEvents">';
            while ($row=mysqli_fetch_assoc($myCreResults)) {
                echo '<a href="eventDisplay.php?eventId=' . urlencode($row['eventId']) . '" class="eventlink">';
                echo '<div class="myEventsDetails">';
                echo '<img src="coversuploads/' . htmlspecialchars($row['coverImg'] ?? 'default.png') . '" alt="cvrimg" class="cvrimg">';
                echo '<div class="myEventsDetailsText">';
                echo "<h2>".htmlspecialchars($row['eventName'])."</h2>";
                echo "<p><strong>Date:</strong> ".htmlspecialchars($row['eventDate'])."</p>";
                echo "</div>";
                echo "</div><br>";
                echo "</a>";
            }
            echo '</div>';
            
                echo '<button class="scrollbtnright" onclick="scrollEvents(300)"><img src="imgs\ra.png" class="scrollbtnrightimg" alt="right8arrow"></button>';
            

        } else {
        echo "<p>You have not crated any events yet.</p>";
        }

    mysqli_stmt_close($stmt);
    mysqli_close($connect); 
    }
    echo '</div>';
    echo '<a href="createEvent.php" class="createevent"><img src="imgs\R (2).png" class="plusicon"></a>';
?>

<?php
    include_once 'footer.php';
?>