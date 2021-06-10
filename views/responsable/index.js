$(document).ready(function () {
    $('select[name=responsable]').select2();
    $('select[name=responsable]').change(function () {
        if ($(this).val() === "") {
            return;
        }
        $.ajax({
            url: './responsable/ajaxindex',
            dataType: 'json',
            type: 'post',
            data: {
                idresponsable: $('select[name=responsable]').val(),
                action: 'detail'
            },
            success: function (result) {
                $('.page').html(result[0]);
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    });
});
function deleteResponsable(__idresponsable) {
    var $ok = confirm(__t("Etes vous sur de vouloir supprimer ce responsable"));
    if(!$ok){
        return;
    }
    $.ajax({
        url: './responsable/ajaxindex',
        dataType: 'json',
        type: 'post',
        data: {
            idresponsable: __idresponsable,
            action: 'delete'
        },
        success: function (result) {
            $("#responsable-content").html(result[0]);
        },
        error: function (xhr) {
            alert(xhr.responseText);
        }
    });
}
function synchroniserDonnees() {
    if ($("select[name=responsable]").val() === "") {
        alertWebix(__t("Veuillez choisir un parent d'élève"));
        return;
    }
    $.ajax({
        url: './responsable/ajaxindex',
        dataType: 'json',
        type: 'post',
        data: {
            idresponsable: $('select[name=responsable]').val(),
            action: 'sync'
        },
        success: function (result) {
            if (result[0] === 1) {
                alertWebix(__t("Donnees mise a jour"));
            } else if (result[0] === 2) {
                //alertWebix("Une erreur de mise a jour s'est produite");
                console.log(result[1]);
            }
        },
        error: function (xhr) {
            //alert(xhr.responseText);
            console.log(xhr.responseText);
        }
    });
}