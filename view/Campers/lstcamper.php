<?php
    include_once '../../app.php';
    use Models\Camper;
    Camper::setConn($conn);
    $objCamper = new Camper();
?>
<script type="text/javascript" src="view/Campers/camper.js"></script>
<h1>Listado de campers</h1>
<section>
    <div class="container">
        <table id="misPaises" class="display dataTable">
            <thead>
                <tr>
                    <th class="sorting_disabled" rowspan="1" colspan="1">Id Campers</th>
                    <th class="sorting_disabled" rowspan="1" colspan="1">Nombre de el camper</th>
                    <th class="sorting_disabled" rowspan="1" colspan="1">Apellido de el camper</th>
                    <th class="sorting_disabled" rowspan="1" colspan="1">Fecha de nacimiento</th>
                    <th rowspan="1" colspan="1"></th>
            </thead>
            <tbody>
                <?php foreach ($objCity->loadAllData() as $pais) : ?>
                    <tr>
                        <td><?php echo $pais['idCamper']; ?></td>
                        <td><?php echo $pais['nombreCamper']; ?></td>
                        <td><?php echo $pais['apellidoCamper']; ?></td>
                        <td><?php echo $pais['fechaNac']; ?></td>
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
                        <h3>Edicion de paises</h3>
                        <form id="frmUpdateData">
                            <input id="idPais" name="idPais" type="hidden" value="0">
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