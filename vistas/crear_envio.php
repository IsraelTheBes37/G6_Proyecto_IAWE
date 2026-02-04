<?php
proteger_admin();
include 'includes/cabecera.php';

$clientes = obtener_clientes($conexion);
$estados  = obtener_estados($conexion);
?>

<h2>Nuevo envío</h2>

<div class="card-form">
    <form action="index.php?accion=guardar_envio" method="post">

        <label>Cliente</label>
        <select name="cliente_id">
            <option value="">Seleccione</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['id'] ?>">
                    <?= h($c['nombre'].' '.$c['apellido']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Estado</label>
        <select name="estado_id">
            <option value="">Seleccione</option>
            <?php foreach ($estados as $e): ?>
                <option value="<?= $e['id'] ?>">
                    <?= h($e['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Descripción</label><br>
        <textarea name="descripcion"></textarea>

        <?php if (!empty($errorDB)) echo "<p class='error'>$errorDB</p>"; ?>

        <div class="form-controls">
            <button type="submit">Guardar</button>
        </div>
    </form>
</div>

<?php include 'includes/pie.php'; ?>
