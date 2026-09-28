<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Categorías - MVC PHP</title>
<style>
body{font-family:Arial,sans-serif;margin:40px;background:#f6f7fb}
.container{max-width:900px;margin:auto;background:white;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.08)}
.nav{margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #eee;display:flex;gap:12px}
.nav a{padding:8px 14px;text-decoration:none;border-radius:6px;font-weight:bold;color:#1f4e78;background:#e7eef6}
.nav a.active{background:#1f4e78;color:white}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left}
th{background:#f0f4f8;color:#333}
a.button{display:inline-block;padding:10px 14px;background:#1f4e78;color:white;text-decoration:none;border-radius:6px}
a.button:hover{background:#163857}
</style>
</head>
<body>
<div class="container">
<div class="nav">
    <a href="index.php?controller=producto&action=index">📦 Productos</a>
    <a href="index.php?controller=categoria&action=index" class="active">🏷️ Categorías</a>
</div>

<h1>Gestión de Categorías</h1>
<p>Listado de categorías registradas en el sistema</p>

<a class="button" href="index.php?controller=categoria&action=crear">+ Nueva Categoría</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <?php if(empty($categorias)): ?>
            <tr><td colspan="3" style="text-align:center;color:#888;">No hay categorías registradas.</td></tr>
        <?php else: ?>
            <?php foreach($categorias as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c->getId()) ?></td>
                <td><strong><?= htmlspecialchars($c->getNombre()) ?></strong></td>
                <td><?= htmlspecialchars($c->getDescripcion()) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
</div>
</body>
</html>
