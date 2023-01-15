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


// --------------------Définition de la classe User----------------------------

class User{
    private $id;
    public $login, $password, $email;

    function __construct($login, $password, $email) {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;

    }

    public function register(){
        global $bdd;
        $check_login = $bdd ->prepare("SELECT count(*) as count FROM utilisateurs where login = '$this->login'");
        $check_login->execute();
        $res = $check_login->fetch(PDO::FETCH_ASSOC);
        //echo var_dump($res);
        $count = intval($res['count']);
        if ($count>0){
        echo "<p>Ce login est déjà pris, veuillez en choisir un autre!</p>";
        }else{
                $newPeople = $bdd->prepare("INSERT INTO utilisateurs ( login, password, email)
                 VALUES(?,?,?)");
               $newPeople->execute(array($this->login,$this->password, $this->email));
               echo "Vous avez ajouté un nouvel utilisateur avec succès";
               header('Location: http://localhost/memory/connexion.php'); // <- redirection vers la page connexion
               exit();
        }
    }

    public function connect($login, $password){
        global $bdd;
        $this->password=$password;
        $this->login = $login;
        $check_login = $bdd ->prepare("SELECT count(*) as count FROM utilisateurs where login = '$this->login'");
        $check_login->execute();
        $res = $check_login->fetch(PDO::FETCH_ASSOC);
        //echo var_dump($res);
        $count = intval($res['count']);
        if($count!=0){
            echo "Bravo vous êtes connectés!
            <br> Si ce message s'affiche c'est que vous vous êtes connecté avec succès<br>";
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $this->email;
            echo "Voici vos identifiants de session: ".$_SESSION['login'].", ".$this->email."<br>";
            header('Location: http://localhost/memory/index.php'); // <- redirection vers la page connexion
            exit();

        }else{
            echo "Problème d'identifiant ou de mot de passe";
        }
    }

    public function delete(){
        global $bdd;
        $delete= $bdd ->prepare("DELETE from utilisateurs WHERE login = '$this->login'");
        $delete->execute();
        echo "<br>".$this->login." supprimé";
        session_destroy();
    }

    public function update($newlogin, $password, $email){
        global $bdd;
        $login=$_SESSION['login']; //<- la fonction update ne fonctionne qui si un utilisateur est connecté
        $this->password=$password;
        $this->login = $newlogin;
        $this->email = $email;
        $sqlupdate = $bdd -> prepare("UPDATE utilisateurs SET login = '$newlogin', password = '$password', email = '$email' WHERE login = '$login'");
        $sqlupdate->execute(array($this->login,$this->password, $this->email));
        echo "Vous avez mis à jout votre profil.<br>";
    }

    public function isConnected(){
        if (isset($_SESSION['login'])){
            echo "Quelqu'un est connecté à cette page. Il s'agit de ".$_SESSION['login']."<br>";
            global $isConnected;
            return $isConnected = TRUE;
        }
    }

    public function getAllInfos(){
        global $bdd;
        $allInfo = $bdd -> prepare("SELECT * FROM utilisateurs WHERE login = '$this->login'");
        $allInfo -> execute();
        $result = $allInfo->fetch(PDO::FETCH_ASSOC);
        echo var_dump($result);
        //tableau html -->
        echo "<table>
        <thead><tr><td>Id</td><td>Login</td><td>MP</td><td>Email</td><td>Prénom</td><td>Nom</td></tr></thead>
        <tbody><tr><td> ".$result['id']." </td><td>".$result['login']."</td><td>".$result['password']."</td><td>".$result['email']."</td><td>".$result['firstname']."</td><td>".$result['lastname']."</td></tr></tbody>
        </table>";
    }

    public function getLogin(){
        global $bdd;
        $allInfo = $bdd -> prepare("SELECT * FROM utilisateurs WHERE login = '$this->login'");
        $allInfo -> execute();
        $result = $allInfo->fetch(PDO::FETCH_ASSOC);
        return $result ['login'];
    }

    public function getId(){
        global $bdd;
        $allInfo = $bdd -> prepare("SELECT * FROM utilisateurs WHERE login = '$this->login'");
        $allInfo -> execute();
        $result = $allInfo->fetch(PDO::FETCH_ASSOC);
        return $result ['id'];
    }


    public function getEmail(){
        global $bdd;
        $allInfo = $bdd -> prepare("SELECT * FROM utilisateurs WHERE login = '$this->login'");
        $allInfo -> execute();
        $result = $allInfo->fetch(PDO::FETCH_ASSOC);
        return $result ['email'];
    }

}

// $test = new User("Fleur","bouture12", "bibi@gmail.com");
// $test ->register("Fleur","bouture12", "bibi@gmail.com");
//$test -> getAllInfos();
//echo $test -> register("Ala Dine","123XX", "aldino@gmail.com","Aladdin","Pshitt");
//echo $test -> connect("Aladdin Gredin", "supermotdepasse");
//echo $test -> update("Aladdin Gredin","supermotdepasse", "aldino@gmail.com","Aladdin","Pshitt")
?>