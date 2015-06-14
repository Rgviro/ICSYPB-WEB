<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_icsypbdb = "localhost:3306";
$database_icsypbdb = "icsypbdb";
$username_icsypbdb = "rafa";
$password_icsypbdb = "ICSYPB";
$icsypbdb = mysql_pconnect($hostname_icsypbdb, $username_icsypbdb, $password_icsypbdb) or trigger_error(mysql_error(),E_USER_ERROR); 
?>