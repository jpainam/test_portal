$(document).ready(function () {
    $("select[name='classes']").change(function () {
        removeRequiredFields([$("select[name='classes']")]);
        $.ajax({
            url: './manuelscolaire/ajax',
            dataType: 'json',
            type: 'POST',
            data: {
                action: 'chargerManuel',
                idclasse: $("select[name='classes']").val()
            },
            success: function (result) {
                $("#manuel-content").html(result[0]);
                $("select[name=enseignement]").html(result[1]);
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    });
    $("#ajout-manuel").on("click", function () {
        removeRequiredFields([$("select[name='classes']")]);
        if ($("select[name='classes']").val() === "") {
            addRequiredFields([$("select[name='classes']")]);
            alertWebix(__t("Veuillez choisir la classe"));
        } else {
            openAjoutForm();
        }
    });
    var ajout_dialog_buttons = {};
    ajout_dialog_buttons[__t("Ajouter")] = function () {
        ajoutManuel();
    };
    ajout_dialog_buttons[__t('Fermer')] = function () {
        $(this).dialog('close');
    };


    $("#ajout-manuel-dialog").dialog({
        autoOpen: false,
        height: 375,
        width: 350,
        modal: true,
        resizable: false,
        buttons: ajout_dialog_buttons
    });
    
    var edit_dialog_buttons = {};
    edit_dialog_buttons[__t("Modifier")] = function () {
        editManuel();
        $(this).dialog('close');
    };
    edit_dialog_buttons[__t('Fermer')] = function () {
        $(this).dialog('close');
    };
    $("#edit-manuel-dialog").dialog({
        autoOpen: false,
        height: 375,
        width: 350,
        modal: true,
        resizable: false,
        buttons: edit_dialog_buttons
        
    });
    if (!$.fn.DataTable.isDataTable("#tableManuel")) {
        $("#tableManuel").DataTable({
            bInfo: false,
            paging: false,
            columns: [
                null,
                null,
                {"width": "10%"},
                null,
                {"width": "7%"},
                {"width": "7%"}
            ]
        });
    }
});
function openAjoutForm() {
    $("input[name=titre]").val("");
    $("textarea[name=editeurs]").val("");
    $("textarea[name=auteurs]").val("");
    $("input[name=prix]").val("");
    $("#ajout-manuel-dialog").dialog("open");
}
function openEditForm(__idmanuel) {
    $.ajax({
        url: "./manuelscolaire/ajax",
        type: "POST",
        dataType: "json",
        data: {
            idmanuel: __idmanuel,
            action: "fetch_edit",
            idclasse: $("select[name='classes']").val()
        },
        success: function (result) {
            $("input[name=idmanuel]").val(__idmanuel);
            $("input[name=edit_titre]").val(result[0]);
            $("textarea[name=edit_editeurs]").val(result[1]);
            $("textarea[name=edit_auteurs]").val(result[2]);
            $("input[name=edit_prix]").val(result[3]);
            $("input[name=edit_edition]").val(result[4]);
            console.log(result[5]);
            $("select[name=edit_enseignement]").html(result[5]);
        },
        error: function (xhr) {
            alert(xhr.responseText);
        }
    });

    $("#edit-manuel-dialog").dialog("open");
}
function ajoutManuel() {
    removeRequiredFields([$("select[name='classes']")]);
    if ($("input[name=titre]").val() === "" || $("select[name=enseignement]").val() === "") {
        addRequiredFields([$("input[name=titre]"), $("select[name=enseignement]")]);
        alert(__t("Entrer les champs obligatoires (*)"));
        return;
    }
    $.ajax({
        url: "./manuelscolaire/ajax",
        type: "POST",
        dataType: "json",
        data: {
            action: "ajout",
            titre: $("input[name=titre]").val(),
            editeurs: $("textarea[name=editeurs]").val(),
            auteurs: $("textarea[name=auteurs]").val(),
            prix: $("input[name=prix]").val(),
            edition: $("input[name=edition]").val(),
            enseignement: $("select[name='enseignement']").val(),
            idclasse: $("select[name='classes']").val()
        },
        success: function (result) {
            $("#manuel-content").html(result[0]);
            $("input[name=titre]").val("");
            $("textarea[name=editeurs]").val("");
            $("textarea[name=auteurs]").val("");
            $("input[name=prix]").val("");
            $("input[name=edition]").val("");
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

function editManuel() {
    if ($("input[name=edit_titre]").val() === "") {
        return;
    }
    $.ajax({
        url: "./manuelscolaire/ajax",
        type: "POST",
        dataType: "json",
        data: {
            action: "submit_edit",
            idmanuel: $("input[name=idmanuel]").val(),
            titre: $("input[name=edit_titre]").val(),
            editeurs: $("textarea[name=edit_editeurs]").val(),
            auteurs: $("textarea[name=edit_auteurs]").val(),
            prix: $("input[name=edit_prix]").val(),
            edition: $("input[name=edit_edition]").val(),
            enseignement: $("select[name='edit_enseignement']").val(),
            idclasse: $("select[name='classes']").val()
        },
        success: function (result) {
            $("#manuel-content").html(result[0]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

function supprimerManuel(__idmanuel, __titre) {
    var ok = confirm(__t("Etes vous sûr de vouloir supprimer le manuel ") + __titre + " ?");
    if (ok) {
        $.ajax({
            url: "./manuelscolaire/delete",
            type: "POST",
            dataType: "json",
            data: {
                idmanuel: __idmanuel,
                idclasse: $("select[name='classes']").val()
            },
            success: function (result) {
                $("#manuel-content").html(result[0]);
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    }
}
function imprimer() {
    if ($("select[name=code_impression]").val() === "") {
        return;
    }

    var frm = $("<form>", {
        action: "./manuelscolaire/imprimer",
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
    })).appendTo("body");

    frm.submit();
}
