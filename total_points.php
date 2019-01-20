<?php
	include ("dbconnect.php");

	if(isset($_SESSION['user']) == false) 
	{
		print "0 puncte";
		return;
	}
	
	$sqlSQL = "SELECT SUM(points) AS total_points 
		FROM points 
		WHERE userId=" . $_SESSION['user'] . " LIMIT 0,1";
	$tabel = mysql_query($sqlSQL);
	$nr = mysql_num_rows($tabel);
	
	if ($nr > 0)
	{
		$rand = mysql_fetch_array($tabel);
		
		$total_points = intval(trim($rand["total_points"]));
		print $total_points ;
	}
	
?>
