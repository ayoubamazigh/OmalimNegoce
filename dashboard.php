<?php
    
    session_start();

        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $database = 'omalimnegoce';


    if(isset($_SESSION['username']) && isset($_SESSION['password'])){

        $connection = mysqli_connect($host, $user, $pass);
        
        if($connection){
            
            $db = mysqli_select_db($connection, $database);
            
            if($db){
                
                $query1 = "SELECT num_visitors FROM stats;";
                $result1 = mysqli_query($connection, $query1);
                $row1 = mysqli_fetch_array($result1);
                
                $query2 = "SELECT count(title) FROM article WHERE type = 'al';";
                $result2 = mysqli_query($connection, $query2);
                $row2 = mysqli_fetch_array($result2);
                
                $query3 = "SELECT count(title) FROM article WHERE type = 'in';";
                $result3 = mysqli_query($connection, $query3);
                $row3 = mysqli_fetch_array($result3);    
            }
        }       
    }else{
        header('location: login.php');
    }
?>

<!DOCTYPE HTML>

    <html lang='fr'>
        <head>
            <title>OMALIM-NEGOCE.com</title>
            <meta charset='utf-8' />
        </head>
            <link rel='icon' href='' >
            <link href="assest/css/bootstrap.css" rel="stylesheet" >
            <link href='assest/css/index-style.css' rel='stylesheet'>
            <link href='assest/css/dashboard-style.css' rel='stylesheet'>
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;800&display=swap" rel="stylesheet">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">        
        <body>
                   
            <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse justify-content-between navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand my-Brand" href="#">OMALIM NEGOCE sarl</a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">accueil</a>
                        </li>
			
                    </ul>
                    <form class="form-inline my-lg-0 ">
                        <a href="home.php?type=al"><input type="button" value="Aluminium Industriel" class="btn my-btn-brahim my-2 my-sm-0" ></a>
                        <a href="home.php?type=in"><input type="button" value='Inox Industriel' class="btn my-btn-brahim my-2 my-sm-0 " ></a>
                    </form>
                </div>
            </nav>
            
            <div class='admin-title' >
                PANNEAU D'ADMINISTRATION
            </div>
            <div class='admin-desc' >bonjour monsieur | Madame</div>
            <div class='container admin-dash '>
                <div class='row justify-content-between' >
                    <div class='col-lg-4 col-sm-12 col-xs-12 admin-box1 mb-1'>
                        <div class='admin-box-title'>Nombre de visiteurs</div>
                        <div class='admin-box-desc' ><?php echo $row1[0]; ?></div>
                    </div>
                    <div class='col-lg-4 col-sm-6 col-xs-12 admin-box2 mb-1'>
                        <div class='admin-box-title'>nombre d'article d'aluminium</div>
                        <div class='admin-box-desc' ><?php echo $row2[0]; ?></div>
                    </div>
                    <div class='col-lg-4 col-sm-6 col-xs-12 bg-dark admin-box3 mb-1'>
                        <div class='admin-box-title'>nombre d'article d'Inox</div>
                        <div class='admin-box-desc' ><?php echo $row3[0]; ?></div>
                    </div>
                </div>
            </div>
            
            <div class='separ mb-3'></div>
            
            <div class='container mb-4' >
                <div class='row' >
                    <div style="border: .4px solid black; box-shadow: 1px 1px 5px;" class='col-lg-4 col-md-4 col-sm-12 '>
                        <div style='margin-top: 7rem;' class='admin-delete-title '>
                            Supression des Articles
                        </div>
                        <form action="#" method="post">
                            <center><select name="my-delete-select" class='admin-select'>    
                                <?php

                                    

                                    $connection = mysqli_connect($host, $user, $pass);
                                
                                    if($connection){
                                        
                                        $db = mysqli_select_db($connection, $database);

                                        if($db){
                                            
                                            $query4 = "SELECT title FROM article;";
                                            $result4 = mysqli_query($connection, $query4);
                                            
                                            while($row4 = mysqli_fetch_array($result4)){
                                                echo "<option  value='$row4[0]' > $row4[0] </option>";
                                            }
                                        }
                                    }
                                ?>
                                    
                                <?php

                                    if(isset($_POST['my-delete-select'])){
                                        
                                        $selectdeletearticle = $_POST['my-delete-select'];
                    
                                        if(!empty($selectdeletearticle)){
                                            
                                            $connection = mysqli_connect($host, $user, $pass);

                                            if($connection){
                                                
                                                $db = mysqli_select_db($connection, $database);
                                                
                                                if($db){  
                                                    
                                                    $query = "DELETE FROM Article Where title = '$selectdeletearticle'";
                                                    $result = mysqli_query($connection, $query);
                            
                                                    if($result){
                                                        echo "<script>alert('Article supprime'); </script>";
                                                        header('Location: login.php');
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                                    
                                </select></center>                
                            <center><input class='btn btn-insert w-50 p-3 mt-2' type="submit" value="Supprimer" ></center>
                        </form>
                    </div>
                    
                    <div class='col-lg-7 col-md-7 col-sm-12 ' >
                        <form action='#' method="POST" enctype="multipart/form-data">            
                            <div style="border: .4px solid black; box-shadow: 1px 1px 5px" class="container">
                                <div class="popup">
                                    <center class='admin-delete-title mb-3' >Création d'un Article</center>
                                    <div class='row'>
                                        <div class='my-description col-lg-2 col-md-2 col-xs-12 ' >
                                            Image:
                                        </div>
                                        <div class='col-lg-9 col-md-9 col-xs-12 ' >
                                            <input class='my-image-uploader' type="file" name='my-image' >
                                        </div>
                                    </div>                
                                    <div class='row'>
                                        <div class='my-description col-lg-2 col-md-2 col-xs-12 ' >
                                        Titre:
                                        </div>
                                        <div class='col-lg-9 col-md-9 col-xs-12 ' >
                                            <input class="tttt" type='text' name="title" placeholder='titre du Article' >
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='my-description col-lg-2 col-md-2 col-xs-12 ' >
                                        Description:
                                        </div>
                                        <div class='my-description-input col-lg-9 col-md-9 col-xs-12 ' >
                                            <!--<input class="tttt" type='text' name="livre-description" placeholder='titre du livre' > -->
                                            <textarea class="my-descriptiontttt" name="text"></textarea>
                                        </div>
                                    </div>
                            
                                    <div class='row'>
                                        <div class='my-description col-lg-2 col-md-2 col-xs-12 ' >
                                            Type:
                                        </div>
                                        <div class='col-lg-9 col-md-9 col-xs-12 ' >
                                            <select class="tttt" class="text-text" name='type'  >
                                                <option value="al" >Aluminium</option>
                                                <option value="in" >Inox</option>
                                            </select>
                                        </div>
                                    </div>
                            
                                    <div class='row'>
                                        <div class='my-description col-lg-2 col-md-2 col-xs-12 ' >
                                            temps:
                                        </div>
                                        <div class='col-lg-9 col-md-9 col-xs-12 ' >
                                            <input class="tttt" type='text' name="temp" placeholder='Temp du realisation' >
                                        </div>
                                    </div>
                            
                                    <div class='row'>
                                        <div class='my-description col-lg-12 col-md-12 col-xs-12 ' >
                                            <center><input class="btn-insert btn  w-50 p-3 mt-2" type="submit" value="Ajouter"></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        <?php
            
            if(isset($_FILES['my-image']) && isset($_POST['title']) && isset($_POST['text']) && isset($_POST['type']) && isset($_POST['temp']) ){
                $title = $_POST['title'];
                $text = $_POST['text'];
                $type = $_POST['type'];
                $temp = $_POST['temp'];
                        
                if(!empty($title) && !empty($text) && !empty($type) && !empty($temp) ){
            
                    $imgname = $_FILES['my-image']['name'];
                    $imgsize = $_FILES['my-image']['size'];
                    $imgpath = $_FILES['my-image']['tmp_name'];
                    $imgerror = $_FILES['my-image']['error'];
                    
                    if($imgerror == 0){
                        
                        if($imgsize > 100000000){
                            echo "<script> alert('Image is to big!'); </script>";
                        }else{
                            
                            $imgextention = pathinfo($imgname, PATHINFO_EXTENSION);
                            $imgextention = strtolower($imgextention);
                            $allowed_exs = array('jpg','jpeg','png');
                            
                            if(in_array($imgextention, $allowed_exs)){
                                $newimgname = uniqid("IMG-", true) . "." . $imgextention;
                                $imguploadpath = "Uploaded/" . $newimgname;
                                move_uploaded_file($imgpath, $imguploadpath);
                                
                                $connection = mysqli_connect($host,$user, $pass);

                                if($connection){
                                    
                                    $db = mysqli_select_db($connection, $database);
                                    
                                    if($db){

                                        $query = "INSERT INTO Article values ('$title','$text','$temp','$type','$imguploadpath')";
                                        echo $query;
                                        $inserted = mysqli_query($connection, $query);
                                        if($inserted){
                                           echo "<script> alert('Article ajouter'); </script>";
                                            header('Location: dashboard.php');
                                        }else{
                                            echo "<script> alert('article n'a pas ajouté')</script>";
                                        }
                                    }
                                }    
                            }else{
                                echo "Must be of type jpg, jpeg, png";
                            }
                        }
                    }else{
                        echo "Unknown error: " . $imgerror;
                        header('Location: home.php');
                    }        
                }    
             }
        ?>
            
            <center>
                <a href='clear.php' >
                    <input type="button" value="logout" class='logout-btn m-3 w-25 bg-danger' />
                </a>
            </center>
            <div class="col-md-12 text-center text-dark copyrightbanner">
                Copyright OMALIM NEGOCE sarl © 2021. Tous les droits sont réservés.
            </div>
        </body>
</html>