<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'username', 'password', 'cargo', 'profesion', 'fecha_nacimiento', 'area', 'ciudad', 'region', 'pais', 'telefono'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->username = $args['username'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->cargo = $args['cargo'] ?? '';
        $this->profesion = $args['profesion'] ?? '';
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->area = $args['area'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->region = $args['region'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    public function validar()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email es inválido';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        return self::$alertas;
    }
}
