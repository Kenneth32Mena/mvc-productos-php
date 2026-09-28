<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Productos MVC PHP</title>
<style>
body{font-family:Arial,sans-serif;margin:40px;background:#f6f7fb}
.container{max-width:960px;margin:auto;background:white;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.08)}
.nav{margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #eee;display:flex;gap:12px}
.nav a{padding:8px 14px;text-decoration:none;border-radius:6px;font-weight:bold;color:#1f4e78;background:#e7eef6}
.nav a.active{background:#1f4e78;color:white}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left}
th{background:#f0f4f8;color:#333}
a.button{display:inline-block;padding:10px 14px;background:#1f4e78;color:white;text-decoration:none;border-radius:6px}
a.button:hover{background:#163857}
.badge{padding:4px 8px;background:#e7eef6;border-radius:10px;font-size:12px;font-weight:bold}
.badge-cat{padding:4px 8px;background:#e6f4ea;color:#137333;border-radius:10px;font-size:12px;font-weight:bold}
.btn-delete{color:#c00;text-decoration:none}
.btn-delete:hover{text-decoration:underline}
</style>
</head>
<body>
<div class="container">
<div class="nav">
    <a href="index.php?controller=producto&action=index" class="active">📦 Productos</a>
    <a href="index.php?controller=categoria&action=index">🏷️ Categorías</a>
</div>

<h1>Catálogo de Productos</h1>
<p>Sistema de Productos y Categorías con PHP POO + MVC + MySQL</p>

<a class="button" href="index.php?controller=producto&action=crear">+ Nuevo producto</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if(empty($productos)): ?>
            <tr><td colspan="8" style="text-align:center;color:#888;">No hay productos registrados.</td></tr>
        <?php else: ?>
            <?php foreach($productos as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p->getId()) ?></td>
                <td><strong><?= htmlspecialchars($p->getNombre()) ?></strong></td>
                <td><span class="badge-cat"><?= htmlspecialchars($p->getCategoriaNombre()) ?></span></td>
                <td><span class="badge"><?= htmlspecialchars($p->getTipo()) ?></span></td>
                <td>$<?= number_format($p->getPrecio(), 2) ?></td>
                <td><?= htmlspecialchars($p->getStock()) ?></td>
                <td><?= htmlspecialchars($p->descripcion()) ?></td>
                <td>
                    <a class="btn-delete" href="index.php?controller=producto&action=eliminar&id=<?= $p->getId() ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
</div>
</body>
</html>
