$(document).ready(function () {
    $("#ajout-emplois").on("click", function () {
        openAjoutForm();
    });
    $("#tableEmplois").DataTable({
        "bInfo": false,
        paging: false,
        scrollY: $(".page").height() - 150,
        "columns": [
            {"width": "10%"},
            {"width": "7%"},
            {"width": "7%"},
            null,
            null,
            {"width": "5%"}
        ]
    });
    $("#ajout-emplois-dialog").dialog({
        autoOpen: false,
        height: 270,
        width: 350,
        modal: true,
        resizable: false,
        buttons: {
            "Ajouter": function () {
                ajoutEmplois();
                //$(this).dialog("close");
            },
            Fermer: function () {
                $(this).dialog("close");
            }
        }
    });
    //On change de comboClasses
    $("#comboClasses").change(chargerEmplois);
});



function openAjoutForm() {
    removeRequiredFields([$("#comboClasses")]);
    if ($("#comboClasses").val() === "") {
        alertWebix(__t("Veuillez d'abord choisir une classe"));
        addRequiredFields([$("#comboClasses")]);
        return;
    }
    $("#ajout-emplois-dialog").dialog("open");
}

chargerEmplois = function () {
    $.ajax({
        url: "./ajaxsaisie/charger",
        dataType: "json",
        type: "POST",
        data: {
            "idclasse": $("#comboClasses").val()
        },
        success: function (result) {
            $("select[name=enseignement]").html(result[0]);
            $("#emplois-content").html(result[1]);
            $("#apercu-content").html(result[2]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
};

function ajoutEmplois() {
    $.ajax({
        url: "./ajaxsaisie/ajout",
        type: "POST",
        dataType: "json",
        data: {
            jour: $("select[name=jour]").val(),
            enseignement: $("select[name=enseignement]").val(),
            horairedebut: $("#horairedebut").val(),
            horairefin: $("#horairefin").val(),
            idclasse: $("#comboClasses").val()
        },
        success: function (result) {
            $("#emplois-content").html(result[1]);
            $("#apercu-content").html(result[2]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

function supprimerHoraire(idemplois){
    $.ajax({
        url: "./ajaxsaisie/supprimer",
        type: "POST",
        dataType: "json",
        data: {
            "idemplois": idemplois,
            "idclasse": $("#comboClasses").val()
        },
        success: function (result) {
            $("#emplois-content").html(result[1]);
            $("#apercu-content").html(result[2]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
function imprimer() {
    if ($("select[name=code_impression]").val() === "") {
        return;
    }
    removeRequiredFields([$("select[name=comboClasses]")]);
    if ($("select[name=comboClasses]").val() === "") {
        alertWebix(__t("Veuillez d'abord choisir une classe"));
        addRequiredFields([$("select[name=comboClasses]")]);
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
        name: "type_impression",
        type: "hidden",
        value: $("input[name=type_impression]:checked").val()
    })).append($("<input>", {
        name: "idclasse",
        type: "hidden",
        value: $("select[name=comboClasses]").val()
    })).appendTo("body");
    frm.submit();
}