<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Nuevo Producto</title>
<style>
body{font-family:Arial,sans-serif;margin:40px;background:#f6f7fb}
form{max-width:520px;margin:auto;background:white;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.08)}
label{display:block;margin-top:14px;font-weight:bold;color:#333}
input,select{width:100%;padding:10px;margin-top:4px;border:1px solid #ccc;border-radius:6px;box-sizing:border-box}
button{margin-top:18px;padding:10px 16px;background:#1f4e78;color:white;border:none;border-radius:6px;cursor:pointer;font-weight:bold}
button:hover{background:#163857}
a.btn-back{display:inline-block;margin-left:10px;color:#555;text-decoration:none}
.error{background:#fee;color:#c00;padding:10px;border-radius:6px;margin-bottom:12px}
.hint{font-size:12px;color:#777}
</style>
</head>
<body>
<form method="post">
    <h1>Nuevo Producto</h1>
    <?php if(!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <label for="nombre">Nombre del Producto</label>
    <input id="nombre" name="nombre" placeholder="Ej: Laptop Dell Inspiron" required>

    <label for="categoria_id">Categoría</label>
    <select id="categoria_id" name="categoria_id" required>
        <option value="">-- Selecciona una categoría --</option>
        <?php if(!empty($categorias)): ?>
            <?php foreach($categorias as $cat): ?>
                <option value="<?= htmlspecialchars($cat->getId()) ?>">
                    <?= htmlspecialchars($cat->getNombre()) ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>

    <label for="precio">Precio ($)</label>
    <input id="precio" name="precio" type="number" step="0.01" min="0.01" placeholder="Ej: 600.00" required>

    <label for="stock">Stock</label>
    <input id="stock" name="stock" type="number" min="0" placeholder="Ej: 10" required>

    <label for="tipo">Tipo de Producto</label>
    <select id="tipo" name="tipo" onchange="toggleCampos(this.value)">
        <option value="FISICO">Físico (requiere peso)</option>
        <option value="DIGITAL">Digital (requiere URL de descarga)</option>
    </select>

    <div id="campo_peso">
        <label for="peso">Peso en Kg (solo físico)</label>
        <input id="peso" name="peso" type="number" step="0.01" placeholder="Ej: 1.5">
    </div>

    <div id="campo_digital" style="display:none;">
        <label for="url_descarga">URL de descarga (solo digital)</label>
        <input id="url_descarga" name="url_descarga" type="url" placeholder="https://ejemplo.com/descarga.zip">
    </div>

    <button type="submit">Guardar Producto</button>
    <a href="index.php?controller=producto&action=index" class="btn-back">Volver al catálogo</a>
</form>

<script>
function toggleCampos(tipo) {
    if (tipo === 'DIGITAL') {
        document.getElementById('campo_peso').style.display = 'none';
        document.getElementById('campo_digital').style.display = 'block';
    } else {
        document.getElementById('campo_peso').style.display = 'block';
        document.getElementById('campo_digital').style.display = 'none';
    }
}
</script>
</body>
</html>
