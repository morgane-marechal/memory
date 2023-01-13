<?php

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
       $start_score = $total_card*10;
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

    public function registerScore(){
        global $bdd;
        $newScore = $bdd->prepare("INSERT INTO score ( login_id, score, nb_card_return, total_card)
                 VALUES(?,?,?,?)");
               $newScore->execute(array($this->login_id,$this->score, $this->nb_card_return, $this->total_card));
               echo "Votre nouveau score a été enregistré !";
               header('Location: http://localhost/memory/display-score.php'); // <- redirection vers la page connexion
               exit();
        }
    }






?>