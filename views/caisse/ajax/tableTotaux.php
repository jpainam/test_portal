<table class="dataTable" id="tableTotaux">
    <thead><tr><th>Montant non valid&eacute;e</th><th>Montant non per&ccedil;u</th><th>Montant valid&eacute;</th>
            <th>*Obligatoires non vali&eacute;s</th><th>*Obligatoires valid&eacute;s</th></tr></thead>
    <tbody>
        <tr style="text-align: right;">
            <td><?php echo moneyString($totaux['MONTANTNONVALIDE']); ?></td>
            <td><?php echo moneyString($totaux['MONTANTNONPERCU']); ?></td>
            <td><?php echo moneyString($totaux['MONTANTVALIDE']); ?></td>
            <td><?php echo moneyString($totaux['OBLIGATOIRENONVALIDE']); ?></td>
            <td><?php echo moneyString($totaux['OBLIGATOIREVALIDE']); ?></td>
        </tr>
    </tbody>
</table>
<script>
   if (!$.fn.DataTable.isDataTable("#tableTotaux")) {
        $("#tableTotaux").DataTable({
           bInfo: false,
           paging: false,
           searching: false
        });
    }
</script>