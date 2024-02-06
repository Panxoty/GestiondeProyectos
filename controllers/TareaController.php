<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;
use MVC\Router;

class TareaController
{
    public static function index(Router $router)
    {
        session_start();
        $tarea = new Tarea();
        $proyectoId = $_GET['url'];
        if (!$proyectoId) header('Location: /dashboard'); //Si no hay proyectoId redireccionamos al dashboard
        $proyecto = Proyecto::where('url', $proyectoId);
        if (!$proyecto) header('Location: /404'); //Si no hay proyecto 

        $tareas = Tarea::belongsTo('proyectoId', $proyecto->id);

        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->nombre_proyecto,
            'tareas' => $tareas
        ]);
    }
    //Nos comunicamos con JS mediante api
    public static function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $proyectoId = $_POST['proyectoId'];
            $proyecto = Proyecto::where('url', $proyectoId);
            if (!$proyecto) { //Si no hay proyecto
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'No existe el proyecto'
                ];
                echo json_encode($respuesta); //Lo convertimos a JSON
                return;
            }
            //Si no hay errores lo guardamos en la base de datos
            $tarea = new Tarea($_POST);
            $tarea->proyectoid = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Tarea creada correctamente'
            ];
            echo json_encode($respuesta);
        }
    }
    public static function actualizar(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];
        $tareaId = $_GET['id'];
        $tareaId = filter_var($tareaId, FILTER_VALIDATE_INT); //-> Validamos que sea un entero
        if (!$tareaId) { //-> Si no es un entero redireccionamos
            header('Location: /dashboard');
        }
        $tarea = Tarea::find($tareaId);
        //Boton volver.
        $proyectId = $tarea->proyectoid;
        $proyectoURL = Proyecto::buscar($proyectId);
        $proyectoURL = $proyectoURL->url; //-> Obtenemos la url del proyecto

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tarea->sincronizar($_POST);
            $alertas = $tarea->validar();
            if (empty($alertas)) {
                $tarea->guardar();
                header("Location: /proyecto?url={$proyectoURL}");
            }
        }

        $router->render('tareas/actualizar', [
            'titulo' => 'Editar Tarea',
            'alertas' => $alertas,
            'tarea' => $tarea,
            'proyectoURL' => $proyectoURL
        ]);
    }
    public static function eliminar(Router $router)
    {

        //-> Obtenemos el id de la url eliminar
        $tareaId = $_GET['id'];
        $tarea = Tarea::find($tareaId);
        $alertas = [];
        //-> Para volver al proyecto con las tareas
        $proyectoId = $tarea->proyectoid;
        $proyectoURL = Proyecto::buscar($proyectoId);
        $proyectoURL = $proyectoURL->url; //-> Obtenemos la url del proyecto
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $tarea->eliminar();
            header("Location: /proyecto?url={$proyectoURL}");
            Tarea::setAlerta('exito', 'Tarea eliminada correctamente');
        }
        $alertas = Tarea::getAlertas();
        $router->render('tareas/eliminar', [
            'titulo' => 'Eliminar Tarea',
            'alertas' => $alertas,
            'tarea' => $tarea,
        ]);
    }
}
