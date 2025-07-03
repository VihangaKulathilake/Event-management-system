<?php
include_once 'header.php';
?>

<div class="createeventcontainer">
        <form class="createeventform" action="includes/createEvent.inc.php" method="post" enctype="multipart/form-data">
            <h1>Create an Event</h1>
            <input type="text" name="eName" id="eName" placeholder="Event Name"><br><br>
            <input type="text" name="description" id="description" placeholder="Description"><br><br>
            <input type="Date" name="eDate" id="eDate" placeholder="Event Date"><br><br>
            <input type="text" name="eTime" id="eTime" placeholder="Event Time"><br><br>
            <input type="text" name="location" id="location" placeholder="Location"><br><br>
            <label for="coverImg" class="coverupload">Upload Cover Image</label>
            <input type="file" name="coverImg" id="coverImg" accept="image/*"><br><br>
            <input class="createeventbtn" type="submit" name="submit" value="Create Event">
        </form>
</div>

<?php
include_once 'footer.php';
?>