<?php
    
    error_reporting(0);
   session_start();

    $html = <<<HTML
    
        <html lang='fr'>
            <head>
                <title>Booxchange.com</title>
                <meta charset='utf-8' />
            </head>
    
            <link rel='icon' href='assest/img/favicon.png'>
            <link href="assest/css/bootstrap.css" rel="stylesheet" >
            <link href='assest/css/login-style.css' rel='stylesheet'>
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">  
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">        
            
            <body>
                <form action="#" method="POST">
                            <div class=' my-login-container'>
                            <div class=' my-login-side-container'>
                                <center><div class='my-connexion'>Connexion</div></center>
                                <div class='my-input-explainer' >Nom D'etulisatuer:</div>
                                <div >
                                    <input class='my-input' type="text" name='username' placeholder='tapez votre nom detulisatuer' required>
                                </div>
                                <div class='my-input-explainer' >Mot de passe:</div>
                                <div >
                                    <input class='my-input' type="password" name='password' placeholder='tapez votre mot de passe' required>
                                </div
                                <div>
                                    <button type="submit" class="my-btn mb-3" >
                                        Connexion    
                                    </button>
                            </div>
                            <center>
        
        HTML;


 
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        header('Location: dashboard.php');
    }else if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
        $localhost = 'localhost';
        $user = 'root';
        $pass = '';
        $database = 'omalimnegoce';
        $connection = mysqli_connect($localhost,$user, $pass);
        $username = $_COOKIE['username'];
        $password = $_COOKIE['password'];
        
        if($connection){
            $db = mysqli_select_db($connection, $database);
                 
            if($db){
                $query = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1;";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($result);  
                try{
                    if($row['username'] == $username && $row['password'] == $password){
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        header('Location: home.php');
                    }else{
                        header('location: login.php');
                    }
                }catch(Exception $ex){
                        //echo $ex;
                }
            }
        }
        
    }else if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password)){
            $localhost = 'localhost';
            $user = 'root';
            $pass = '';
            $database = 'omalimnegoce';
            $connection = mysqli_connect($localhost,$user, $pass);

            if($connection){
                $db = mysqli_select_db($connection, $database);

                 if($db){
                    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password';";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($result);
                    $num_rows = mysqli_num_rows($result);
                        if($num_rows == 1){
                                $_SESSION['username'] = $username;
                                $_SESSION['password'] = $password;
                                header('Location: dashboard.php');
                        }else{
                            header('Location: login.php');
                        }
                    }
                }
            }
        }else{


    $html .= <<<HTML
         
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </body>
                </html>
    HTML;
        echo $html;
    }
?>