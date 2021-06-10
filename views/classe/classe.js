$(document).ready(function () {
      $(function () {
        var $num = $('select[name=numero]'),
        $exp = $('input[name=exposant]'),
        $abreger = $('input[name=abrege]'),
        $libelle = $("input[name=libelle]"),
        $long = $("#resultlong"),
            $dst = $('#resultclass');
        $num.on('input', function () {
            $dst.html($num.val() + " <sup>" + $exp.val() + "</sup> " + $abreger.val());
        });
        $exp.on('input', function () {
            $dst.html($num.val() + " <sup>" + $exp.val() + "</sup> " + $abreger.val());
        });
        $abreger.on('input', function () {
            $dst.html($num.val() + " <sup>" + $exp.val() + "</sup> " + $abreger.val());
        });
        
        $libelle.on('input', function () {
            $long.html($libelle.val());
        });
    });
});


function soumettreFormClasse() {
    var frm = $("form[name=frmclasse]");
    removeRequiredFields([$("input[name=abrege]")]);
    if ($("input[name=abrege]").val() === "") {
        alertWebix(__t("Renseigner les champs obligatoires"));
        addRequiredFields([$("input[name=abrege]")]);
        return;
    }
    frm.submit();
}