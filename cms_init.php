<?php

$host="127.0.0.1";
$databasename="cms";
$user="root";
$password="";

$tblcms='tblcms';
$sid='sid';
$sname='sname';
$semail='semail';
$sphone='sphone';
$search='search';

$con = mysqli_connect($host,$user,$password,$databasename);
if(!$con){
    mysqli_connect_err();
} else{
    #echo "Connected";
}
?>