<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar" aria-label="Main Navigation">
        <img src="imgs\Untitled_design-removebg-preview.png" alt="navbarImg" class="navbarImg">
        <button class="hmbicon">
            <img src="imgs\png-transparent-hamburger-menu-more-navigation-basic-ui-jumpicon-glyph-icon-removebg-preview.png" alt="hmbicnimg" class="hmbicnimg">
        </button>
        <ul class="navleft">
            <li><a href="home.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="myEvents.php">My Events</a></li>
        </ul>
        <ul class="navright">
            <li class="profile-img"><img src="uploads/<?php echo $_SESSION["profileImg"] ?? "default.png"; ?>" alt="profilePhoto" class="profilePhoto"></li>
            <li class="logout"><a href="includes/logout.inc.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">