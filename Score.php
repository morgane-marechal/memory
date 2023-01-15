<?php
// --------------------connexion à PDO----------------------------

$dsn = 'mysql:host=localhost;dbname=memory;charset=utf8';
$user = 'root';
$password = '';
$bdd = new PDO($dsn,$user,$password);

try{
    $bdd=new PDO('mysql:host=localhost;dbname=memory;charset=utf8','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Echec de la connexion: ".$e->getmessage();
    exit;
}

// --------------------classe Score----------------------------


class Score{
    public $login_id;
    public $nb_card_return;
    public $total_card;
    public $score;


    function __construct( $login_id, $nb_card_return, $total_card) {
        $this->login_id = $login_id;
        $this->nb_card_return = $nb_card_return;
        $this->total_card = $total_card;
    }

    public function setScore($total_card, $nb_card_return){
       $start_score = $total_card*15;
       $minus_point = $nb_card_return;
       $total = $start_score - $minus_point;
       return $this->score = $total;
    }
    
    public function getTotalCard(){
        return $this -> total_card;
    }

    public function getcard_return(){
        return $this -> nb_card_return;
    }

    public function getScore(){
        return $this -> score;
    }

    public function getAllScore(){
        global $bdd;
        $allScore = $bdd -> prepare("SELECT * FROM score");
        $allScore -> execute();
        $result = $allScore->fetch(PDO::FETCH_ASSOC);
        echo var_dump($result);
        
    }

    public function registerScore(){
        global $bdd;
        $newScore = $bdd->prepare("INSERT INTO score ( login_id, score, nb_card_return, total_card)
                 VALUES(?,?,?,?)");
               $newScore->execute(array($this->login_id,$this->score, $this->nb_card_return, $this->total_card));
               echo "Votre nouveau score a été enregistré !";
        }
    }






?>