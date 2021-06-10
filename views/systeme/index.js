$(document).ready(function () {
    $("#systemeTable").DataTable({
        columns: [
            {"width": "10%"},
            null
        ]
    });
    $("input[type='checkbox']").change(function () {
        $.ajax({
            url: './systeme/ajax',
            data: {
                key: $(this).val(),
                checked: $(this).is(":checked")
            },
            type: 'POST',
            dataType: 'json',
            success: function (result) {

            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    });
});