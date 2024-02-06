<?php

namespace Model;;

class Tarea extends ActiveRecord
{
    protected static $tabla = 'tareas';
    protected static $columnasDB = ['id', 'nombre', 'lider', 'especialista', 'area', 'fecha_inicio', 'fecha_fin', 'estado', 'proyectoid'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->lider = $args['lider'] ?? '';
        $this->especialista = $args['especialista'] ?? '';
        $this->area = $args['area'] ?? '';
        $this->fecha_inicio = $args['fecha_inicio'] ?? '';
        $this->fecha_fin = $args['fecha_fin'] ?? '';
        $this->estado = $args['estado'] ?? 'Pendiente';
        $this->proyectoid = $args['proyectoid'] ?? null;
    }
    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre de la tarea es obligatorio';
        }
        if (!$this->fecha_inicio) {
            self::$alertas['error'][] = 'La fecha de inicio es obligatoria';
        }
        if (!$this->fecha_fin) {
            self::$alertas['error'][] = 'La fecha de fin es obligatoria';
        }
        return self::$alertas;
    }
}
