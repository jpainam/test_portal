$(document).ready(function () {
    $("select[name=comboProfiles]").change(chargerDroits);

    if (!$.fn.DataTable.isDataTable("#tableusers")) {
        $("#tableusers").DataTable({
            bInfo: false,
            paging: false,
            columns: [
                {"width": "5%"},
                null,
                {"width": "7%", orderable: false}
            ]
        });
    }
    if (!$.fn.DataTable.isDataTable("#tabledroits")) {
        $("#tabledroits").DataTable({
            bInfo: false,
            paging: false,
            columns: [
                {"width": "10%"},
                null,
                {"width": "7%", orderable: false}
            ]
        });
    }
});
var chargerDroits = function () {
    if ($("select[name=comboProfiles]").val() === "") {
        return;
    }
    $.ajax({
        url: "./ajaxprofile",
        type: "POST",
        dataType: "json",
        data: {
            action: "chargerDroits",
            profile: $("select[name=comboProfiles]").val()
        },
        success: function (result) {
            $("#listeusers").html(result[0]);
            $("#listedroits").html(result[1]);
        },
        error: function (xhr, error, status) {
            alert(xhr.responseText);
        }
    });
};

function validerDroit() {
    removeRequiredFields([$("select[name=comboProfiles]")]);

    if ($("select[name=comboProfiles]").val() === "") {
        addRequiredFields([$("select[name=comboProfiles]")]);
        alertWebix(__t("Veuillez choisir le profil a modifier"));
        return;
    }
    $("input[name=profile]").val($("select[name=comboProfiles]").val());

    var frm = $("form[name=frmprofile]");
    frm.submit();
}