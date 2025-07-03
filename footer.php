    </div>
    <div class="footercontainer">
        <div class="footerleft">
            <p>Contact us</p>
            <a href="https://www.kln.ac.lk/"><img src="imgs\internet-browser-icon-free-png.webp" class="browserlogo" alt="browserlogo"></a>
            <p>Follow us</p>
            <div class="socialmedlogos">
                <a href="https://www.youtube.com/user/UniversityofKelaniya"><img src="imgs/youtube-logo-png-photo-0.png" class="ytlogo" alt="ytlogo"></a>
                <a href="https://web.facebook.com/universityofkelaniyasl?_rdc=1&_rdr#"><img src="imgs\facebook-icon-free-png (1).webp" class="fblogo" alt="fblogo"></a>
                <a href="https://www.instagram.com/ukelaniya?igsh=Nnd2Z20zeThpYXdm"><img src="imgs\ig.png" class="iglogo" alt="iglogo"></a>
            </div>
        </div>
        <div class="footermiddle">
            <img src="imgs\white logo .png" class="eventlogofooter" alt="eventlogofooter">
            <p>You are logged in as <a href="myProfile.php" class="footerproflink"><?php echo $_SESSION["firstName"]." ".$_SESSION["lastName"];?></a></p>
            <a href="includes/logout.inc.php" class="footerlogout">Logout</a>
        </div>
        <div class="footerright">
            <p>Get the mobile app</p>
            <img src="imgs\[CITYPNG.COM]Get It On Google Play & Download App Store Buttons - 1500x1500.png" alt="getstoreimg" class="getstoreimg">
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>