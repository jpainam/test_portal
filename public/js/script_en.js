var _array_lang = {};

$(document).ready(function () {
    var dHeight;
    if ($(".onglet").length !== 0) {
        dHeight = $(".page").height() - 140;
    } else {
        dHeight = $(".page").height() - 100;
    }
    $.extend($.fn.dataTable.defaults, {
        "aaSorting": [],
        "scrollCollapse": false,
        "pageLength": 200,
        "paging": true,
          "scrollY": dHeight,
        "searching": true,
        "bInfo": true,
        //"dom": '<"tableWrapper"fl>',
        "jQueryUI": true,
        "language": {

            "oPaginate": {

            },
            "oAria": {

            }
        }
    });
    _array_lang = {
        "Etes-vous certain de vouloir supprimer cet entree" : "Are you sure you want to delete this?",
        "Suppression d'une ligne" : "Deleting a line",
        "Veuillez saisir le nom du nouvel etablissement" : "Kindly type the name of the new school",
        "Les informations de la classe doivent d'abord être renseignées" : "Type the class information first",
        "Etes-vous certain de vouloir annuler cette saisie ?\n Toutes les modifications seront perdues" : "Are you sure you want to cancel all your typing?\n You will loose all the modifications",
        'Eleve non inscrit<br/>Le solde de cet eleve est debiteur de ' : "Cannot register the student<br/>Negative balance of ",
        " dans l'annee precedente " : " in the last year",
        "Veuillez d'abord choisir une classe" : "Choose a class first",
        "Messages de rappel envoy&eacute; avec succ&egrave;s" : "Recall messages sent successfully",
        "Erreur lors de l'envoi des messages de rappel" : "Error sending recall messages",
        "Emplois du temps synchroniser avec succ&egrave;s!!!": "Timetable sync successfully",
        "Erreur de synchronisation" : "Error synching",
        "Manuels scolaires synchronis&eacute;s avec succ&egrave;s!!!" : "School furnitures sync successfully",
        "Impossible d'inscrire cet eleve <br/>Eleve exclus en date du " : "Cannot register the student <br/> Student excluded on ",
        "Veuillez remplir les champs obligatoires": "Kindly filled required filled",
        "Veuillez sélectionner le fichier image" : "Kindly choose an image file",
        "Veuillez remplir les champs élève d'abord" : "Kindly fill the student fields first",
        "Valeur dupliquée\nEleves ayant ce nom et prénom existe déjà" : "Duplicate Value\n This student already exists",
        "Veuillez d'abord choisir un &eacute;l&egrave;ve" : "Kindly choose a student first",
        "Etes vous sur de vouloir supprimer la note en \n " : "Are you sure you want to delete this marks in \n",
        "El&egrave;ve synchronis&eacute; avec succ&egrave;s!!!" : "Student sync successfully",
        "Attention, cette action est irreversible" : "Attention, this action cannot be reverted",
        "Etes vous sur de vouloir supprimer cet eleve?" : "Are you sure you want to delete this student",
        "Veuillez choisir la date de d&eacute;but" : "Kindly choose a starting date",
        "Veuillez d'abord choisir un enseignant" : "Kindly choose a teacher first",
        "Veuillez choisir d'abord une classe" : "Kindly choose a class first",
        "Synchronisation effectu&eacute;e avec succ&egrave;s" : "Sync successfully",
        "Entrer les champs obligatoires (*)" : "Type the required fields",
        "Etes vous sûr de vouloir supprimer le manuel " : "Are you sure you want to delete this furnitures ",
        "Veuillez entrer une note > 0 et < 20" : "Kindly type mark between 0 and 20",
        "Etes vous sur de vouloir supprimer ces notes?" : "Are you sure you want to delete these marks",
        "Messages de notification envoy&eacute; avec succ&egrave;s" : "Notifications messages sent successfully",
        "Une erreur est survenue lors de l'envoie des notifications" : "Error happened during notification sending",
        "Veuillez choisir la periode en question" : "Kindly choose the period concerned",
        "Veuillez entrer une note >= 0 et <= 20" : "Kindly type mark between 0 and 20",
        "Veuillez d'abord remplir les champs obligatoires": "Kindly type the required fields",
        "Veuillez d'abord choisir une mati&egrave;re" : "Kindly choose the subject first",
        "Veuilez remplir tous les champs obligatoires" : "Kindly fill the required fields first",
        "Message envoy&eacute; avec succ&egrave;s!!!" : "Message successfully sent",
        "Pr&eacute;ciser le d&eacute;partement d'origine" : "Kindly type the department of origin",
        "Etes vous sur de vouloir effectuer cette suppression?" : "Are you sure you want to delete this entry?",
        "Notification envoyée avec succès" : "Notification successfully sent",
        "Etes vous sur de vouloir supprimer ce responsable" : "Are you sure you want to delete this entry?",
        "Veuillez choisir un parent d'élève" : "Kindly choose a student first",
        "Donnees mise a jour" : "Data synched",
        "Etes vous sur de vouloir supprimer cette sauvegarde" : "Are you sure you want to delete this backup ?",
        "Vous n'avez pas les droit de restaurer une sauvegarder\n Contactez l'administrateur" : "You don't have the right \n Contact the administrator",
        "Synchronisation effectuée avec succès" : "Successfully synched",
        "Veuillez choisir le profil a modifier" : "Kindly choose the profile to modify",
        "Remplir tous les champs obligatoires" : "Kindly type the required fileds first",
        "Veuillez certifier l'exactitude des donn&eacute;es saisies\n en votre nom en cochant la case certification" : "Kindly ascertain that the information you typed are accurate\n Certify in your name by sticking the checkbox",
        "Veuillez d'abord choisir une distribution" : "Kindly choose the right distribution",
        "Veuillez choisir la distribution" : "Kindly chooose the distribution first",
        "Echec d'envoi de notification" : "Error sending notification message",
        "Message envoy&eacute; avec succ&egraves;!!!"  : "Notification successfully sent",
        "Veuillez choisir la date de l'appel" : "Kindly choose the date of the call",
        "Veuillez choisir les dates de fin et debut" : "Kindly choose starting date and ending date",
        "La semaine doit commencer un jour Lundi" : "The week should start on Monday",
        "La semaine doit se terminer un vendredi" : "The week should end on Friday",
        "La semaine doit s'etendre sur 5 jours consecutives" : "Kindly choose 5 consecutives days",
        "Veuillez d'abord choisir les champs obligatoires" : "Kindly choose the required fields",
        "Cet appel a d&eacute;j&agrave; eu lieu \n Proc&eacute;der a l'&eacute;dition" : "A call has already been made on this date\n You should rather edit that",
        "Impossible de r&eacute;aliser un appel dans un jour non ouvrable" : "Cannot make a call during holidays as stated in the school calendar",
        "Notification envoy&eacute; avec succ&egraves;" : "Notification successfully sent",
        "Echec d'envoi de la notification" : "Failed to send the notification",
        "Veuillez d'abord choisir un &eacute;l&egrave;" : "Kindly choose a student first",
        "Veuillez choisir l'élève et la période" : "Kindly choose a student and a period",
        "Bulletin synchroniser avec succ&egraves" : "Report grade successfully synched",
        "Notifications envoy&eacute;es avec succ&egrave;s" :  "Notification successfully sent",
        "Erreur d'envoi de notification" : "Error in sending notification",
        "Veuillez choisir une classe et une matiere" : "Kindly choose a class and a subject",
        "Veuillez choisir la classe" : "Kindly choose a class",
        "Modifier" : "Edit",
        "Ajouter" : "Add",
        'Annuler' : "Cancel",
        "Fermer" : "Close",
        "Vider l'année scolaire de ses données" : "Truncate the current school year",
        "Etes vous sûr de vouloir vider les données de l'année encours?" : "Are you sure you want to truncate the data of the current school year?",
        "Données vidées avec succès" : "Data truncated successfully",
        "Veuillez recevoir les frais obligatoires \navant inscription en cochant les cases ci-dessus" : "Kindly make sure you have received all the required fees \n before any registration",
        "Veuillez d'abord choisir une classe" : "Kindly choose a class first",
    };
});
function __t(_key){
    if(_array_lang !== null){
        if(_key in _array_lang){
            return _array_lang[_key];
        }else{
            return _key;
        }
    }
    return _key;
}
function deleteRow(_url, name) {
    webix.modalbox({
        title: __t("Suppression d'une ligne"),
        buttons: ["Oui", "Non"],
        width: "300px",
        text: __t("Etes-vous certain de vouloir supprimer cet entree"),
        callback: function (result) {
            if (result == 0) {
                document.location = _url;
            }
        }
    });
}