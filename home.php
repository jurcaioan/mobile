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
<title>Bun Venit - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />


</style>
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
		  
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Salut, <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
				<li><a href="rezultate.php"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;rezultate</a></li>
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
<div class="modal fade" id="LoL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Start joc</h4>
      </div>
      <div class="modal-body">
			Vrei sa incepi jocul?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Nu</button>
		<a type="button" class="btn btn-primary" href="./LoL">Da</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Counter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Start joc</h4>
      </div>
      <div class="modal-body">
        Vrei sa incepi jocul?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Nu</button>
        	<a type="button" class="btn btn-primary" href="./CS-GO">Da</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Dota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Start joc</h4>
      </div>
      <div class="modal-body">
       Vrei sa incepi jocul?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Nu</button>
        <a type="button" class="btn btn-primary" href="./DOTA">Da</a>
      </div>
    </div>
  </div>
</div>		
		
		

        <div class="col-lg-12">
		<center><a data-toggle="modal" data-target="#LoL" href="#"><img src="http://orig14.deviantart.net/8ee1/f/2015/242/c/8/league_of_legends_honeycomb_icon_by_razzgraves-d97rqpj.png" align="left" alt="..." height="256" width="256" class="img-rounded"></a>
		<a data-toggle="modal" data-target="#Counter" href="#"><img src="http://orig14.deviantart.net/5f38/f/2014/040/b/4/counter_strike__global_offensive___flurry_icon_by_h3llb3rg-d75pu3k.png"  alt="..." height="256" width="250" class="img-rounded"></a>
		<a data-toggle="modal" data-target="#Dota" href="#"><img src="https://lh6.googleusercontent.com/-htEr_JpI_Zo/UKVpav4iqAI/AAAAAAAAC0c/BfqHBpOiJC0/s256/Dota-2.png" align="right" alt="..." height="256" width="256" class="img-rounded"></center></a>
        </div>
        </div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

   
</body>
</html>
<?php ob_end_flush(); ?>