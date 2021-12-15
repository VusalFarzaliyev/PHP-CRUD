<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "crud";

$connect = mysqli_connect($servername, $username, $password, $database);
if(!$connect)
{
    echo "Elaqe yaradilmadi!";
}
$name = "";
$surname = "";
$update =false;
$id =0;

?>
