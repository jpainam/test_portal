var _idets;

$(document).ready(function () {
    if (!$.fn.DataTable.isDataTable("#tableEtablissement")) {
        $("#tableEtablissement").DataTable({
            bInfo: false,
            paging: false,
            columns: [
                {"width": "5%"},
                null,
                {"width": "7%"}
            ]
        });
    }
    $("#editets-dialog-form").dialog({
        autoOpen: false,
        height: 170,
        width: 375,
        modal: true,
        resizable: false,
        buttons: {
            "Ajouter": function () {
                editEtablissement();
                $(this).dialog("close");
            },
            Annuler: function () {
                $(this).dialog("close");
            }
        }
    });
});
function ajouterEts() {
    var frm = $("form[name=frmsaisieets]");
    removeRequiredFields([$("input[name=nouvelets]")]);
    if ($("input[name=nouvelets]").val() === "") {
        addRequiredFields([$("input[name=nouvelets]")]);
        alertWebix(__t("Veuillez saisir le nom du nouvel etablissement"));
        return;
    }
    frm.submit();
}

function openDialogEdit(_idetablissement) {
    _idets = _idetablissement;
    /**
     * Preremplir le contenu par le libelle precedent
     */
    $("input[name=libelle]").val($("input[name=desc" + _idetablissement + "]").val());
    $("#editets-dialog-form").dialog("open");
}
function editEtablissement() {
    $.ajax({
        url: "./ajaxsaisie",
        type: "POST",
        dataType: "json",
        data: {
            action: "editEtablissement",
            libelle: $("input[name=libelle]").val(),
            idets: _idets,
        },
        success: function (result) {
            $(".page").html(result[0]);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }

    });
}

function ajouterEtablissement() {
    var frm = $("form[name=frmNewEts]");
    frm.submit();
}