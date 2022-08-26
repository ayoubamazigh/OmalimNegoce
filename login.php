<?php
	session_start();
	error_reporting(0);
	$error = '';
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
		header('location: dashboard.php');
		
	}else if(isset($_POST['username']) && isset($_POST['password']) ){
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'omalimnegoce';
		$connection = mysqli_connect($host, $username, $password);
	if(!$connection){
		echo 'Connection failed to the server :/';
	}else{
		$db = mysqli_select_db($connection, $database);
		if(!$db){
			echo 'Connection failed to the database :/';
		}else{
			
			$query = "SELECT * FROM Admin WHERE username = '$user' AND password = '$pass'";
			$result = mysqli_query($connection,$query);
			$num_rows = mysqli_num_rows($result);
			if($num_rows == 1){
				$_SESSION['username'] = $user;
				$_SESSION['password'] = $pass;
				header('location: dashboard.php');
			}else{
				$error = "<center style='margin-botoom: 1rem; color: red; font-size: 1.1rem; font-weight: 600;' >User ou Password est incorect!</center>";
			}
			
			
		}
	}
		
	}



	


?>









<!DOCTYPE HTML>        
	<html lang='fr'>
		<head>
			<title>omalimnegoce.com</title>
			<meta charset='utf-8' />
		</head>
            <link rel='icon' href='assest/img/favicon.png'>
            <link href="assest/css/bootstrap.css" rel="stylesheet" >
            <link href='assest/css/login-style.css' rel='stylesheet'>
            <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;800&display=swap" rel="stylesheet">
        	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet"> 
			<link rel="shortcut icon" href='assest/img/20210614_150512.png' />       
            
            <body>
            
                <form action="#" method="POST">
                    <div class=' my-login-container'>
                        <div class=' my-login-side-container'>
                            <center>
                                <div class='my-connexion'>panneau d'administration</div>
                            </center>
                            <div class='my-input-explainer' >Nom d'utilisateur:</div>
                            <div >
                                <input class='my-input' type="email" name='username' placeholder='tapez votre Nom utilisateur' required>
                            </div>
                            <div class='my-input-explainer' >Mot de passe:</div>
                            <div>
                                <input class='my-input' type="password" name='password' placeholder='tapez votre mot de passe' required>
							</div>
								<div>
                                <button type="submit" class="my-btn mb-3" >
                                    Connexion    
                                </button>
                            </div>
							<?php echo $error; ?>
                        <center>
							
       					</center>
							
						</div>
					</div>
				</form>
                    </body>
                </html>