<div style="width: 55%; float: left">
    <table class="dataTable" id="persoTable">
        <thead><tr><th>Examen</th><th>D&eacute;but</th><th>Fin</th><th></th></tr></thead>
        <tbody>
            <?php
            foreach ($examens as $ex) {
                echo "<tr><td onclick='afficherExamen(".$ex['IDEXAMEN'].")' "
                        . " style='cursor:pointer'>" . $ex['LIBELLE'] . "</td><td>" . date("d/m/Y", strtotime($ex['DATEDEBUT'])) . "</td><td>"
                . date("d/m/Y", strtotime($ex['DATEFIN'])) . "</td>";
                echo "<td align='center'>";
                if(isAuth(551)){
                echo  "<img src='".img_delete()."' onclick='deleteExamen(".$ex['IDEXAMEN'].")' style='cursor:pointer'  />";
                }else{
                     echo "<img src='".img_delete_disabled()."' style='cursor:pointer' />";
                }
                echo "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<div style="width: 25%; float: right; margin-right: 20px;">
    <table class="dataTable" id="droitTable">
        <thead><tr><th>Classe</th></tr></thead>
        <tbody>
            <?php
            if (isset($classes)) {
                foreach ($classes as $cl) {
                    echo "<tr><td>" . $cl['LIBELLE'] . " " . $cl["NIVEAUSELECT"] . "</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#persoTable")) {
            $("#persoTable").DataTable({
                paging: false,
                bInfo: false,
                scrollY: 300,
                scrollCollapse: true,
                columns: [
                    null,
                    {width: "10%"},
                    {width: "10%"},
                    {width: "5%", orderable: false}
                ]
            });
        }
        if (!$.fn.DataTable.isDataTable("#droitTable")) {
            $("#droitTable").DataTable({
                paging: false,
                bInfo: false,
                scrollY: 300,
                scrollCollapse: true,
                columns: [
                    null//,
                            //{width: "10%"},
                            //{width: "10%"}
                ]
            });
        }
    });
    function afficherExamen($idexamen) {
        $.ajax({
            url: "./calendrier/ajaxexamen",
            type: 'POST',
            dataType: 'json',
            data: {
                idexamen: $idexamen,
                action: "afficher"
            },
            success: function (result) {
                $("#examen-content").html(result[1]);
                  $("#success_submit").html(result[0]);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function deleteExamen($idexamen) {
    $.ajax({
        url: "./calendrier/ajaxexamen",
        type: 'POST',
        dataType: 'json',
        data: {
            idexamen: $idexamen, 
            action: "delete"
        },
        success: function (result) {
            $("#examen-content").html(result[1]);
            $("#success_submit").html(result[0]);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}
</script>