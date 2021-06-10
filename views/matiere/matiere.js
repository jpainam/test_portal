$(document).ready(function(){
    
});

function soumettreMatiere(){
    var frm = $("form[name=saisiematiere]");
    if($("input[name=code]").val() === "" || $("input[name=libelle]").val() === ""){
        addRequiredFields([$("input[name=code]"), $("input[name=libelle]")]);
        alertWebix(__t("Veuillez remplir les champs obligatoires"));
        return;
    }
    frm.submit();
}