<?php
    $serveur = "127.0.0.1";
    $dbname = "database";
    $user = "root";
    $pass = "";
    
    $test = $_POST["test"];
    

    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //On insère les données reçues
        $sth = $dbco->prepare("
            UPDATE form SET test = :test");
            // INSERT INTO form(test)
            // VALUES(:test)");
        $sth->bindParam(':test',$test);
        
        $sth->execute();
        
        //On renvoie l'utilisateur vers la page
        header("Location:merci.html");
        
        
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>