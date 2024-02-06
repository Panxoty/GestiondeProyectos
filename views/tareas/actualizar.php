<?php include_once __DIR__ . '/../dashboard/header-dashboard.php' ?>
<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <form class="formulario" method="POST" action="/actualizar?id=<?php echo $tarea->id ?>">
        <div class="campo">
            <label for="nombre">Nombre tarea</label>
            <input type="text" value="<?php echo $tarea->nombre ?>" name="nombre">
        </div>
        <div class="campo">
            <label for="Lider">Lider</label>
            <select name="lider">
                <option selected disabled>-- Seleccione -- </option>
                <option value="Pedro" <?php echo ($tarea->lider === 'Pedro' ? 'selected' : '') ?>>Pedro</option>
                <option value="Ariel" <?php echo ($tarea->lider === 'Ariel' ? 'selected' : '') ?>>Ariel</option>
            </select>
        </div>
        <div class="campo">
            <label for="">Especialista</label>
            <select name="especialista">
                <option selected disabled>-- Seleccione -- </option>
                <option value="Francisco" <?php echo ($tarea->especialista === 'Francisco' ? 'selected' : '') ?>>Francisco</option>
                <option value="David" <?php echo ($tarea->especialista === 'David' ? 'selected' : '') ?>>David</option>
                <option value="Bastian" <?php echo ($tarea->especialista === 'Bastian' ? 'selected' : '') ?>>Bastian</option>
            </select>
        </div>
        <div class="campo">
            <label for="">Area</label>
            <select name="area">
                <option selected disabled>-- Seleccione -- </option>
                <option value="backend" <?php echo ($tarea->area === 'backend' ? 'selected' : '') ?>>Backend</option>
                <option value="frontend" <?php echo ($tarea->area === 'frontend' ? 'selected' : '') ?>>Frontend</option>
            </select>
        </div>
        <div class="campo">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" value="<?php echo $tarea->fecha_inicio ?>">
        </div>
        <div class="campo">
            <label>Fecha Fin</label>
            <input type="date" name="fecha_fin" value="<?php echo $tarea->fecha_fin ?>">
        </div>
        <div class="campo">
            <label for="estado">Estado Tarea</label>
            <select name="estado">
                <option selected disabled>-- Seleccione -- </option>
                <option value="Pendiente" <?php echo ($tarea->estado === 'Pendiente' ? 'selected' : '') ?>> Pendiente</option>
                <option value="En Proceso" <?php echo ($tarea->estado === 'En Proceso' ? 'selected' : '') ?>>En Proceso</option>
                <option value="Revision" <?php echo ($tarea->estado === 'Revision' ? 'selected' : '') ?>>Revision</option>
                <option value="Finalizada" <?php echo ($tarea->estado === 'Finalizada' ? 'selected' : '') ?>>Finalizada</option>
            </select>
        </div>
        <div class="campo-2">
            <input type="submit" value="Actualizar">
            <a href="/proyecto?url=<?php echo $proyectoURL ?>" class="boton-actualizar">Volver</a>
        </div>
    </form>
</div>
<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php' ?>