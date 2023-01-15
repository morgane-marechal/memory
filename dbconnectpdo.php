<?php
$dsn = 'mysql:host=localhost;dbname=memory;charset=utf8';
$user = 'root';
$password = '';
$bdd = new PDO($dsn,$user,$password);

try{
    $bdd=new PDO('mysql:host=localhost;dbname=memory;charset=utf8','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "La connection avec PDO fonctionne";
}catch(PDOException $e){
    echo "Echec de la connexion: ".$e->getmessage();
    exit;
}
?>