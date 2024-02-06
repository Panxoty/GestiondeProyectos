<?php

namespace Model;

use Model\ActiveRecord;

class Proyecto extends ActiveRecord
{
    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id', 'nombre_proyecto', 'nombre_encargado', 'correo_encargado', 'descripcion_proyecto', 'status', 'url'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_proyecto = $args['nombre_proyecto'] ?? '';
        $this->nombre_encargado = $args['nombre_encargado'] ?? '';
        $this->correo_encargado = $args['correo_encargado'] ?? '';
        $this->descripcion_proyecto = $args['descripcion_proyecto'] ?? '';
        $this->status = $args['status'] ?? 0;
        $this->url = $args['url'] ?? '';
    }
    public function validarProyecto()
    {
        if (!$this->nombre_proyecto) {
            self::$alertas['error'][] = 'El nombre del proyecto es obligatorio';
        }
        if (!$this->nombre_encargado) {
            self::$alertas['error'][] = 'El nombre del encargado es obligatorio';
        }
        if (!$this->correo_encargado) {
            self::$alertas['error'][] = 'El correo del encargado es obligatorio';
        }
        if (!$this->descripcion_proyecto) {
            self::$alertas['error'][] = 'La descripcion del proyecto es obligatoria';
        }
        return self::$alertas;
    }
}
