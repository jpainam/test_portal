$(document).ready(function () {
    $("select[name=comboClasses]").change(chargerNotation);
    $("select[name=comboPeriodes]").change(chargerNotation);
});


chargerNotation = function () {
    $.ajax({
        url: "./note/ajaxindex",
        type: "POST",
        dataType: "json",
        data: {
            action: "chargerNotation",
            idclasse: $("select[name=comboClasses]").val(),
            idperiode: $("select[name=comboPeriodes]").val()
        },
        success: function (result) {
            $("#notes-content").html(result[0]);
            $("#notes-non-saisies-content").html(result[1]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
};

function supprimerNotation(idnotation) {
    if (confirm(__t("Etes vous sur de vouloir supprimer ces notes?"))) {
        $("<form>", {
            action: "notation/delete/" + idnotation,
            method: "post"
        }).appendTo('body').submit();
    }
}

function editNotation(idnotation) {
    $("<form>", {
        action: "note/edit/" + idnotation,
        method: "post"
    }).appendTo('body').submit();
}

function impression(_id) {
    var frm = $("<form>", {
        action: "./note/imprimer",
        target: "_blank",
        method: "post"
    }).append($("<input>", {
        name: "code",
        type: "hidden",
        value: "0004"
    })).append($("<input>", {
        name: "idnotation",
        type: "hidden",
        value: _id
    })).appendTo("body");

    frm.submit();
}
function notifierNotation(_idnotation) {
    $.ajax({
        url: "./note/ajaxindex",
        type: "POST",
        dataType: "json",
        data: {
            action: "notifierNotation",
            idnotation: _idnotation,
            idclasse: $("select[name=comboClasses]").val(),
            idenseignement: $("select[name=comboEnseignements]").val(),
            idperiode: $("select[name=comboPeriodes]").val()
        },
        success: function (result) {
            $("#notes-content").html(result[0]);
            if (result[2]) {
                alertWebix(__t("Messages de notification envoy&eacute; avec succ&egrave;s"));
            } else {
                alertWebix(__t("Une erreur est survenue lors de l'envoie des notifications"));
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}