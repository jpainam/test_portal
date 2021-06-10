$(document).ready(function(){
    
});
function creer(){
    var $schoolyear = prompt(__t("Entrer la nouvelle année scolaire"));
    if($schoolyear !== ""){
        $.ajax({
            url: "./systeme/creer",
            type: "POST",
            dataType: "json",
            data: {
                schoolyear: $schoolyear
            },
            success: function(result){
                window.location.replace("./connexion");
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    }
}
function vider(){
    var $ok = confirm(__t("Etes vous sûr de vouloir vider les données de l'année encours?"));
    if($ok){
        $.ajax({
            url: "./systeme/vider",
            type: "POST",
            dataType: "json",
            
            success: function(result){
                alert(__t("Données vidées avec succès"));
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    }
}