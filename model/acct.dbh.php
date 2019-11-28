<?php
//PDO CONNECTION
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "login_system";
try
{
     $DB_conn = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}



//db_name:login_system
//db_table_name:users
// acct_id
// acct_userName
// acct_email
// acct_password
// acct_created
// acct_login_time
// acct_logout_time
// acct_token
// acct_status
?>
