<?php
$server="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="eventmngsystem";

$connect=mysqli_connect($server,$dbUsername,$dbPassword,$dbName);

if (!$connect) {
    die("❌ Connection failed: " . mysqli_connect_error());
}