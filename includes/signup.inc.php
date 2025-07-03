<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["submit"])){
    $fName=$_POST["firstName"];
    $lName=$_POST["lastName"];
    $uName=$_POST["username"];
    $eMail=$_POST["email"];
    $pwd=$_POST["pwrd"];
    $confPwrd=$_POST["confPwrd"];
    $newFileName=null;

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    $inputsEmpty=inputsEmptySignup($fName,$lName,$uName,$eMail,$pwd,$confPwrd);
    $pwrdMatch=pwdMatch($pwd,$confPwrd);
    $invUid=invalidUid($uName);
    $invMail=invalidMail($eMail);
    $uidExists=userExists($connect,$uName,$eMail);
    

    if($inputsEmpty!==false){
        header("Location:../signUp.php?error=Inputs empty");
        exit();
    }
    
    if($pwrdMatch!==false){
        header("Location:../signUp.php?error=Passwords not match");
        exit();
    }

    if($invUid!==false){
        header("Location:../signUp.php?error=Invalid Username");
        exit();
    }

    if($invMail!==false){
        header("Location:../signUp.php?error=Invalid Email");
        exit();
    }
    if($uidExists!==false){
        header("Location:../signUp.php?error=Usrname exists");
        exit();
    }

    if (isset($_FILES["profileImg"]) && $_FILES["profileImg"]["error"]!==4) {
        $profileImg=$_FILES["profileImg"];
        $fileName=$profileImg["name"];
        $fileTmpName=$profileImg["tmp_name"];
        $fileSize=$profileImg["size"];
        $fileError=$profileImg["error"];
        $fileType=$profileImg["type"];
        

        $fileExt=strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
        $allowed=["jpg","jpeg","png","gif"];

        if (in_array($fileExt,$allowed)) {
            if ($fileError===0) {
                if ($fileSize<=5*1024*1024) {
                $newFileName=uniqid("",true).".".$fileExt;
                $uploadPath="../uploads/";
                $fileDestination=$uploadPath.$newFileName;

                if(!is_dir($uploadPath)){
                    mkdir($uploadPath,0777,true);
                }

                move_uploaded_file($fileTmpName,$fileDestination);
                
            }else {
                header("Location:../signUp.php?error=File too large");
                exit();
            }

            }else {
                header("location: ../signUp.php?error=upload error");
                exit();
            }
        }else {
            header("Location:../signUp.php?error=Invalid file type");
            exit();
        }
    }


    userSignup($connect, $fName, $lName, $uName, $eMail, $pwd, $newFileName);

}else{
    header('Location:../signUp.php');
    exit();
}