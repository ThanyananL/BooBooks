<?php 

# server name
$sName = "localhost";
# user name
$uName = "boobooks_272";
# password
$pass = "il1Gy8xZf";

# database name
$db_name = "boobooks_272";

/**
creating database connection 
useing The PHP Data Objects (PDO)
**/
try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}