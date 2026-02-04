<?php
proteger_usuario();
include 'includes/cabecera.php';

$clientes = obtener_clientes($conexion);
?>

<h2>Listado de Clientes</h2>

<table class="tabla-envios">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
    </tr>

    <?php foreach ($clientes as $c): ?>
    <tr>
        <td><?= h($c['id']) ?></td>
        <td><?= h($c['nombre']) ?></td>
        <td><?= h($c['apellido']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include 'includes/pie.php'; ?>
