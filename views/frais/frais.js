var idfrais;

$(document).ready(function () {
    $("#fraisTable").DataTable({
        "bInfo": false,
        "scrollY": $(".page").height() - 100,
        "searching": false,
        "paging": false,
        "columns": [
            null,
            {"width": "15%"},
            {"width": "20%"},
            {"width": "10%"}
        ]
    });

    $("#comboClasses").change(chargerFrais);
    //Popup form
    $("#frais-dialog-form").dialog({
        autoOpen: false,
        height: 260,
        width: 375,
        modal: true,
        resizable: false,
        buttons: {
            "Ajouter": function () {
                ajoutFrais();
                $(this).dialog("close");
            },
            Annuler: function () {
                $(this).dialog("close");
            }
        }
    });
    $("#editfrais-dialog-form").dialog({
        autoOpen: false,
        height: 250,
        width: 350,
        modal: true,
        resizable: false,
        buttons: {
            "Modifier": function () {
                editFrais();
                $(this).dialog("close");
            },
            Annuler: function () {
                $(this).dialog("close");
            }
        }
    });
    $("#echeances, #editecheances").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });

    //Bouton pour le popup
    $("#img-ajout").on("click", function () {
        removeRequiredFields([$("#comboClasses")]);
        if ($("#comboClasses").val() === "") {
            alertWebix(__t("Veuillez choisir d'abord une classe"));
            addRequiredFields([$("#comboClasses")]);
            return;
        }
        $("input[name=description]").val("");
        $("input[name=montant]").val("");
        $("#frais-dialog-form").dialog("open");
    });


});

function ajoutFrais() {
    removeRequiredFields([$("#comboClasses")]);
    if ($("#comboClasses").val() === 0 || $("#comboClasses").val() === "") {
        alertWebix(__t("Veuillez choisir d'abord une classe"));
        addRequiredFields([$("#comboClasses")]);
        return;
    }
    $.ajax({
        url: "./ajax/ajouter",
        type: "POST",
        dataType: "json",
        data: {
            "idclasse": $("#comboClasses").val(),
            "description": $("input[name=description]").val(),
            "montant": $("input[name=montant]").val(),
            "echeances": $("input[name=echeances]").val(),
            obligatoire: $("input[name=obligatoire]").prop('checked'),
             codefrais: $("select[name=codefrais]").val()
        },
        success: function (result) {
            $("#frais-content").html(result[0]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
function supprimerFrais(_id) {
    $.ajax({
        url: "./ajax/supprimer",
        type: "POST",
        dataType: "json",
        data: {
            "idfrais": _id,
            "idclasse": $("#comboClasses").val()
        },
        success: function (result) {
            $("#frais-content").html(result[0]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

/**
 * Charge la liste de scolarite pour une classe donnne dans la datatable
 * @returns {undefined}
 */
chargerFrais = function () {
    $.ajax({
        url: "./ajax/charger",
        type: "POST",
        dataType: "json",
        data: {
            "idclasse": $("#comboClasses").val()
        },
        success: function (result) {
            $("#frais-content").html(result[0]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
};

function openEditForm(_id) {
    /**
     * Copie des element precemdent ecrit dans le formulaire
     */
    $("input[name=editdescription]").val($("input[name=description" + _id + "]").val());
    $("input[name=editmontant]").val($("input[name=montant" + _id + "]").val());
    $("input[name=editecheances]").val($("input[name=echeances" + _id + "]").val());
    //console.log($("input[name=obligatoire" + _id + "]").val());
    //console.log(($("input[name=obligatoire" + _id + "]").val() == 1));
    $("input[name=editobligatoire]").prop('checked', ($("input[name=obligatoire" + _id + "]").val() == 1));
    $("#editfrais-dialog-form").dialog("open");
    idfrais = _id;
}
/**
 * Function utilser lorsqu'on clique sur Ajouter du formulaire
 * edit frais
 */
function editFrais() {
    $.ajax({
        url: "./ajax/edit",
        type: "POST",
        dataType: "json",
        data: {
            "idfrais": idfrais,
            "idclasse": $("#comboClasses").val(),
            "description": $("input[name=editdescription]").val(),
            "montant": $("input[name=editmontant]").val(),
            "echeances": $("input[name=editecheances]").val(),
            codefrais: $("select[name=editcodefrais]").val(),
            obligatoire: $("input[name=editobligatoire]").prop('checked')
        },
        success: function (result) {
            $("#frais-content").html(result[0]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

function synchroniserDonnees(){
    $.ajax({
        url: "./synchroniser",
        data: {
            idclasse: $("select[name=comboClasses]").val()
        },
        dataType: "json",
        type: "POST",
        success: function(result){
            if(result[0]){
                alertWebix(__t("Synchronisation effectu&eacute;e avec succ&egrave;s"));
            }else{
                console.log("Une erreur s'est produite");
            }
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });
}