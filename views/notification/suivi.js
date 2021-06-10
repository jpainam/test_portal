

$(document).ready(function () {
     $("#datefin, #datedebut").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    
    $("select[name=comboDestinataires]").select2();
    $("select[name=comboDestinataires]").change(chargerMessageEnvoyes);
});

var chargerMessageEnvoyes = function () {
    
    
    $.ajax({
       url: "./ajaxsuivi",
       type: "POST",
       dataType: "json",
       data: {
         action : "filterParDestinataire",
         datedebut : $("input[name=datedebut]").val(),
         datefin: $("input[name=datefin]").val(),
         destinataire: $("select[name=comboDestinataires]").val()
       },
       success: function(result){
           $("#message-content").html(result[0]);
       },
       error: function(xhr, status, error){
           console.log(xhr.responseText);
       }
    });
};

function supprimerMessageEnvoye(_idmessage) {
    $.ajax({
        url: "./ajaxsuivi",
        type: "POST",
        dataType: "json",
        data: {
            idmessage : _idmessage,
            action: "supprimerMessageEnvoye"
        },
        success: function(result){
            $("#message-content").html(result[0]);
        },
        error: function(xhr, status, error){
            alert(xhr.responseText);
        }
    });
}