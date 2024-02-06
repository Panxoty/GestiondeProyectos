<?php include_once __DIR__ . '/header-dashboard.php' ?>
<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <form class="formulario" method="POST" action="/crear-proyecto">
        <?php include_once __DIR__ . '/formulario-proyecto.php' ?>
        <div class="campo-boton">
            <input type="submit" value="Crear Proyecto">
        </div>
    </form>
</div>
<?php include_once __DIR__ . '/footer-dashboard.php' ?>