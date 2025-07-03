<?php
    include_once 'header.php';
?>

<?php
require_once 'includes/db.inc.php';

if (isset($_GET["query"])) {
    $search=trim($_GET["query"]);
    
    if (!empty($search)) {
        $searchTerm=$search;

        echo "<p><strong>Results for:</strong> <em>".htmlspecialchars($searchTerm);

        $sqlEvents="SELECT * FROM events WHERE eventName LIKE ? ;";
        $stmtEvents=mysqli_prepare($connect, $sqlEvents);
        mysqli_stmt_bind_param($stmtEvents,"s",$searchTerm);
        mysqli_stmt_execute($stmtEvents);
        $resultEvents=mysqli_stmt_get_result($stmtEvents);

        $sqlUsers="SELECT * FROM users WHERE firstName LIKE ? OR lastName LIKE ?;";
        $stmtUsers=mysqli_prepare($connect, $sqlUsers);
        mysqli_stmt_bind_param($stmtUsers,"ss",$searchTerm,$searchTerm);
        mysqli_stmt_execute($stmtUsers);
        $resultUsers=mysqli_stmt_get_result($stmtUsers);

        if (mysqli_num_rows($resultEvents)>0) {
            echo "<h2>Events</h2>";
            while ($row=mysqli_fetch_assoc($resultEvents)) {
                echo "<div><strong>Event:</strong>".htmlspecialchars($row["eventName"])."</div><br>";
            }
        }

        if (mysqli_num_rows($resultUsers)>0) {
            echo "<h2>Users</h2>";
            while ($row=mysqli_fetch_assoc($resultUsers)) {
                echo "<div><strong>Name:</strong>".htmlspecialchars($row["firstName"])." ".htmlspecialchars($row["lastName"])."</div><br>";
            }
        }

        if (mysqli_num_rows($resultEvents)===0 && mysqli_num_rows($resultUsers)===0) {
           echo "No results found";
        }
    }else {
        echo "Please enter a search term";
    }
}else {
    echo "<h2>No search term entered.</h2>";
}
?>

<?php
    include_once 'footer.php';
?>