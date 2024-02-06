<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\TareaController;
use MVC\Router;

$router = new Router();
//Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Dashboard proyectos
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/crear-proyecto', [DashboardController::class, 'crearProyecto']);
$router->post('/crear-proyecto', [DashboardController::class, 'crearProyecto']);
$router->get('/perfil', [DashboardController::class, 'perfil']);

//Proyectos
$router->get('/proyecto', [DashboardController::class, 'proyecto']);

//Tareas API
$router->get('/proyecto', [TareaController::class, 'index']); //Obtiene todas las tareas de un proyecto
$router->post('/api/tarea', [TareaController::class, 'crear']); //Se ejecuta cuando se cree una nueva tarea
//Actualizar tarea
$router->get('/actualizar', [TareaController::class, 'actualizar']); //Para cambiar el estado de una tarea o renombrarla
$router->post('/actualizar', [TareaController::class, 'actualizar']); //Para eliminar una tarea

//$router->get('/api/tarea', [TareaController::class, 'index']);

//Eliminar Tarea
$router->get('/eliminar', [TareaController::class, 'eliminar']); //Para eliminar una tarea





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
