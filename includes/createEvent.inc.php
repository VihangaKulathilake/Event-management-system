<?php
session_start();

if(isset($_POST["submit"])){
    $eName=$_POST["eName"];
    $eDes=$_POST["description"];
    $eDate=$_POST["eDate"];
    $eTime=$_POST["eTime"];
    $location=$_POST["location"];
    $newFileName=null;
    $createrId=$_SESSION["id"];
    //$createdAt = date("Y-m-d H:i:s");

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    $inputsEmptyEvent=inputsEmptyEvent($eName,$eDes,$eDate,$eTime,$location);

    if($inputsEmptyEvent!==false){
        header("Location:../signUp.php?error=Inputs empty");
        exit();
    }

    if (isset($_FILES["coverImg"]) && $_FILES["coverImg"]["error"]!==4) {
        $coverImg=$_FILES["coverImg"];
        $fileName=$coverImg["name"];
        $fileTmpName=$coverImg["tmp_name"];
        $fileSize=$coverImg["size"];
        $fileError=$coverImg["error"];
        $fileType=$coverImg["type"];
        

        $fileExt=strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
        $allowed=["jpg","jpeg","png","gif"];

        if (in_array($fileExt,$allowed)) {
            if ($fileError===0) {
                if ($fileSize<=5*1024*1024) {
                $newFileName=uniqid("",true).".".$fileExt;
                $uploadPath="../coversuploads/";
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


    createEvents($connect,$eName,$eDes,$eDate,$eTime,$location,$newFileName,$createrId);

}else{
    header('Location:../signUp.php');
    exit();
}
