$(document).ready(function () {
    $("#comboClasses").change(chargerEleves);
    $("#datepunition").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
});


chargerEleves = function () {
    $.ajax({
        url: "./ajax/charger",
        type: "POST",
        dataType: "json",
        data: {
            "idclasse": $("select[name=comboClasses]").val()
        },
        success: function (result) {
            $("select[name=comboEleves]").html(result[0]);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
};
function soumettrePunition() {
    removeRequiredFields([$("#comboPersonnels"), $("#comboClasses"), $("select[name=comboEleves]")]);
    if ($("#comboPersonnels").val() === "" || $("#comboClasses").val() === "" || $("select[name=comboEleves]").val() === "") {
        addRequiredFields([$("#comboPersonnels"), $("#comboClasses"), $("select[name=comboEleves]")]);
        alertWebix(__t("Veuillez remplir les champs obligatoires"));
        return;
    }
    $("input[name=punipar]").val($("select[name=comboPersonnels]").val());
    var frm = $("form[name=frmpunition]");
    frm.submit();
}
