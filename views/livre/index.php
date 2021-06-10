<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_livre.png"; ?>" /></div>
</div>
<form action="<?php echo Router::url("livre", "saisie"); ?>" name="frmlivre">
    <div class="page">
        <table class="dataTable" id="tableLivre">
            <thead><th>N°</th><th>Titre</th><th>Ann&eacute;e</th><th>Publisher</th><th>Qt&eacute;</th><th></th></thead>
            <tbody>
                <?php
                # 224 consulter les info sur les livres
                # Print detail du livre 224
                # Edit details livre 537
                # Suppresion d'un livre 538
                $i = 0;
                foreach ($livres as $l) {
                    $i = $i + 1;
                    echo "<tr><td>" . $i . "</td><td>" . $l['TITRE'] . "</td>";
                    echo "<td align='right'>" . $l['EDITION'] . "</td><td>" . $l['PUBLISHERLIBELLE'] . "</td>"
                            . "<td align='right'>" . $l['QUANTITE'] . "</td><td align='center'>";
                    if (isAuth(224)) {
                        echo "<img src='" . img_print() . "' style='cursor:pointer' "
                        . "onclick = \"impression('" . $l['IDLIVRE'] . "')\" />&nbsp;&nbsp;";
                    }
                    if (isAuth(537)) {
                        echo "<img style ='cursor:pointer' src = '" . img_edit() . "' "
                        . "onclick = \"document.location='" . Router::url("livre", "edit", $l['IDLIVRE']) . "'\" />&nbsp;&nbsp;";
                    } else {
                        echo "<img style ='cursor:pointer' src = '" . img_edit_disabled() . "' />&nbsp;&nbsp;";
                    }
                    if (isAuth(538)) {
                        echo "<img style ='cursor:pointer' src = '" . img_delete() . "' "
                        . "onclick =\"deleteRow('" . Router::url("livre", "delete", $l['IDLIVRE']) . "', '" . $l['TITRE'] . "')\" />";
                    } else {
                        echo "<img style ='cursor:pointer' src = '" . img_delete_disabled() . "' />";
                    }
                    echo "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="navigation">
        <?php
        if (isAuth(539)) {
            echo btn_add("document.forms['frmlivre'].submit();");
        }
        ?>
    </div>
</form>
<div class="status"></div>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableLivre")) {
            $('#tableLivre').DataTable({
                //bInfo: false,
                //searching: false,
                //paging: false,
                //scrollY: $(".page").height() - 100,
                columns: [
                    {"width": "5%"},
                    null,
                    {"width": "10%"},
                    {"width": "15%"},
                    {"width": "5%"},
                    {"width": "10%"}
                ]
            });
        }
    });
</script>