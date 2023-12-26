<?php 
$servername="localhost";
$username="root";
$password="";
$dbname="hidroelektrik";

$conn=new mysqli("$servername","$username","$password","$dbname");

if($conn){

}else{
    echo "Connection failed";
}


?>