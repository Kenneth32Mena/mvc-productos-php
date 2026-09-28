<?php
require_once __DIR__ . '/Producto.php';

class ProductoFisico extends Producto {
    private $peso;

    public function __construct($id, $categoriaId, $nombre, $precio, $stock, $peso = 0, $categoriaNombre = '') {
        parent::__construct($id, $categoriaId, $nombre, $precio, $stock, $categoriaNombre);
        $this->peso = (float)$peso;
    }

    public function getPeso() { return $this->peso; }
    public function getTipo() { return 'FISICO'; }

    public function descripcion() {
        return $this->nombre . ' - Producto físico (' . $this->peso . ' kg)';
    }
}
