<?php 
        use Models\Region;  
        $objRegion =new Region();
?>

<section>
    <h1 >Listado de Regiones</h1>
    <div class="container">
    <table id="tblregion" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Id Region</th>
                <th>Nombre Pais</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($objCountry->loadAllData() as $pais): ?>
                    <tr>
                                <td><?php echo $pais['idReg']; ?></td>
                                <td><?php echo $pais['nameReg']; ?></td>
                    </tr>
            <?php endforeach; ?>            
        </tbody>
    </table>
    </div>
</section>
<script src="js/jquery-3.7.0.slim.js"></script>
<script src="js/DataTables/datatables.min.js"></script>
<script>
    $('#tblpais').DataTable(  {
        pageLength: 4,
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
