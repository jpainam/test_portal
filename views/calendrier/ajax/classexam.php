<table class="dataTable" id="persoTable">
    <thead><tr><th>Classe</th><th>D&eacute;but</th><th>Fin</th></tr></thead>
    <tbody>
        <?php
        foreach ($classes as $cl) {
            echo "<tr><td>" . $ex['LIBELLE'] . "</td><td>" . date("d/m/Y", strtotime($ex['DATEDEBUT'])) . "</td><td>"
            . date("d/m/Y", strtotime($ex['DATEFIN'])) . "</td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#persoTable")) {
            $("#persoTable").DataTable({
                paging: false,
                bInfo: false,
                scrollCollapse: true,
                columns: [
                    null,
                    {width: "10%"},
                    {width: "10%"}
                ]
            });
        }
    });
</script>