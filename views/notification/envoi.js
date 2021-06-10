$(document).ready(function () {
    $("select[name='listDestinataire']").select2();
    $("select[name='listDestinataire']").change(function () {
        if ($("select[name='listDestinataire']").val() !== "") {
            $("input[name='destinataire']").val($("select[name='listDestinataire']").val());
        }
    });
});

function envoyerSMS() {
    var frm = $("form[name=frmenvoi]");
    removeRequiredFields([$("input[name=destinataire]"), $("textarea[name=message]")]);
    if ($("input[name=destinataire]").val() === "" || $("textarea[name=message]").val() === "") {

        addRequiredFields([$("input[name=destinataire]"), $("textarea[name=message]")]);
        alertWebix(__t("Veuilez remplir tous les champs obligatoires"));
        return;
    }
    //frm.submit();
    $.ajax({
        url: "./ajaxenvoi",
        data: {
            action: "envoiIndividuel",
            destinataire: $("input[name=destinataire]").val(),
            message: $("textarea[name=message]").val(),
            sujet: $("input[name=sujet]").val()
        },
        dataType: "json",
        type: "post",
        success: function (result) {
            alertWebix(__t("Message envoy&eacute; avec succ&egrave;s!!!"));
            $("input[name=destinataire]").val("");
            $("textarea[name=message]").val("");
            $("input[name=sujet]").val("");
            console.log(result);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}

function envoyerCollectif() {
    var frm = $("form[name=frmenvoi]");
    removeRequiredFields([$("select[name=collectif]"), $("textarea[name=messagecollectif]")]);
    if ($("select[name=collectif]").val() === "" || $("textarea[name=messagecollectif]").val() === "") {

        addRequiredFields([$("select[name=collectif]"), $("textarea[name=messagecollectif]")]);
        alertWebix(__t("Veuilez remplir tous les champs obligatoires"));
        return;
    }
    //frm.submit();
    $.ajax({
        url: "./ajaxenvoi",
        data: {
            action: "envoiCollectif",
            messagecollectif: $("textarea[name=messagecollectif]").val(),
            message: $("textarea[name=message]").val(),
            sujet: $("input[name=sujetcollectif]").val(),
            collectif: $("select[name=collectif]").val()
        },
        dataType: "json",
        type: "post",
        success: function (result) {
            alertWebix(__t("Message envoy&eacute; avec succ&egrave;s!!!"));
            $("textarea[name=messagecollectif]").val("");
            $("textarea[name=message]").val("");
            $("input[name=sujetcollectif]").val("");
            $("select[name=collectif]").val("");
            console.log(result);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}
function envoyerParclasse() {
    var frm = $("form[name=frmenvoi]");
    removeRequiredFields([$("select[name=parclasse]"), $("textarea[name=messageparclasse]")]);
    if ($("select[name=parclasse]").val() === "" || $("textarea[name=messageparclasse]").val() === "") {

        addRequiredFields([$("select[name=parclasse]"), $("textarea[name=messageparclasse]")]);
        alertWebix(__t("Veuilez remplir tous les champs obligatoires"));
        return;
    }
    //frm.submit();
    $.ajax({
        url: "./ajaxenvoi",
        data: {
            action: "envoiClasse",
            messageparclasse: $("textarea[name=messageparclasse]").val(),
            parclasse: $("select[name=parclasse]").val(),
            sujet: $("input[name=sujetparclasse]").val()
        },
        dataType: "json",
        type: "post",
        success: function (result) {
            alertWebix(__t("Message envoy&eacute; avec succ&egrave;s!!!"));
            $("textarea[name=messageparclasse]").val("");
            $("select[name=parclasse]").val("");
            $("input[name=sujetparclasse]").val("");
            console.log(result);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}