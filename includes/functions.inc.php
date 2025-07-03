<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

function inputsEmptySignup($fName,$lName,$uName,$eMail,$pwd,$confPwrd){
    $result;
    if(empty($fName) || empty($lName) || empty($uName) || empty($eMail)|| empty($pwd) || empty($confPwrd)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function invalidUid($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function invalidMail($eMail){
    $result;
    if(!filter_var($eMail,FILTER_VALIDATE_EMAIL)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function pwdMatch($pwd,$confPwrd){
    $result;
    if($pwd !== $confPwrd){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function userExists($connect,$uName,$eMail){
    $sql="SELECT * FROM users WHERE user=? OR email=?;";
    $stmt=mysqli_stmt_init($connect);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location:../signUp.php?error=statement failed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$uName,$eMail);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function userSignup($connect,$fName,$lName,$uName,$eMail,$pwd,$profileImgName){
    $sql="INSERT INTO users (firstName,lastName,user,email,pwrd,profileImg) VALUES (?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location:../signUp.php?error=statement failed");
        exit();
    }

    $hashedpwd=password_hash($pwd,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"ssssss",$fName,$lName,$uName,$eMail,$hashedpwd,$profileImgName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location:../signUp.php?error=none");
    exit();
}

function inputsEmptyLogin($username,$password){
    $result;
    if(empty($username) || empty($password)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function userLogin($connect,$username,$password){
    $userIDExists=userExists($connect,$username,$username);
    if($userIDExists===false){
        header('Location:../index.php?error=wronglogin');
        exit();
    }
    $pwdhashed=$userIDExists["pwrd"];
    $pwdCheck=password_verify($password,$pwdhashed);
        
    
    if($pwdCheck===false){
        header('Location:../index.php?error=wrongpassword');
        exit();
    }else if($pwdCheck===true){
        session_start();
        $_SESSION["user"]=$userIDExists["user"];
        $_SESSION["firstName"]=$userIDExists["firstName"];
        $_SESSION["lastName"]=$userIDExists["lastName"];
        $_SESSION["id"]=$userIDExists["id"];
        $_SESSION["profileImg"]=$userIDExists["profileImg"];
        header('Location:../home.php?error=none');
        exit();
    }
}

function inputsEmptyEvent($eName,$eDes,$eDate,$eTime,$location){
    $result;
    if(empty($eName) || empty($eDes) || empty($eDate) || empty($eTime)|| empty($location)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function createEvents($connect,$eName,$eDes,$eDate,$eTime,$location,$coverImgName,$createrId){
    $sql="INSERT INTO events (eventName,description,eventDate,eventTime,location,coverImg,createrId) VALUES (?,?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($connect);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location:../createEvent.php?error=statement failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssssssi",$eName,$eDes,$eDate,$eTime,$location,$coverImgName,$createrId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location:../createEvent.php?error=none");
    exit();
}