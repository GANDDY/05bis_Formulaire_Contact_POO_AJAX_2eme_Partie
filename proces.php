<?php
header('Content-Type: application/json'); // Indique que le serveur renvoie du JSON

require_once "contact.php";




    //////////_________________________________________________________________ajouter les donner la BDD
// Fonction qui supprime les espaces en début et fin de chaîne, supprime les antislashes, convertit les
// caractères spéciaux en entités HTML 

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    // $data = htmlentities($data);
    $data = htmlspecialchars($data);
    return $data;
}



// Récupérer les données JSON envoyées
$donnees = json_decode(file_get_contents('php://input'), true);

$nom = $donnees['nom'];
$prenom = $donnees['prenom'];
$email = $donnees['mail'];
$text = $donnees['message'];




// Création de l'objet $contact pour accéder aux méthodes utilitaires de la classe Stagiaire

$contact = new Contact();


if (isset($nom) && isset($prenom) && isset($email) && isset($text)) {


    $erreurs = $contact->control_form($nom, $prenom, $email, $text);
    $envoi = $contact->ctrl_dble($nom, $prenom, $email, $text);



    if (!empty($erreurs)) {
        echo json_encode($erreurs);
    }





    if (empty($erreurs) && empty($envoi)) {
        $contact->ajouter_contact($nom, $prenom, $email, $text);
        $envoi['ok'] = "Données insérées avec succés !!!";
        echo json_encode($envoi);

    }
}





// header('Content-Type: application/json'); // Indiquer que le contenu est au format JSON
// echo json_encode($response);


?>