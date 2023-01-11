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


// --------------------Définition de la classe Card----------------------------

class Game{
    public $id;
    public $faceon;
    public $flip;

   public $faceoff= "<img src = 'images/back.jpg'/>";


    function __construct($id, $faceon) {
        $this->id= $id;
         $this->faceon = $faceon;
         $this->flip = false;
     }

     public function getId(){
        return $this->id;
      }

      public function getFaceOn(){
        return $this->faceon;
      }

      public function getFlip(){
        return $this->flip;
      }

      public function getFaceOff(){
        return $this->faceoff;
      }

      public function set_cover($faceoff) {
       return $this->faceon = $faceoff;
       }

       public function testFlip() {
          if($this->flip===false){
            return "la carte est sur false";
          }elseif($this->flip===true){
            return "la carte est sur true";
          }else{
            return "something else";
          }
        }

        public function isFlipped(){
          return $this->flip = true;
        }

        public function toggleFlip(){
         if($this->flip===false){
          return $this->flip = true;
         }elseif($this->flip===true){
          return $this->flip = false;
         }else{
          echo "ERROR";
         }
          
        }

       }

 
    // public function getAllCards(){
    //     global $bdd;
    //     $allInfo = $bdd -> prepare("SELECT * FROM cartes LIMIT 24 ;  ");
    //     $allInfo -> execute();
    //     $result = $allInfo->fetchAll(PDO::FETCH_ASSOC);
    //     shuffle($result);
    //     echo var_dump($result[3]);
    //     echo "<br>";
    //         for ($i = 0; $i <= 24; $i++) {
    //             echo "<div class='card'>".$result[$i]['face_on']."</div>";
    //         }
    // }




//echo $test->getAllCards();

?>