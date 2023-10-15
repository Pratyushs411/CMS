<?php
$connect = mysqli_connect('localhost','cms','pratyush','admin');
if(mysqli_connect_errno()){
    exit('failed to connect to MySql:' . mysqli_connect_error());
}
