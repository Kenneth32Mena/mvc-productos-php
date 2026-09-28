<?php
require_once __DIR__ . '/Producto.php';

class ProductoDigital extends Producto {
    private $urlDescarga;

    public function __construct($id, $categoriaId, $nombre, $precio, $stock, $urlDescarga = '', $categoriaNombre = '') {
        parent::__construct($id, $categoriaId, $nombre, $precio, $stock, $categoriaNombre);
        $this->urlDescarga = trim($urlDescarga);
    }

    public function getUrlDescarga() { return $this->urlDescarga; }
    public function getTipo() { return 'DIGITAL'; }

    public function descripcion() {
        return $this->nombre . ' - Producto digital (' . $this->urlDescarga . ')';
    }
}
