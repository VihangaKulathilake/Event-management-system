<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class="signupcontainer">
        <form class="signupform" action="includes/signup.inc.php" method="post" enctype="multipart/form-data">
            <h1>Sign Up Here</h1>
            <input type="text" name="firstName" id="firstName" placeholder="First Name"><br><br>
            <input type="text" name="lastName" id="lastName" placeholder="Last Name"><br><br>
            <input type="text" name="email" id="email" placeholder="Email"><br><br>
            <input type="text" name="username" id="username" placeholder="Username"><br><br>
            <input type="password" name="pwrd" id="pwrd" placeholder="Password"><br><br>
            <input type="password" name="confPwrd" id="confPwd" placeholder="Confirm Password"><br><br>
            <label for="profileImg" class="left-label">Upload Profile Photo</label>
            <input type="file" name="profileImg" id="profileImg" accept="image/*"><br><br>
            <input class="signupbtn" type="submit" name="submit" value="Sign Up">
        </form>
</body>
</html>