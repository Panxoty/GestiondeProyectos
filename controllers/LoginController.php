<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validar();

            if (empty($alertas)) {
                //Verificar si el usuario existe
                $usuario = Usuario::where('email', $usuario->email);
                if (!$usuario) {
                    Usuario::setAlerta('error', 'El usuario no existe');
                } else {
                    //Verificar el password
                    if (password_verify($_POST['password'], $usuario->password)) {
                        session_start(); //Iniciar la sesión
                        $_SESSION['id'] = $usuario->id; //Asignar el ID del usuario a la sesión
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['username'] = $usuario->username;
                        $_SESSION['cargo'] = $usuario->cargo;
                        $_SESSION['profesion'] = $usuario->profesion;
                        $_SESSION['fecha_nacimiento'] = $usuario->fecha_nacimiento;
                        $_SESSION['area'] = $usuario->area;
                        $_SESSION['ciudad'] = $usuario->ciudad;
                        $_SESSION['region'] = $usuario->region;
                        $_SESSION['pais'] = $usuario->pais;
                        $_SESSION['telefono'] = $usuario->telefono;
                        $_SESSION['login'] = true;

                        //Redireccionar al usuario.
                        header('Location: /dashboard');
                    } else {
                        Usuario::setAlerta('error', 'El password es incorrecto');
                    }
                }
            }
            $alertas = Usuario::getAlertas();
        }
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }
    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}
