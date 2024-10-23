<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Formulaire de Contact</title>
</head>

<body >





    <!-- _____________________________________formulaire -->

    <div class="container bg-dark text-white p-3 rounded rounded-5 mt-5">
        <h4 class="text-center">Formulaire de Contact -PHP-POO</h4>


        <div id="resultat"></div>


        <form id="formulaire">

            <!------------------------------- nom -->
            <div>
                <p> </p>

                <label for="nom">Nom :</label>
                <span class="erreur" id="erreurNom"></span>
            </div>
            <div>
                <input type="text" name="nom" id="nom" class="w-100 p-1 rounded border-1" value="">
            </div>

            <!------------------------------- prenom -->
            <div>
                <label for="prenom">Prenom :</label>
                <span class="erreur" id="erreurPrenom"></span>
            </div>
            <div>
                <input type="text" name="prenom" id="prenom" class="w-100 p-1 rounded border-1" value="">
            </div>

            <!------------------------------- email -->
            <div>
                <label for="mail">Email :</label>
                <span class="erreur" id="erreurMail"></span>
            </div>
            <div>
                <input type="text" name="mail" id="mail" class="w-100 p-1 rounded border-1" value="">
            </div>

            <!------------------------------- message -->
            <div>
                <label for="message">Message :</label>
                <span class="erreur" id="erreurText"></span>
            </div>
            <div>
                <textarea name="message" id="message" class="w-100 p-1 rounded border-1"></textarea>
            </div>

            <!------------------------------- button -->
            <div>
                <input type="reset" name="reset" id="reset" value="Annuler" class="btn btn-danger">
                <input type="submit" name="submit" id="submit" value="Envoyer" class="btn btn-success">
            </div>
        </form>
    </div>






    
    <!-- ___________________________________________liste des contactes -->

    <?php
    require "contact.php";
    $contact = new Contact();
    $contact = $contact->affiche_tous();

    ?>

    <table class="table table-striped table-bordered  mt-5">
        <tr>
            <th class="text-center">ID CONTACT</th>
            <th class="text-center">NOM CONTACT</th>
            <th class="text-center">PRENOM CONTACT</th>
            <th class="text-center">Email</th>
            <th class="text-center">MESSAGE</th>
        </tr>
    
    <?php

    foreach($contact as $item)
    {
        echo "<tr>";
        echo "<td class='text-center'> $item[id_contact]</td>";
        echo "<td> $item[nom] </td>";
        echo "<td> $item[prenom] </td>";
        echo "<td> $item[email] </td>";
        echo "<td> $item[message] </td>";
        echo "</tr>";
    }
     ?>
</table>
 


    <script src="js/jQuery v3.7.1.js"></script>
    <script src="js/script.js"></script>
</body>

</html>