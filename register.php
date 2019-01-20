<?php
	ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['btn-signup']) ) {
		

		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		

		if (empty($name)) {
			$error = true;
			$nameError = "Username invalid!";
		} else if (strlen($name) < 2) {
			$error = true;
			$nameError = "Numele de utiliizator trebuie sa contina minim 2 caractere.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Numele de utilizator poate contine doar litere si spatiu.";
		}
		

		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Te rog introdu o adresa valida.";
		} else {

			$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$emailError = "Adresa de e-mail este deja utilizata";
			}
		}

		if (empty($pass)){
			$error = true;
			$passError = "Te rog introdu o parola.";
		} else if(strlen($pass) < 4) {
			$error = true;
			$passError = "Parola ta trebuie sa contina minim 4 caractere.";
		}
		

		$password = hash('sha256', $pass);
		

		if( !$error ) {
			
			$query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
			$res = mysql_query($query);
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Te-ai inregistrat cu succes! Acum te poti conecta";
				unset($name);
				unset($email);
				unset($pass);
			} else {
				$errTyp = "danger";
				$errMSG = "Ceva nu a mers bine... te rog sa incerci din nou";	
			}	
				
		}
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inregistrare</title>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Inregistrare</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Nume de utilizator" maxlength="50" value="<?php echo $name ?>" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Adresa de email" maxlength="40" value="<?php echo $email ?>" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Parola cont" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup"><span class="glyphicon glyphicon-check"> Inregistrare</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
			<a  href="index.php" <button href="index.php" class="btn btn-block btn-success" name="btn-signup"><span class="glyphicon glyphicon-log-in"> Conectare</button></a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>
</div>

</body>
</html>
<?php ob_end_flush(); ?>