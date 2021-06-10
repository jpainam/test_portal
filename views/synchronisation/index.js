$(document).ready(function () {
    if (!$.fn.DataTable.isDataTable("#synchronisationTable")) {
        $("#synchronisationTable").DataTable({
            "bInfo": false,
            "scrollY": $(".page").height() - 100,
            "searching": false,
            "paging": false,
            "columns": [
                {"width": "15%"},
                null,
                {"width": "20%"}
            ]
        });
    }
});

function nouvelleSynchronisation() {
    $.ajax({
        url: "./synchronisation/ajax",
        type: "POST",
        dataType: "json",
        data: {
            action: "synchronisation"
        },
        success: function (result) {
            $("#synchronisation-content").html(result[0]);
            alertWebix(__t("Synchronisation effectuée avec succès"));
        },
        error: function (xhr) {
            alert(xhr.responseText);
        }
    });
}