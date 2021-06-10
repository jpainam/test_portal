$(document).ready(function(){
    
});


function impression(_idlivre) {
    
    var frm = $("<form>", {
        action: "./livre/imprimer",
        target: "_blank",
        method: "post"
    }).append($("<input>", {
        name: "code",
        type: "hidden",
        value: "0001"
    })).append($("<input>", {
        name: "idlivre",
        type: "hidden",
        value: _idlivre
    })).appendTo("body");

    frm.submit();

}