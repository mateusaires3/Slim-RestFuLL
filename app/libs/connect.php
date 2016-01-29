<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso Negado");

/* Function de conexão com PDO postgres */


function getConnection() {

try {

	$dbhost="localhost";
    $dbuser="root";
    $dbpass="8kd5h0";
    $dbname="slim";
    $connection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    	
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
return $connection;

    }

?>