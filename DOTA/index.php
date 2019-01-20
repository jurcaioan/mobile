<?php
	session_start();
	//ob_start();
	include ("../dbconnect.php");
	
	if( !isset($_SESSION['user']) ) {
		header("Location: nologin.php");
		exit;
	}

	$res=mysql_query("SELECT * FROM users WHERE userId=" . $_SESSION['user']);
	$userRow=mysql_fetch_array($res);
	$sql=mysql_query("SELECT * FROM `aGlobal` ORDER BY `anunt` ASC");
	$anunt=mysql_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>
<!--Start navbar-->
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../home.php">LegendsQuiz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
		
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
		  
		 
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Salut, <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li><a href="../rezultate.php"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;rezultate</a></li>
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
<!--end navbar-->
	<div id="wrapper">

	<div class="container">
    <!--deader-->
    	<div class="page-header">
		<!--mesaj constant-->
<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <center><strong>[info lol]</strong></center>
</div>
    	</div>
		<!--end header-->
        

<?php
$currentGame = 3;

$contor = 0;
if (isset($_POST["contor"]))
	$contor = intval(trim($_POST["contor"]));

$sirSQL = "SELECT * FROM questions WHERE gameId=" . $currentGame;
$sirSQL .= " ORDER BY questionId LIMIT " . $contor . ",1";

$_SESSION["n"] = $contor;
if ($contor > 0)  // am un raspuns la o intrebare
{
	$raspuns = intval(trim($_POST["cbo_raspuns"]));
	$j = $contor - 1;
	$_SESSION["v_raspuns[$j]"] = $raspuns;
	
	// print "contor=" . $contor . " - raspuns=" . $raspuns . "<br />";
	// print "j=" . $j . " - v_raspuns[$j]=" . $_SESSION["v_raspuns[$j]"] . "<br />";
}
$contor++;

$tabel = mysql_query($sirSQL);
$nr = mysql_num_rows($tabel);
if($nr == 0)
{
	print "Felicitari ai ajuns la final.! <br /> ";
	
	print "Acest test a avut " . $_SESSION["n"] . " intrebari! <br />";
	$corecte = 0;
	for($i=0; $i <= $_SESSION["n"]-1; $i++)
	{
		$j = $i-1;
		// print "i=" . $i . " - v_questionId[$i]=" . $_SESSION["v_questionId[$i]"] . " - v_cor[$i]=" . $_SESSION["v_cor[$i]"] . " - v_raspuns[$i]=" . $_SESSION["v_raspuns[$i]"] . "<br />";
		
		if ($_SESSION["v_cor[$i]"] == $_SESSION["v_raspuns[$i]"])
			$corecte++;
	}
	print "<b>Punctajul dvs. este " . $corecte . "! </b><br />";
	
	// salvare punctaj in baza de date
	$sirSQL = "INSERT INTO points (pointId, userId, gameId, points, date_of_point, userIP) ";
	$sirSQL .= " VALUES(NULL, " . $_SESSION['user'] . ", " . $currentGame . ", " . $corecte . ", NOW(), '" . $_SERVER['REMOTE_ADDR'] . "')";
	
	$inserare = mysql_query($sirSQL);
	if ($inserare){
		print'Revenire la meniul principal<img src="../loading.gif" height="42" width="42">
		<meta http-equiv="refresh" content="10; url=../home.php"/>
				';
	print '</br></br><a  href="../home.php" <button type="button" class="btn btn-primary btn-lg btn-block">Meniu principal</button></a> </br><br /> <a  href="../rezultate.php" <button type="button" class="btn btn-default btn-lg btn-block">Istoric jocuri</button></a></div></br>';}
	else
		print "Eroare la salvarea punctajului in baza de date! <br />";
}
else
{
	/*
	for($i=0; $i <= $_SESSION["n"]; $i++)
	{
		$j = $i-1;
		print "i=" . $i . " - v_questionId[$i]=" . $_SESSION["v_questionId[$i]"] . " - v_cor[$i]=" . $_SESSION["v_cor[$i]"] . " - v_raspuns[$j]=" . $_SESSION["v_raspuns[$j]"] . "<br />";
	}
	*/
	
	for ($i=1; $i<=$nr; $i++)
	{
		$rand = mysql_fetch_array($tabel);
		
		$questionId = intval(trim($rand["questionId"]));
		$gameQuiz = trim($rand["gameQuiz"]);
		$gameAns1 = trim($rand["gameAns1"]);
		$gameAns2 = trim($rand["gameAns2"]);
		$gameAns3 = trim($rand["gameAns3"]);
		$gameAns4 = trim($rand["gameAns4"]);
		$gameAns5 = trim($rand["gameAns5"]);
		$gameCor = intval(trim($rand["gameCor"]));
		
		$n = $_SESSION["n"];
		$_SESSION["v_questionId[$n]"] = $questionId;
		$_SESSION["v_cor[$n]"] = $gameCor;
		
		    print '<div class="row">';
			print '<div class="bs-example" data-example-id="contextual-panels"> ';
			print '<div class="panel panel-primary"> <div class="panel-heading"> <h3 class="panel-title">Intrebari generale</h3> </div> <div class="panel-body">';
			print "<center>";
			print "<h2>" . $gameQuiz . "</h2>";
			print "</br>";
			
			print "<form action='index.php' name='forma' method='post'>";
			print "<ul class='list-group'>";
			if ($gameAns1 != "")
				print "<li class='list-group-item list-group-item-info'><b>" . $gameAns1 . "</b></li>";
			if ($gameAns2 != "")
				print "<li class='list-group-item list-group-item-warning'><b>" . $gameAns2 . "</b></li>";
			if ($gameAns3 != "")
				print "<li class='list-group-item list-group-item-info'><b>" . $gameAns3 . "</b></li>";
			if ($gameAns4 != "")
				print "<li class='list-group-item list-group-item-warning'><b>" . $gameAns4 . "</b></li>";
			if ($gameAns5 != "")
				print "<li class='list-group-item list-group-item-info'><b>" . $gameAns5 . "</b></li>";
			print "</ul>";
			print "Raspunsul dumneavoastra este: <br />";
			
			print "<select class='btn btn-default btn-lg dropdown-togglee' name='cbo_raspuns'>";
			print "<option value='0'>....</option>";
			if ($gameAns1 != "")
				print "<option value='1'> $gameAns1 </option>";
			if ($gameAns2 != "")
				print "<option value='2'> $gameAns2 </option>";
			if ($gameAns3 != "")
				print "<option value='3'> $gameAns3 </option>";
			if ($gameAns4 != "")
				print "<option value='4'> $gameAns4 </option>";
			if ($gameAns5 != "")
				print "<option value='5'> $gameAns5	</option>";
			print "</select><br />";
			
			print "<input type='hidden' name='contor' value='" . $contor . "'>";
			print "<input class='btn btn-success' type='submit' name='buton' value='Trimitere raspuns'>";
			print "</form>";
			print "</center>";
			print "</div></div>";
	}
}

?>		

	
    
    <script src="../assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    
</body>
</html>
<?php ob_end_flush(); ?>