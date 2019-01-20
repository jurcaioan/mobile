<?php
	session_start();
	//ob_start();
	include ("dbconnect.php");

	if( !isset($_SESSION['user']) ) {
		header("Location: nologin.php");
		exit;
	}

	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
	$sql=mysql_query("SELECT * FROM `aGlobal` ORDER BY `anunt`  ASC");
	$anunt=mysql_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">LegendsQuiz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"></a></li>
            <li><a href="#"></a></li>
		
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
		    <li><a href="#"><span class="glyphicon glyphicon-ok"> Raspunsuri cor.
			<?php  include("total_points.php"); ?></a></li>
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Salut, <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">

	<div class="container">
    
    	<div class="page-header">
		<?php
			if ($anunt!=NULL) {
				
				?>
				<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <center> <strong><?php echo $anunt['anunt']; ?></center></strong>
</div>
                <?php
			}
			?>			
		
<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <center>Bun venit <strong><?php echo $userRow['userName']; ?></strong>!</center>
</div>
    	</div>
		
        <div class="row">

<!-- Modal -->










<?php
$sirSQL = "SELECT users.userId AS userId, userName, games.gameId AS gameId, points, date_of_point, gameName 
	FROM (points INNER JOIN users ON points.userId=users.userId) 
		INNER JOIN games ON points.gameId=games.gameId 
	WHERE users.userId=" . $_SESSION["user"];
$tabel = mysql_query($sirSQL);
$nr = mysql_num_rows($tabel);
if ($nr == 0)
	print "Nu aveti niciun punctaj salvat in baza de date! <br />";
else
{
	print '<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Istoric Jocuri</div>

	  <!-- Table -->
	  <table class="table">';
	  
	  print "<tr>";
	  print "<td>";
	  print "Joc";
	  print "</td>";
	  
	  print "<td>";
	  print "Puncte";
	  print "</td>";
	  
	  print "<td>";
	  print "Data";
	  print "</td>";
	  
	for ($i=1; $i<=$nr; $i++)
	{
		$rand = mysql_fetch_array($tabel);
		
		$userId = intval(trim($rand["userId"]));
		$userName = trim($rand["userName"]);
		$gameId = intval(trim($rand["gameId"]));
		$gameName = ucfirst(trim($rand["gameName"]));
		$points = intval(trim($rand["points"]));
		$date_of_point = trim($rand["date_of_point"]);
		
		print "<tr>";
		print "<td>";
		print $gameName;
		print "</td>";
		
		print "<td>";
		print $points;
		print "</td>";
		
		print "<td>";
		print $date_of_point;
		print "</td>";
		
		print "</tr>";
	}
	
	print '</table>
	</div>';
}

?>














		
		

     
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    
</body>
</html>
<?php ob_end_flush(); ?>