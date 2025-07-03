<?php
if(isset($_POST["submit"])){
    $username=$_POST["uname"];
    $password=$_POST["pwd"];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if(inputsEmptyLogin($username,$password)!==false){
        exit();
    }

    userLogin($connect,$username,$password);

}else{
    header('Location:../index.php');
}