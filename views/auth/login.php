<div class="contenedor login">
    <h1 class="title">ABTEC</h1>
    <p class="tagline">Administrador de Proyectos y Tareas</p>
    <div class="contenedor-login">
        <p class="descripcion-pagina">Iniciar Sesión</p>
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>
        <form class="formulario" method="POST" action="/" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu Password" name="password">
            </div>
            <div class="campo-boton">
                <input type="submit" class="boton" value="Iniciar Sesión">
            </div>
        </form>
    </div><!--.contenedor-sm-->

</div>