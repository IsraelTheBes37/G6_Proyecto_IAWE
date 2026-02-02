<?php
proteger_usuario();
include 'includes/cabecera.php';

$envios = obtener_envios($conexion);
?>

<h2>Listado de envíos</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Estado</th>
        <th>Fecha</th>
    </tr>

    <?php foreach ($envios as $e): ?>
    <tr>
        <td><?= h($e['id']) ?></td>
        <td><?= h($e['nombre'].' '.$e['apellido']) ?></td>
        <td><?= h($e['estado']) ?></td>
        <td><?= h($e['fecha']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include 'includes/pie.php'; ?>
