<?php

namespace Controllers;

use Model\Proyecto;
use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();
        $proyectos = Proyecto::belongsTo('status', TRUE); //-> Obtenemos los proyectos y los pasamos a la vista.
        //Render a la vista
        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos //-> Pasamos los proyectos a la vista.
        ]);
    }
    public static function crearProyecto(Router $router)
    {
        session_start();
        isAuth();
        $proyecto = new Proyecto(); //->Instanciamos la clase Proyecto
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST); //->Instanciamos la clase Proyecto

            //Validacion
            $alertas = $proyecto->validarProyecto();
            if (empty($alertas)) {
                //Generar url unica
                $proyecto->url = md5(uniqid());
                //Insertar en la base de datos
                $proyecto->guardar();

                //Redireccionar
                header('Location: /proyecto?url=' . $proyecto->url);
            }
        }
        //Render a la vista
        $router->render('dashboard/crearProyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas,
            'proyecto' => $proyecto
        ]);
    }
    public static function proyecto(Router $router)
    {
        session_start();
        isAuth();
        $url = $_GET['url']; // Obtenemos url de la barra de direcciones
        if (!$url) header('Location: /dashboard'); //Si no hay url redireccionar a dashboard
        $proyecto = Proyecto::where('url', $url);

        //Render a la vista
        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->nombre_proyecto
        ]);
    }
    public static function perfil(Router $router)
    {
        session_start();
        isAuth();
        //Render a la vista
        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
        ]);
    }
}
