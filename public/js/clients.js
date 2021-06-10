$(document).ready(function () {
    $("select[name=comboClasses]").change(chargerEleves);
});

var chargerEleves = function () {
    if ($("select[name=comboClasses]").val() === "") {
        return;
    }

    $.ajax({
        url: "./ajaximpression",
        type: "POST",
        dataType: "json",
        data: {
            action: "chargerEleves",
            idclasse: $("select[name=comboClasses]").val()
        },
        success: function (result) {
            $("select[name=comboEleves]").html(result[0]);
            $("select[name=debutinterval]").html(result[1]);
            $("select[name=fininterval]").html(result[1]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
};

function impression() {
    removeRequiredFields([$("select[name=comboClasses]"), $("select[name=comboPeriodes]")]);
    if ($("select[name=comboClasses]").val() === "" || $("select[name=comboPeriodes]").val() === "") {
        addRequiredFields([$("select[name=comboClasses]"), $("select[name=comboPeriodes]")]);
        alertWebix(__t("Veuillez remplir les champs obligatoires"));
        return;
    }
    var periode = $("select[name=comboPeriodes]").val();
    var codeperiode = periode.substring(0, 1);
    
    console.log(codeperiode);
    //Si c'est un bulletin annuelle, diriger vers le code 0002
    // pour les bulletin sequentielle et trimestrielle, code 0001
    if(codeperiode === "A"){
        $("input[name=code]").val("0002");
    }else{
        $("input[name=code]").val("0001");
    }
    var frm = $("form[name=frmbulletin]");
    frm.submit();

}
function synchroniserBulletins(){
    removeRequiredFields([$("select[name=comboClasses]"), $("select[name=comboPeriodes]")]);
    if ($("select[name=comboClasses]").val() === "" || $("select[name=comboPeriodes]").val() === "") {
        addRequiredFields([$("select[name=comboClasses]"), $("select[name=comboPeriodes]")]);
        alertWebix(__t("Veuillez remplir les champs obligatoires"));
        return;
    }
    $.ajax({
        url: "./synchroniser",
        type: "POST",
        dataType: "json",
        data: {
            comboPeriodes: $("select[name=comboPeriodes]").val(),
            comboClasses: $("select[name=comboClasses]").val(),
            comboEleves: $("select[name=comboEleves]").val()
        },
        success: function(result){
            alertWebix(__t("Bulletin synchroniser avec succ&egraves"));
            if(result[0]){
                
            }else{
                console.log("Une erreur s'est produite");
            }
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });
}