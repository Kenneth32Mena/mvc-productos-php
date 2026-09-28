<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/ProductoFisico.php';
require_once __DIR__ . '/ProductoDigital.php';

class ProductoRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function listar() {
        $sql = "SELECT p.*, c.Nombre AS categoria_nombre 
                FROM productos p 
                LEFT JOIN categorias c ON p.Id_Categoria = c.ID 
                ORDER BY p.id DESC";
        $stmt = $this->db->query($sql);
        $items = [];
        foreach ($stmt->fetchAll() as $row) {
            $items[] = $this->mapear($row);
        }
        return $items;
    }

    public function crear(Producto $producto) {
        $sql = "INSERT INTO productos(Id_Categoria, nombre, precio, stock, tipo, peso, url_descarga)
                VALUES(:categoria_id, :nombre, :precio, :stock, :tipo, :peso, :url)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':categoria_id' => $producto->getCategoriaId(),
            ':nombre'       => $producto->getNombre(),
            ':precio'       => $producto->getPrecio(),
            ':stock'        => $producto->getStock(),
            ':tipo'         => $producto->getTipo(),
            ':peso'         => $producto instanceof ProductoFisico ? $producto->getPeso() : null,
            ':url'          => $producto instanceof ProductoDigital ? $producto->getUrlDescarga() : null
        ]);
        return $this->db->lastInsertId();
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        $stmt->execute([':id' => (int)$id]);
    }

    private function mapear($row) {
        $catNombre = $row['categoria_nombre'] ?? 'Sin categoría';
        if ($row['tipo'] === 'DIGITAL') {
            return new ProductoDigital(
                $row['id'], 
                $row['Id_Categoria'], 
                $row['nombre'], 
                $row['precio'], 
                $row['stock'], 
                $row['url_descarga'], 
                $catNombre
            );
        }
        return new ProductoFisico(
            $row['id'], 
            $row['Id_Categoria'], 
            $row['nombre'], 
            $row['precio'], 
            $row['stock'], 
            $row['peso'], 
            $catNombre
        );
    }
}
