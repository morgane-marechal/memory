<?php
$dsn = '';
$user = '';
$password = '';
$bdd = new PDO($dsn,$user,$password);

try{
    $bdd=new PDO('$dsn,$user,$password');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "La connection avec PDO fonctionne";
}catch(PDOException $e){
    echo "Echec de la connexion: ".$e->getmessage();
    exit;
}
?>
