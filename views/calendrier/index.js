$(document).ready(function () {
    $('#periodefin, #periodedebut, input[name^=trimestredebut], input[name^=sequencedebut],' +
            'input[name^=trimestrefin], input[name^=sequencefin], #feriedate, ' +
            'input[id^=vacancedebut], input[id^=vacancefin], #examenfin, #examendebut').datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });

    $("input[name^=horairedebut], input[name^=xhorairedebut], input[name^=horairefin], input[name^=xhorairefin]").timepicker({
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

    $("#jourferie-dialog-form").dialog({
        autoOpen: false,
        height: 200,
        width: 350,
        modal: true,
        buttons: {
            Valider: function () {
                validerJourFeries();
                //$(this).dialog("close");
            },
            Fermer: function () {
                $(this).dialog("close");
            }
        }
    });

    $("#tableOperation").DataTable({
        "paging": false,
        "bInfo": false,
        "scrollCollapse": true,
        "scrollY": 300,
        "searching": false,
        "columns": [
            {"width": "15%"},
            null,
            {"width": "5%"}
        ]
    });
});

function validerForm(_calendrier) {
    $("input[name='actiontype']").val(_calendrier);
    $.ajax({
        url: "./calendrier/ajax",
        type: 'POST',
        dataType: 'json',
        data: $("form[name='calendrier']").serialize(),
        success: function (result) {
            $("#success_submit").html(result[0]);
            alertWebix(result[0]);
            if (result[1]) {
                if (_calendrier === "horaire") {
                    $("#horaire-content").html(result[1]);
                }
                if (_calendrier === "ajouterFerie" || _calendrier === "deleteferie") {
                    $("#ferie-content").html(result[1]);
                } else if (_calendrier === "vacance") {
                    $("#vacance-content").html(result[1]);
                } else if (_calendrier === "ajouterExamen" || _calendrier === "deleteExamen") {
                    $("#examen-content").html(result[1]);
                }
            }
        },
        error: function (xhr) {
            alert(xhr.responseText);
        }
    });
}
function deleteFerie(__idferie) {
    $.ajax({
        url: "./calendrier/ajaxferie",
        type: 'POST',
        dataType: 'json',
        data: {
            idferie: __idferie,
            actiontype: "deleteferie"
        },
        success: function (result) {
            $("#ferie-content").html(result[1]);
        },
        error: function (xhr) {
            alert(xhr.responseText);
        }
    });
}


function ajouterFeries() {
    $("#jourferie-dialog-form").dialog("open");
}
function validerJourFeries() {

    $.ajax({
        url: "./calendrier/ajaxferie",
        type: 'POST',
        dataType: 'json',
        data: {
            actiontype: "ajouterFerie",
            libelle: $("input[name=ferielibelle]").val(),
            dateferie: $("input[name=feriedate]").val()
        },
        success: function (result) {
            $("#ferie-content").html(result[1]);
             $("#success_submit").html(result[0]);
            $("input[name=ferielibelle]").val("");
            $("input[name=feriedate]").val("");
        },
        error: function (xhr) {
            alert(xhr.responseText);
        }
    });
}
function ajouterExamen() {
    $.ajax({
        url: "./calendrier/ajaxexamen",
        type: 'POST',
        dataType: 'json',
        data: {
            action: "ajouter",
            examen: $("input[name=examen]").val(),
            examendebut: $("input[name=examendebut]").val(),
            examenfin: $("input[name=examenfin]").val(),
            classes: $("select[name='classes[]']").val()
        },
        success: function (result) {
             $("#success_submit").html(result[0]);
             $("#examen-content").html(result[1]);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}
