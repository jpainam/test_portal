$(document).ready(function () {
    $("#cahierTable").DataTable({
        bInfo: false,
        searching: false,
        paging: false,
        columns: [
            {"width": "10%"},
            {"width": "10%"},
            null,
            null,
            {"width": "5%"}
        ]
    });
    $("#comboClasses").change(function () {
        $.ajax({
            url: "./cahiertexte/ajaxindex",
            data: {
                action: "chargerEnseignement",
                idclasse: $("select[name=comboClasses]").val()
            },
            type: "post",
            dataType: "json",
            success: function (result) {
                $("select[name=comboEnseignement]").html(result[0]);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
    
    $("select[name=comboEnseignement]").change(function(){
        $.ajax({
           url: "./cahiertexte/ajaxindex",
           dataType: "json",
           type: "post",
           data: {
               action: "listercahier",
               enseignement:  $("select[name=comboEnseignement]").val(),
                idclasse: $("select[name=comboClasses]").val()
           },
           success: function(result){
               $("#cahier-content").html(result[0]);
           },
           error: function(xhr){
               console.log(xhr.responseText);
           }
        });
    });
    $("#img-ajout").click(function () {
         removeRequiredFields([$("#comboClasses"), $("select[name=comboEnseignement]")]);
        if ($("#comboClasses").val() === "" || $("select[name=comboEnseignement]").val() === "") {
            alertWebix(__t("Veuillez choisir une classe et une matiere"));
            addRequiredFields([$("#comboClasses"), $("select[name=comboEnseignement]")]);
            return;
        }
        $("#cahier-dialog-form").dialog("open");
    });
    $("#datesaisie").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });

    $("#heuredebut, #heurefin").timepicker({
        hourText: 'Heures',
        minuteText: 'Minutes',
        amPmText: ['AM', 'PM'],
        timeSeparator: 'h',
        nowButtonText: 'Maintenant',
        showNowButton: true,
        closeButtonText: 'Fermer',
        showCloseButton: true,
        deselectButtonText: 'Désélectionner',
        showDeselectButton: true
    });
    //Popup form
    $("#cahier-dialog-form").dialog({
        autoOpen: false,
        height: 360,
        width: 375,
        modal: true,
        resizable: false,
        buttons: {
            Valider: function () {
                ajoutCahier();

                //$(this).dialog("close");
            },
            Fermer: function () {
                $(this).dialog("close");
            }
        }
    });
    $("#editcahier-dialog-form").dialog({
        autoOpen: false,
        height: 250,
        width: 350,
        modal: true,
        resizable: false,
        buttons: {
            "Modifier": function () {
                editCahier();
                $(this).dialog("close");
            },
            Annuler: function () {
                $(this).dialog("close");
            }
        }
    });
});

function ajoutCahier() {
    $.ajax({
        url: "./cahiertexte/ajaxindex",
        data: {
            action: "ajouter",
            datesaisie: $("input[name=datesaisie]").val(),
            heuredebut: $("input[name=heuredebut]").val(),
            heurefin: $("input[name=heurefin]").val(),
            objectif: $("input[name=objectif]").val(),
            idclasse: $("select[name=comboClasses]").val(),
            enseignement: $("select[name=comboEnseignement]").val(),
            contenu: $("textarea[name=contenu]").val()
        },
        type: "post",
        dataType: "json",
        success: function (result) {
            $("#cahier-content").html(result[0]);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}
function editCahier() {

}

function deleteCahier(__idcahier){
     $.ajax({
        url: "./cahiertexte/ajaxindex",
        data: {
            action: "supprimer",
            idcahier: __idcahier,
             idclasse: $("select[name=comboClasses]").val(),
            enseignement: $("select[name=comboEnseignement]").val()
        },
        type: "post",
        dataType: "json",
        success: function (result) {
            $("#cahier-content").html(result[0]);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}

function imprimer() {
    if ($("select[name=code_impression]").val() === "") {
        return;
    }

    var frm = $("<form>", {
        action: "./cahiertexte/imprimer",
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
    })).append($("<input>", {
        name: "enseignement",
        type: "hidden",
        value: $("select[name=comboEnseignement]").val()
    })).appendTo("body");

    frm.submit();
}
