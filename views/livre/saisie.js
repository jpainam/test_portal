$(document).ready(function(){
    
});
function submitForm() {
    if ($("input[name=titre]").val() === "") {
        alertWebix("Veuillez remplir le champ titre");
        addRequiredFields([$("input[name=titre]")]);
        return;
    }
    document.forms[0].submit();
}
