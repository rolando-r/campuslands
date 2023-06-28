<?php

use Models\Region;

$objRegion = new Region();
// Recargar la página actual
global $idRegion;
function setIdRegion($id)
{
    $idRegion = $id;
}
?>
<script src="js/Bootstrap/bootstrap.min.js"></script>
<section>
    <h1>Listado de Regiones</h1>
    <div class="container">
        <table id="misRegiones" class="display dataTable">
            <thead>
                <tr>
                    <th class="sorting_disabled" rowspan="1" colspan="1">Id Region</th>
                    <th class="sorting_disabled" rowspan="1" colspan="1">Nombre de la region</th>
                    <th rowspan="1" colspan="1"></th>
            </thead>
            <tbody>
                <?php foreach ($objCountry->loadAllData() as $region) : ?>
                    <tr>
                        <td><?php echo $region['idReg']; ?></td>
                        <td><?php echo $region['nameReg']; ?></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-abrir-modal">-</button>
                            <button type="button" class="btn btn-primary btn-editar-modal">E</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<div class="modal fade " id="verifdel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">Confirmacion de eliminacion</h5>
                    <div class="card-body">
                        <h3></h3>
                        <div id="info"></div>
                        <button type="button" class="btn btn-danger borrardef" onclick="borrarDataDb()" data-bs-dismiss="modal">Confirmar eliminacion</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">Confirmacion de eliminacion</h5>
                    <div class="card-body">
                        <h3>Edicion de Regiones</h3>
                        <form id="frmUpdateData">
                            <input id="id_country" name="id_country" type="hidden" value="0">
                            Nombre del Pais <h6><span class="badge bg-primary"></span></h6>
                            <input type="text" name="name_country">
                            <button type="button" class="btn btn-primary" onclick="editarData()" data-bs-dismiss="modal">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.7.0.slim.js"></script>
<script src="js/DataTables/datatables.min.js"></script>
<script>
    var row;
    let idCountryBorrar;
    $('#miTabla').DataTable().destroy();
    $(document).ready(function() {
        var tabla = $('#misRegiones').DataTable();

        // Evento click en los botones dentro de la tabla
        $('#misRegiones tbody').on('click', '.btn-abrir-modal', function() {
            row = tabla.row($(this).parents('tr'));
            var fila = tabla.row($(this).closest('tr')).data();
            idCountryBorrar = fila[0]; // Obtener el valor de la columna 'Nombre'

            // Abrir el modal y mostrar el nombre del usuario
            abrirModal(fila[0], fila[1]);
        });
        $('#misRegiones tbody').on('click', '.btn-editar-modal', function() {
            const frm = document.querySelector('#frmUpdateData');
            const inputsData = new FormData(frm);
            row = tabla.row($(this).parents('tr'));
            var fila = tabla.row($(this).closest('tr')).data();
            idCountryBorrar = fila[0]; // Obtener el valor de la columna 'Nombre'
            inputsData.set("id_country",fila[0]);
            inputsData.set("name_country",fila[1]);
            document.querySelector('.badge').innerHTML = fila[0];
            // Itera a través de los pares clave-valor de los datos
            for (var pair of inputsData.entries()) {
                // Establece los valores correspondientes en el formulario
                frm.elements[pair[0]].value = pair[1];
            }
            $('#updateData').modal('show');
            // Abrir el modal y mostrar el nombre del usuario
        });
    });
    function editarData(){
        const frm = document.querySelector('#frmUpdateData');
        const info = Object.fromEntries(new FormData(frm));
        console.log(info);
    }
    function abrirModal(idpk, info) {
        $('#verifdel').modal('show');
        document.querySelector('#info').innerHTML = 'Desea eliminar a: <b>' + info + '</b> con Id' + idpk;
    }

    function borrarDataDb() {
        fetch('controllers/Country/delete_data.php?id=' + idCountryBorrar, {
                method: 'DELETE'
            })
            .then(response => {
                row.remove().draw();
            })
            .catch(error => {
                console.log('Error en la petición DELETE:', error);
            });

    }
    $('#misRegiones').DataTable({

        pageLength: 4,
        lengthMenu: [1, 3, 5, 10, 15, 25, 50, 100],
        language: {

            "decimal": "",
            "emptyTable": "No hay datos en la tabla",
            "info": "Desde _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 Registros",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrando _MENU_ registros",
            "loadingRecords": "Loading...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "Nose encontraron registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }

        },
    })
</script>