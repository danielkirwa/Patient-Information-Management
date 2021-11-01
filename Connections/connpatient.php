<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connpatient = "localhost";
$database_connpatient = "patientdb";
$username_connpatient = "root";
$password_connpatient = "";
$connpatient = mysql_pconnect($hostname_connpatient, $username_connpatient, $password_connpatient) or trigger_error(mysql_error(),E_USER_ERROR); 
?>