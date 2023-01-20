<?php

require_once 'config.php';

try {
    $db = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}
?>
-->
<?php
/* The establish the db connection for the application */
// session_start();
$cid=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ("connection error") ;


function iud($query)
{
	global $dbhost, $dbuser, $dbpass, $dbname;
	$cid=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ("connection error") ;
	$result=mysqli_query($cid,$query);
	$n=mysqli_affected_rows($cid);
	mysqli_close($cid);
	return $n;
}

function select($query)
{
	global $dbhost, $dbuser, $dbpass, $dbname;
	$cid=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ("connection error") ;
	$result=mysqli_query($cid,$query);
	mysqli_close($cid);
	return $result;

}
