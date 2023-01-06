<?php

// --------------------connexion à PDO----------------------------

$dsn = 'mysql:host=localhost;dbname=memory;charset=utf8';
$user = 'root';
$password = '';
$bdd = new PDO($dsn,$user,$password);

try{
    $bdd=new PDO('mysql:host=localhost;dbname=memory;charset=utf8','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connexion OK";
}catch(PDOException $e){
    echo "Echec de la connexion: ".$e->getmessage();
    exit;
}


// --------------------Définition de la classe Card----------------------------

class Card{
    private $id;
    public $name, $faceon, $faceoff;

    function __construct($name, $faceon, $faceoff) {
        $this->name = $name;
         $this->faceon = $faceon;
         $this->faceoff = $faceoff;

     }

    public function getAllCards(){
        global $bdd;
        $allInfo = $bdd -> prepare("SELECT * FROM cartes ORDER BY RAND()  ");
        $allInfo -> execute();
        $result = $allInfo->fetchAll(PDO::FETCH_ASSOC);
        //echo var_dump($result);
        echo "<br>";
            for ($i = 0; $i <= 24; $i++) {
                echo "<div class='card'>".$result[$i]['face_on']."</div>";
            }
    }


}

echo "coucou <br>";
$test = new Card("cochon","url", "url");
//echo $test->getAllCards();

?>