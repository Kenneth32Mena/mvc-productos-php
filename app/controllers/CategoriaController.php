<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/CategoriaRepository.php';

class CategoriaController extends Controller {
    private $repo;

    public function __construct() {
        $this->repo = new CategoriaRepository();
    }

    public function index() {
        $categorias = $this->repo->listar();
        $this->view('categorias/index', ['categorias' => $categorias]);
    }

    public function crear() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $categoria = new Categoria(
                    0,
                    $_POST['nombre'] ?? '',
                    $_POST['descripcion'] ?? ''
                );
                $this->repo->crear($categoria);
                header('Location: index.php?controller=categoria&action=index');
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        $this->view('categorias/crear', ['error' => $error]);
    }
}
