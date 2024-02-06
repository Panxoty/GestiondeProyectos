<div class="campo">
    <label for="nombre">Nombre Proyecto</label>
    <input type="text" id="nombre" placeholder="Nombre Proyecto" name="nombre_proyecto" value="<?php echo $proyecto->nombre_proyecto; ?>">
</div>
<div class="campo">
    <label for="encargado">Nombre Encargado</label>
    <input type="text" id="encargado" placeholder="Nombre Encargado" name="nombre_encargado" value="<?php echo $proyecto->nombre_encargado; ?>">
</div>
<div class="campo">
    <label for="correo">Correo Encargado</label>
    <input type="text" id="correo" placeholder="Correo Encargado" name="correo_encargado" value="<?php echo $proyecto->correo_encargado; ?>">
</div>
<div class="campo">
    <label for="description">Descripcion Proyecto</label>
    <input type="text" id="description" placeholder="Descripción" name="descripcion_proyecto" value="<?php echo $proyecto->descripcion_proyecto ?>">
</div>
<div class="campo">
    <label for="estado">Status</label>
    <input type="number" id="estado" placeholder="0 inactivo , 1 activo" name="status" min="0" max="1">
</div>