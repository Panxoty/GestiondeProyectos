<?php include_once __DIR__ . '/header-dashboard.php' ?>
<?php if (count($proyectos) === 0) { ?>
    <p class="no-proyectos">No hay proyectos Aún</p>
<?php } else { ?>
    <div class="listado-proyectos">
        <?php foreach ($proyectos as $proyecto) { ?>
            <div class="card">
                <h4 class="title-card"> <?php echo $proyecto->nombre_proyecto; ?> </h4>
                <p class="p-card">Lider: <span> <?php echo $proyecto->nombre_encargado; ?></span> </p>
                <p class="p-card">Descripción: <?php echo $proyecto->descripcion_proyecto ?> </p>
                <p class="p-card">Estado:<span class="estado"> <?php echo $proyecto->status === 1 ? ' Inactivo' : ' Activo' ?> </span> </p>
                <a href="/proyecto?url=<?php echo $proyecto->url; ?>" class="boton">Ver proyecto</a>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<?php include_once __DIR__ . '/footer-dashboard.php' ?>