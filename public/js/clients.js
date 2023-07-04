$(document).ready(function () {
    $("select[name=comboComptes]").select2();
    $("select[name=comboClasses]").change(chargerComptes);
    $("select[name=comboComptes]").change(chargerPhoto);
});

var chargerComptes = function () {
    if ($("select[name=comboClasses]").val() === "") {
        return;
    }
    $.ajax({
        url: "./ajaxsaisie",
        type: "POST",
        dataType: "json",
        data: {
            idclasse: $("select[name=comboClasses]").val(),
            action: "chargerComptes"
        },
        success: function (result) {
            $("select[name=comboComptes]").html(result[0]);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });

};

var chargerPhoto = function () {
    removeRequiredFields([$("select[name=comboClasses]")]);

    if ($("select[name=comboJournals]").val() === "") {
        addRequiredFields([$("select[name=comboClasses]")]);
        alertWebix(__t("Veuillez d'abord choisir une classe"));
        return;
    }
    if ($("select[name=comboComptes]").val() === "") {
        $(".photo-eleve").attr("src", "");
        return;
    }

    $.ajax({
        url: "./ajaxsaisie",
        type: "POST",
        dataType: "json",
        data: {
            idcompte: $("select[name=comboComptes]").val(),
            action: "chargerPhoto",
            idclasse: $("select[name=comboClasses]").val()
        },
        success: function (result) {
            $(".photo-eleve").attr("src", result[0]);
            if(result[1] === true){
                $("input[name='must_pay_required_fees']").val(result[3]);
                $("#frais_obligatoires").html(result[2]);
                disableNouvelleSaisie(true);
            }else{
                disableNouvelleSaisie(false);
                $("#frais_obligatoires").html("");
                $("input[name='must_pay_required_fees']").val("");
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
};
function disableNouvelleSaisie($status){
    $("input[name=description]").prop("disabled", $status);
    $("input[name=reftransaction]").prop("disabled", $status);
    $("select[name=typetransaction]").prop("disabled", $status);
    $("input[name=montant]").prop("disabled", $status);
    $("input[name=bordereau]").prop("disabled", $status);
    $("input[name=echeance]").prop("disabled", $status);
    if($status === false){
        $("#info_obligatoire").hide();
    }else{
        $("#info_obligatoire").show();
    }
   
}

function ValiderCaisse() {
    if($("input[name='must_pay_required_fees']").val() !== ""){
        if($("input[name='fraisobligatoire[]']").length !== $("input[name='fraisobligatoire[]']:checked").length){
            alertWebix(__t("Veuillez recevoir les frais obligatoires \navant inscription en cochant les cases ci-dessus"));
           return;      
        }
    }
    var frm = $("form[name=frmcaisse]");
    removeRequiredFields([$("input[name=reftransaction]"), $("select[name=typetransaction]"),
        $("input[name=description]"), $("input[name=montant]"),
        $("select[name=comboClasses]"), $("select[name=comboComptes]")]);

    if ($("input[name=reftransaction]").val() === "" || $("select[name=typetransaction]").val() === "" ||
            $("input[name=description]").val() === "" || $("input[name=montant]").val() === ""
            || $("select[name=comboClasses]").val() === "" || $("select[name=comboComptes]").val() === "") {
        addRequiredFields([$("input[name=reftransaction]"), $("select[name=typetransaction]"),
            $("input[name=description]"), $("input[name=montant]"), $("select[name=comboClasses]"),
            $("select[name=comboComptes]")]);
        alertWebix("Veuillez remplir les champs obligatoires");
        return;
    }
    $("input[name=idcompte]").val($("select[name=comboComptes]").val());
    $("input[name=idclasse]").val($("select[name=comboClasses]").val());
    frm.submit();
}

function imprimer() {
    if ($("select[name=code_impression]").val() === "") {
        return;
    }
    removeRequiredFields([$("select[name=comboComptes]")]);
    if ($("select[name=comboComptes]").val() === "") {
        addRequiredFields([$("select[name=comboComptes]")]);
        $("select[name=code_impression]")[0].selectedIndex = 0;
        alertWebix("Veuillez d'abord choisir un compte");
        return;
    }
    var frm = $("<form>", {
        action: "./imprimer",
        target: "_blank",
        method: "post"
    }).append($("<input>", {
        name: "code",
        type: "hidden",
        value: $("select[name=code_impression]").val()
    })).append($("<input>", {
        name: "idcompte",
        type: "hidden",
        value: $("select[name=comboComptes]").val()
    })).appendTo("body");
    frm.submit();
}
