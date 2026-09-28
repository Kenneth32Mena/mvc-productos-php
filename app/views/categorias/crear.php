<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Nueva Categoría</title>
<style>
body{font-family:Arial,sans-serif;margin:40px;background:#f6f7fb}
form{max-width:520px;margin:auto;background:white;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.08)}
label{display:block;margin-top:14px;font-weight:bold;color:#333}
input,textarea{width:100%;padding:10px;margin-top:4px;border:1px solid #ccc;border-radius:6px;box-sizing:border-box}
button{margin-top:18px;padding:10px 16px;background:#1f4e78;color:white;border:none;border-radius:6px;cursor:pointer;font-weight:bold}
button:hover{background:#163857}
a.btn-back{display:inline-block;margin-left:10px;color:#555;text-decoration:none}
.error{background:#fee;color:#c00;padding:10px;border-radius:6px;margin-bottom:12px}
</style>
</head>
<body>
<form method="post">
    <h1>Nueva Categoría</h1>
    <?php if(!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <label for="nombre">Nombre de la Categoría</label>
    <input id="nombre" name="nombre" placeholder="Ej: Electrónica, Computadoras..." required>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="descripcion" rows="3" placeholder="Breve descripción de la categoría..." required></textarea>

    <button type="submit">Guardar Categoría</button>
    <a href="index.php?controller=categoria&action=index" class="btn-back">Volver al listado</a>
</form>
</body>
</html>
