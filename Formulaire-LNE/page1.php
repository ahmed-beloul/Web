<?php
    $serveur = "127.0.0.1";
    $dbname = "database";
    $user = "root";
    $pass = "";
    
    $datapoisoning = $_POST["datapoisoning"];
    $environnement = $_POST["environnement"];
    $collecte = $_POST["collecte"];
    $q1comm = $_POST["q1comm"];

    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sth = $dbco->prepare("
            DELETE FROM form");
        $sth->execute();
        

        //On insère les données reçues
        $sth = $dbco->prepare("
            INSERT INTO form(datapoisoning, environnement, collecte, q1comm)
            VALUES(:datapoisoning, :environnement, :collecte, :q1comm)");
        $sth->bindParam(':datapoisoning',$datapoisoning);
        $sth->bindParam(':environnement',$environnement);
        $sth->bindParam(':collecte',$collecte);
        $sth->bindParam(':q1comm',$q1comm);
        $sth->execute();
        
        //On renvoie l'utilisateur vers la page
        if($collecte=="oui")
            header("Location:page2.html");
        else
            header("Location:merci.html");
        
        
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>