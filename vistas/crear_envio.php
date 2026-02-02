<?php
proteger_admin();
include 'includes/cabecera.php';

$clientes = obtener_clientes($conexion);
$estados  = obtener_estados($conexion);
?>

<h2>Nuevo envío</h2>

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
    </select>

    <label>Descripción</label>
    <textarea name="descripcion"></textarea>

    <?php if (!empty($errorDB)) echo "<p class='error'>$errorDB</p>"; ?>

    <button type="submit">Guardar</button>
</form>

<?php include 'includes/pie.php'; ?>
