<?php
	session_start();
	//ob_start();
	include ("dbconnect.php");

	if ( isset($_SESSION['user'])!="" ) {
		header("Location: home.php");
		exit;
	}
	
	$error = false;
	
	if( isset($_POST['btn-login']) ) {	
		
	
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		
		if(empty($email)){
			$error = true;
			$emailError = "Te rog sa introduci adresa de e-mail.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Adresa de e-mail nu este corecta.";
		}
		
		if(empty($pass)){
			$error = true;
			$passError = "Te rog sa introduci parola.";
		}
		

		if (!$error) {
			
			$password = hash('sha256', $pass); 
		
			$res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
			$row=mysql_fetch_array($res);
			$count = mysql_num_rows($res); 
			
			if( $count == 1 && $row['userPass']==$password ) {
				$_SESSION['user'] = $row['userId'];
				$suc = "Conectare in curs! ";
				//header("Location: home.php");
			} else {
				$errMSG = "Nume sau parola gresita!";
			}
				
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GamesQuiz - Raspunde la intrebari din jocurile tale preferate</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />


<style>
body, html {
    height: 100%;
    margin: 0;
}

.bg {
    /* The image used */
    background-image: url("./img/bg.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
</head>
<body>


<div class="bg">
<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Conectare</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
			<?php
			if ( isset($suc) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-success">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $suc; ?>
				<meta http-equiv="refresh" content="5; url=home.php"/>
				<img src="loading.gif" height="42" width="42">
                </div>
            	</div>
                <?php
			}
			?>			
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Adresa de e-mail" value="<?php echo $email; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Parola" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
				<div class="g-recaptcha" data-sitekey="6LfKOB8UAAAAAKLTGKSusWzqaRLxz9-8Qk0RPEiD"></div>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login"><span class="glyphicon glyphicon-log-in"> Conectare</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
			<a  href="register.php" <button href="register.php" class="btn btn-block btn-warning" name="btn-signup"><span class="glyphicon glyphicon-check"> Inregistrare</button></a>
            </div>
        
        </div>
    </form>
    </div>	

</div>
</div>

</body>
</html>
<?php ob_end_flush(); ?>