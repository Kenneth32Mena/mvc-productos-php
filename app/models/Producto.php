<?php
abstract class Producto {
    protected $id;
    protected $categoriaId;
    protected $categoriaNombre;
    protected $nombre;
    protected $precio;
    protected $stock;

    public function __construct($id, $categoriaId, $nombre, $precio, $stock, $categoriaNombre = '') {
        $this->setId($id);
        $this->setCategoriaId($categoriaId);
        $this->setNombre($nombre);
        $this->setPrecio($precio);
        $this->setStock($stock);
        $this->categoriaNombre = $categoriaNombre;
    }

    public function getId() { return $this->id; }
    public function getCategoriaId() { return $this->categoriaId; }
    public function getCategoriaNombre() { return $this->categoriaNombre; }
    public function getNombre() { return $this->nombre; }
    public function getPrecio() { return $this->precio; }
    public function getStock() { return $this->stock; }

    public function setId($id) { 
        $this->id = (int)$id; 
    }

    // Encapsulación con validación de regla de negocio
    public function setCategoriaId($categoriaId) {
        $categoriaId = (int)$categoriaId;
        if ($categoriaId <= 0) {
            throw new InvalidArgumentException('Debe seleccionar una categoría válida.');
        }
        $this->categoriaId = $categoriaId;
    }

    public function setNombre($nombre) {
        $nombre = trim($nombre);
        if ($nombre === '') throw new InvalidArgumentException('El nombre es obligatorio.');
        $this->nombre = $nombre;
    }

    public function setPrecio($precio) {
        $precio = (float)$precio;
        if ($precio <= 0) throw new InvalidArgumentException('El precio debe ser mayor que cero.');
        $this->precio = $precio;
    }

    public function setStock($stock) {
        $stock = (int)$stock;
        if ($stock < 0) throw new InvalidArgumentException('El stock no puede ser negativo.');
        $this->stock = $stock;
    }

    public function reducirStock($cantidad) {
        $cantidad = (int)$cantidad;
        if ($cantidad <= 0) throw new InvalidArgumentException('La cantidad debe ser mayor que cero.');
        if ($cantidad > $this->stock) throw new RuntimeException('Stock insuficiente.');
        $this->stock -= $cantidad;
    }

    abstract public function getTipo();
    abstract public function descripcion();
}
