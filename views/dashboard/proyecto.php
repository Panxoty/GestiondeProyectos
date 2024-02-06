<?php include_once __DIR__ . '/header-dashboard.php' ?>
<div class="contenedor-sm">
    <div class="contenedor-nueva-tarea">
        <button type="button" class="agregar-tarea" id="agregar-tarea"> Nueva Tarea</button>
    </div>
</div>

<?php if (count($tareas) === 0) { ?>
    <p class="no-proyectos">No hay tareas Aún</p>
<?php } else { ?>
    <div class="listado-tareas">
        <?php foreach ($tareas as $tarea) { ?>
            <div class="card card-tarea">
                <h4 class="title-card"> <?php echo $tarea->nombre ?> </h4>
                <p class="p-card-tarea">Asignada a: <span class="span-dif"> <?php echo $tarea->especialista ?> </span> </p>
                <p class="p-card-tarea">Fecha Inicio: <?php echo $tarea->fecha_inicio ?></p>
                <p class="p-card-tarea">Fecha Fin: <?php echo $tarea->fecha_fin ?></p>


                <p class="p-card-tarea">Estado: <span class="<?php echo $tarea->estado ?>"> <?php echo $tarea->estado ?> </span> </p>


                <div class="opciones">
                    <a href="/actualizar?id=<?php echo $tarea->id ?>" class="boton">Editar Tarea</a>
                    <a href="/eliminar?id=<?php echo $tarea->id ?>" class="boton boton-archivar">Archivar</a>
                </div>
            </div><!--.card -->
        <?php } ?>
    </div>
<?php } ?>
<?php include_once __DIR__ . '/footer-dashboard.php' ?>
<?php
$script = '<script src="build/js/tareas.js"></script>';
?>