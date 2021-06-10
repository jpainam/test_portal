$(document).ready(function () {

    $("select[name=comboClasses]").change(chargerEleves);
    
    $("#dateau, #datedu").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });


});

chargerEleves = function () {
    if ($("select[name=comboClasses]").val() === "") {
        //$("#onglet1, #onglet2, #onglet3, #onglet4, #onglet5").html("");
        return;
    }
    var datedebut = $("input[name='datedu']").val();
    var datefin = $("input[name='dateau']").val();


    removeRequiredFields([$("#dateau"), $("#datedu")]);
    if (datedebut === "" || datefin === "") {
        $("select[name=comboClasses]")[0].selectedIndex = 0;
        addRequiredFields([$("#dateau"), $("#datedu")]);
        alertWebix(__t("Veuillez choisir les dates de fin et debut"));
        return;
    }
    console.log(datedebut);
    var dd = datedebut.split("/");
    var day = dd[0], month = dd[1], year = dd[2];
    var date1 = new Date(year, month - 1, day);
    console.log(date1);
    if (date1.getDay() !== 1) {
        $("select[name=comboClasses]")[0].selectedIndex = 0;
        alertWebix(__t("La semaine doit commencer un jour Lundi"));
        return;
    }
    console.log(datefin);
    var df = datefin.split("/");
    var day = df[0], month = df[1], year = df[2]; 
    var date2 = new Date(year, month - 1, day);
    if (date2.getDay() !== 5) {
        $("select[name=comboClasses]")[0].selectedIndex = 0;
        alertWebix(__t("La semaine doit se terminer un vendredi"));
        return;
    }
    //Verifier qu'il ya une difference de 5 jours entre les deux date

    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    if (diffDays !== 4) {
        $("select[name=comboClasses]")[0].selectedIndex = 0;
        alertWebix(__t("La semaine doit s'etendre sur 5 jours consecutives"));
        return;
    }

    $.ajax({
        url: "./ajaxsemaine",
        type: "POST",
        dataType: "json",
        data: {
            idclasse: $("select[name=comboClasses]").val(),
            datedebut: datedebut,
            datefin: datefin,
            action: "chargerEleves"
        },
        success: function (result) {
            $("form[name=formAppel1]").html(result[0]);
            $("#tab1 span").html(" " + date1.getDate() + "/" + (date1.getMonth() + 1));

            date1.setDate(date1.getDate() + 1);
            $("form[name=formAppel2]").html(result[1]);
            $("#tab2 span").html(" " + date1.getDate() + "/" + (date1.getMonth() + 1));

            date1.setDate(date1.getDate() + 1);
            $("form[name=formAppel3]").html(result[2]);
            $("#tab3 span").html(" " + date1.getDate() + "/" + (date1.getMonth() + 1));

            date1.setDate(date1.getDate() + 1);
            $("form[name=formAppel4]").html(result[3]);
            $("#tab4 span").html(" " + date1.getDate() + "/" + (date1.getMonth() + 1));

            date1.setDate(date1.getDate() + 1);
            $("form[name=formAppel5]").html(result[4]);
            $("#tab5 span").html(" " + date1.getDate() + "/" + (date1.getMonth() + 1));
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
};
/**
 * 
 * @returns Empty
 */
function validerAppel() {

    removeRequiredFields([$("select[name=comboClasses]")]);
    if ($("select[name=comboClasses]").val() === "") {
        alertWebix(__t("Veuillez d'abord choisir une classe"));
        addRequiredFields([$("select[name=comboClasses]")]);
        return;
    }

    var id = $("li.courant").attr("id");
    var jour = id.substr(3, 1);
    //Obtenir le formulaire courant
    var frm = $("form[name=formAppel" + jour + "]");

    // Verifier si cet appel a deja eu lieu
    var deja = frm.find("input[name=deja]");
    if (deja.length !== 0) {
        alertWebix(__t("Cet appel a d&eacute;j&agrave; eu lieu \n Proc&eacute;der a l'&eacute;dition"));
        return;
    }

    // Verifier si c'est un jour ouvrable
    var free = frm.find("input[name=freedays]");
    if (free.length !== 0) {
        alertWebix(__t("Impossible de r&eacute;aliser un appel dans un jour non ouvrable"));
        return;
    }
    if (!$("input[name=certifier]").is(":checked")) {
        alertWebix(__t("Veuillez certifier l'exactitude des donn&eacute;es saisies\n en votre nom en cochant la case certification"));
        addRequiredFields([$(".navigation")]);
        return;
    }

    frm.append($("<input>", {
        name: "idclasse",
        value: $("select[name=comboClasses]").val(),
        type: "hidden"
    })).append($("<input>", {
        name: "action",
        value: "validerForm",
        type: "hidden"
    })).append($("<input>", {
        name: "datedebut",
        value: $("input[name='datedu']").val(),
        type: "hidden"
    }));

    $.ajax({
        url: "./ajaxsemaine",
        type: "POST",
        dataType: "json",
        data: frm.serialize(),
        success: function (result) {
            frm.html(result[0]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}


function choisir(elm) {
    $(elm).parent().removeClass("absent exclu retard");
    if ($(elm).val() === "A") {
        $(elm).parent().addClass('absent');
    } else if ($(elm).val() === "E") {
        $(elm).parent().addClass('exclu');
    } else if ($(elm).val() === "R") {
        $(elm).parent().addClass('retard');
    }
}
/**
 * Notification par SMS des absences journalieres
 * @param {type} _ideleve
 * @param {type} _idappel
 * @param {int} _jour le jour de la semaine, lundi = 1 ... vendredi = 5
 * @returns {void}
 */
function notifyDailyAbsence(_ideleve, _idappel, _jour) {

    var frm = $("form[name=formAppel" + _jour + "]");

    $.ajax({
        url: "./ajaxsemaine",
        type: "POST",
        dataType: "json",
        data: {
            action: "notifyDailyAbsence",
            ideleve: _ideleve,
            idappel: _idappel,
            idclasse: $("select[name=comboClasses]").val(),
            jour: _jour
        },
        success: function (result) {
            frm.html(result[0]);
            alertWebix(__t("Notification envoy&eacute; avec succ&egraves;"));
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
function imprimer() {
    if ($("select[name=code_impression]").val() === "") {
        return;
    }
    removeRequiredFields([$("#comboClasses"), $("#datedu"), $("#dateau")]);
    if ($("#comboClasses").val() === "" || $("input[name=datedu]").val() === "" || $("input[name=dateau]").val() === "") {
        addRequiredFields([$("#comboClasses"), $("#datedu"), $("#dateau")]);
        alertWebix(__t("Veuillez d'abord remplir les champs obligatoires"));
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
        name: "idclasse",
        type: "hidden",
        value: $("#comboClasses").val()
    })).append($("<input>", {
        name: "datedebut",
        type: "hidden",
        value: $("input[name='datedu']").val()
    })).append($("<input>", {
        name: "datefin",
        type: "hidden",
        value: $("input[name='dateau']").val()
    })).appendTo("body");
    frm.submit();
}