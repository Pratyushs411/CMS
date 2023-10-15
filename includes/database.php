<?php
$connect = mysqli_connect('mysql.db.mdbgo.com','pratyushs_admin','Pratyush.1','pratyushs_cms');
if(mysqli_connect_errno()){
    exit('failed to connect to MySql:' . mysqli_connect_error());
}
