$(document).ready(function () {


    ////////_____________________________modifie le nom en majuscule
    $("#nom").on("keyup", function () {

        $(this).val($(this).val().toUpperCase());
    });


    ////////_________________________________passe la premiere lettre de prenom en majuscule et le reste en minuscule
    $("#prenom").on("keyup", function () {

        $(this).val($(this).val().charAt(0).toUpperCase() + $(this).val().substr(1).toLowerCase());

    });


    /////////////////////////////_____________reset les erreurs
    $("#reset").on('click', function () {

        // Efface le contenu de l'élément avec la classe 'erreur'
        $('.erreur').html('');


    });







    ///////////AJAX 


    $("#submit").on("click", function (e) {
        e.preventDefault();     //empeche la soumission du formulaire
        console.clear()
       $('.erreur').html(""); //enleve les messages d'erreurs




        const formulaire = $('#formulaire')                 ////recupere les element du formulaire
        const formDataArray = formulaire.serializeArray();  ///serialization du formulaire 

        // Convertir en objet JSON
        const formData = {};
        $.each(formDataArray, function (i, field) {
            formData[field.name] = field.value;
        });

        console.table(formData);
        




        ////////////////////requete ajax
        $.ajax({
            type: 'POST',
            url: 'proces.php',
            data: JSON.stringify(formData),
            contentType: 'application/json; charset=UTF-8', // Indiquer que nous envoyons du JSON
            dataType: 'json',
            success: function (response) {
                console.table(response);
                console.table(response.no_repeat);
                console.table(response.ok);
                console.table(response.nom)
                console.table(response.prenom);
                console.table(response.text);
                console.table(response.email);
                
                
                
                if(response.ok){
                    $('#resultat').html(`<span class='text-success'>${response.ok}</span>`);
                }
                if(response.no_repeat){
                    $('#resultat').html(response.no_repeat);
                    $('#resultat').addClass("text-danger");
                }

                if(response.nom){
                    $('#erreurNom').html(response.nom);
                    $('#erreurNom').addClass('text-danger');
                }

                if (response.prenom) {
                    $('#erreurPrenom').html(response.prenom);
                    $('#erreurPrenom').addClass('text-danger')
                }

                if(response.email){
                    $('#erreurMail').html(response.email);
                    $('#erreurMail').addClass("text-danger");  // Utilise addClass() pour ajouter la classe;
                }
                if(response.text){
                    $('#erreurText').html(response.text);
                    $('#erreurText').addClass('text-danger')
                }


            },


        })

    })












})