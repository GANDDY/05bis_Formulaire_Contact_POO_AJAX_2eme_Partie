<?php



include_once "database.php";



class Contact
{

    private $nom;
    private $prenom;
    private $email;
    private $text;



//////__________________________________________function d'ajout de contact
    public function ajouter_contact($nom, $prenom, $email, $text)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->text = $text;


        $pdo = Database::connect();
        $sql = "INSERT into contact(nom, prenom, email, message) values (:nom, :prenom, :email, :text)";
        $reponse = $pdo->prepare($sql);
        $reponse->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $reponse->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $reponse->bindParam(':email', $this->email, PDO::PARAM_STR);
        $reponse->bindParam(':text', $this->text, PDO::PARAM_STR);
        $reponse->execute();
        Database::disconnect();
    }




////________________________methode de controle des champs de saisie des champs des formulaires
    public function control_form($nom, $prenom, $email, $text)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->text = $text;

        $regexString ="/^[A-Za-zÀ-ÖØ-öø-ÿ]+([-'\s][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/";
;

        $erreurs = array();


        if (!empty($this->nom) && !empty($this->prenom) && !empty($this->email) && !empty($this->text)) {

            if (!preg_match($regexString, $this->nom)) {

                $erreurs['nom'] = "Indiquez votre Nom";
                
                
            }
            if (!preg_match($regexString, $this->prenom)) {
                $erreurs['prenom'] = "Indiquez votre Prenom";
                
            }
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $erreurs['email'] = "Indiquer une adresse Email valide !!";
                
            }
            if (!empty($erreurs)) {
                // echo json_encode($erreurs);
                // return $erreurs;
            }
            
        } else {


            if (empty($this->nom)) {
                $erreurs['nom'] = "Vous devez saisir votre Nom";
                
            }
            if (empty($this->prenom)) {
                $erreurs['prenom'] = 'Vous devez saisir votre Prenom';
                
            }
            if (empty($this->email)) {
                $erreurs['email'] = 'Vous devez saisir un Email';
                
            }
            if (empty($this->text)) {
                $erreurs['text'] = 'Vous devez saisir un Message !!';
                
            }
            if (!empty($erreurs)) {
                // echo json_encode($erreurs);
                // return $erreurs;
            }
        }
        return $erreurs;
    }




///__________________methode controle des doublons
    public function ctrl_dble($nom, $prenom, $email, $text)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->text = $text;

        $envoi = array();

        $pdo = Database::connect();
        $sql = 'SELECT * FROM contact WHERE nom = :nom AND prenom = :prenom AND email = :email AND message = :text ';
        $reponse = $pdo->prepare($sql);
        $reponse->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $reponse->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $reponse->bindParam(':email', $this->email, PDO::PARAM_STR);
        $reponse->bindParam(':text', $this->text, PDO::PARAM_STR);
        $reponse->execute();
        $user = $reponse->fetch();

        if($user){
            $envoi['no_repeat'] = "ce message a deja été envoyé";
            echo json_encode($envoi);
        }

        Database::disconnect();
        return $envoi;
    }






////affiche la base de donner sur la page html
    public function affiche_tous()
    {
        $pdo = Database::connect();
        $contact = array();
        $sql = "SELECT * FROM contact";

        foreach($pdo->query($sql) as $row)
        {
            $contact[] = $row;
        }
        return $contact;
        Database::disconnect();
    }

}
