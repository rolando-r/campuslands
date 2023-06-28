<?php
    use Models\Region;
    $objRegion = new Region();
    $_DATA=json_encode($objRegion->loadAllData());
?>
<section>
  <h1 >Listado de Regiones</h1>
  <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Id Region</th>
            <th>Nombre Region</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</section>
<script src="js/jquery-3.7.0.slim.js"></script>
<script src="js/DataTables/datatables.min.js"></script>
<script>
    const datos=<?php echo $_DATA;?>;
    $('#myTable').DataTable(  {
        data: datos,
        pageLength: 2,
        columns: [
                    { data: 'id_country' },
                    { data: 'name_country' }
        ],
        language: {
            
                "decimal":        "",
                "emptyTable":     "No hay datos en la tabla",
                "info":           "Desde _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 a 0 de 0 Registros",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrando _MENU_ registros",
                "loadingRecords": "Loading...",
                "processing":     "",
                "search":         "Buscar:",
                "zeroRecords":    "Nose encontraron registros",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            
        },
    } )
</script>
