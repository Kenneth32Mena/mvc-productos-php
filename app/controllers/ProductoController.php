<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/ProductoRepository.php';
require_once __DIR__ . '/../models/CategoriaRepository.php';

class ProductoController extends Controller {
    private $repo;
    private $categoriaRepo;

    public function __construct() {
        $this->repo = new ProductoRepository();
        $this->categoriaRepo = new CategoriaRepository();
    }

    public function index() {
        $this->view('productos/index', [
            'productos' => $this->repo->listar()
        ]);
    }

    public function crear() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $tipo = $_POST['tipo'] ?? 'FISICO';
                $categoriaId = $_POST['categoria_id'] ?? 0;
                
                if ($tipo === 'DIGITAL') {
                    $producto = new ProductoDigital(
                        0,
                        $categoriaId,
                        $_POST['nombre'] ?? '',
                        $_POST['precio'] ?? 0,
                        $_POST['stock'] ?? 0,
                        $_POST['url_descarga'] ?? ''
                    );
                } else {
                    $producto = new ProductoFisico(
                        0,
                        $categoriaId,
                        $_POST['nombre'] ?? '',
                        $_POST['precio'] ?? 0,
                        $_POST['stock'] ?? 0,
                        $_POST['peso'] ?? 0
                    );
                }
                $this->repo->crear($producto);
                header('Location: index.php?controller=producto&action=index');
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $categorias = $this->categoriaRepo->listar();
        $this->view('productos/crear', [
            'error' => $error,
            'categorias' => $categorias
        ]);
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->repo->eliminar($_GET['id']);
        }
        header('Location: index.php?controller=producto&action=index');
        exit;
    }
}
