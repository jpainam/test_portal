var _array_lang = {};

$(document).ready(function () {
    _array_lang = {
        
    };
});
function __t(_key){
    if(_array_lang !== null){
        if(_key in _array_lang){
            return _array_lang[_key];
        }else{
            return _key;
        }
    }
    return _key;
}
function deleteRow(_url, name) {
    webix.modalbox({
        title: __t("Suppression d'une ligne"),
        buttons: ["Oui", "Non"],
        width: "300px",
        text: __t("Etes-vous certain de vouloir supprimer cet entree"),
        callback: function (result) {
            if (result == 0) {
                document.location = _url;
            }
        }
    });
}