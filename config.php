<?php
$con = new mysqli("localhost","root","","logindb");
 
if($con->connect_error){
    die (" connection was failed".$con->connect_error);
}
