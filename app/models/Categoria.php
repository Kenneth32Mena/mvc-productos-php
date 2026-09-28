<?php
class Categoria {
    private $id;
    private $nombre;
    private $descripcion;

    public function __construct($id, $nombre, $descripcion) {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setId($id) {
        $this->id = (int)$id;
    }

    public function setNombre($nombre) {
        $nombre = trim($nombre);
        if ($nombre === '') {
            throw new InvalidArgumentException('El nombre de la categoría es obligatorio.');
        }
        if (strlen($nombre) > 250) {
            throw new InvalidArgumentException('El nombre no puede exceder 250 caracteres.');
        }
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $descripcion = trim($descripcion);
        if ($descripcion === '') {
            throw new InvalidArgumentException('La descripción de la categoría es obligatoria.');
        }
        if (strlen($descripcion) > 250) {
            throw new InvalidArgumentException('La descripción no puede exceder 250 caracteres.');
        }
        $this->descripcion = $descripcion;
    }
}
