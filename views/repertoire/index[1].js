$(document).ready(function(){
   $("#tableRepertoire").DataTable({
       "bInfo": false,
       "paging": false,
       columns: [
           {"width": "7%"},
           null,
           null,
           {"width" : "10%"},
           {"width" : "15%"}
       ]
   }) 
});

function imprimer() {
    if ($("select[name=code_impression]").val() === "") {
        return;
    }
    var frm = $("<form>", {
        action: "./repertoire/imprimer",
        target: "_blank",
        method: "post"
    }).append($("<input>", {
        name: "type_impression",
        type: "hidden",
        value: $("input[name=type_impression]:checked").val()
    })).append($("<input>", {
        name: "code",
        type: "hidden",
        value: $("select[name=code_impression]").val()
    })).appendTo("body");
    frm.submit();
}