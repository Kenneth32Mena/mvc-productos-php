<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/Categoria.php';

class CategoriaRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function listar() {
        $stmt = $this->db->query("SELECT * FROM categorias ORDER BY ID ASC");
        $items = [];
        foreach ($stmt->fetchAll() as $row) {
            $items[] = new Categoria($row['ID'], $row['Nombre'], $row['Descripcion']);
        }
        return $items;
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM categorias WHERE ID = :id");
        $stmt->execute([':id' => (int)$id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        return new Categoria($row['ID'], $row['Nombre'], $row['Descripcion']);
    }

    public function crear(Categoria $categoria) {
        $sql = "INSERT INTO categorias (Nombre, Descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nombre' => $categoria->getNombre(),
            ':descripcion' => $categoria->getDescripcion()
        ]);
        return $this->db->lastInsertId();
    }
}
