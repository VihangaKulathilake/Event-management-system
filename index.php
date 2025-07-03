<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class="logincontainer">
        <form class="loginform" action="includes/login.inc.php" method="post">
            <h1>Login Here</h1>
            <input type="text" name="uname" id="uname" placeholder="Username/Email"><br><br>
            <input type="password" name="pwd" id="pwd" placeholder="Password"><br><br>
            <input class="loginbtn" type="submit" name="submit" value="Login"><br><br>
            <p>Don't have an account?,<a href="signUp.php">Sign up</a></p>
        </form>
            <div class="imglogin">
                <img class="loginimg" src="imgs\E.png" alt="logo">;
            </div>
</body>
</html>