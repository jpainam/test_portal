$(document).ready(function () {
    $("#punitionTable").DataTable({
        "bInfo": false,
        "columnDefs": [
            {"width": "10%", "targets": 0},
            {"width": "7%", "targets": 5},
             {"width": "12%", "targets": 3},
            {"width": "10%", "targets": 6}
        ]
    });
});
function supprimerPunition(_id){
    if(confirm(__t("Etes vous sur de vouloir effectuer cette suppression?"))){
        document.location = "./punition/delete/"+_id;
    }
}

function printPunition(_id){
    //document.op
    window.open("./punition/imprimer/" + _id, "_blank");
}
function sendNotification(_idpunition){
    $.ajax({
        url: "./punition/ajax/sendNotification",
        type: "POST",
        dataType: "json",
        data: {
            idpunition: _idpunition
        },
        success: function(result){
            $("#punition-content").html(result[0]);
            alertWebix(__t("Notification envoyée avec succès"));
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });
}