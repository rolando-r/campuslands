<?php
    include_once '../../app.php';
    use Models\Region;
    Region::setConn($conn);
    $objRegion = new Region();
?>
<script type="text/javascript" src="view/Campers/camper.js"></script>
<h1>Formulario de registro</h1>
<form id="frmRegCamper">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre camper</label>
    <input type="text" class="form-control" id="nombreCamper" name="nombreCamper">
    <label for="exampleInputEmail1" class="form-label">Apellido camper</label>
    <input type="text" class="form-control" id="apellidoCamper" name="apellidoCamper">
    <label for="exampleInputEmail1" class="form-label">Fecha nacimiento</label>
    <input type="text" class="form-control" id="fechaNac" name="fechaNac">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Departamentos</label>
    <select class="form-select" name="idReg" id="idReg" aria-label="Default select example">
        <option selected>Seleccione un departamento</option>
        <?php foreach ($objRegion->loadAllData() as $region): ?>
            <option value="<?php echo $region['idReg']; ?>"><?php echo $region['nombreReg']; ?></option>
        <?php endforeach; ?>          
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>