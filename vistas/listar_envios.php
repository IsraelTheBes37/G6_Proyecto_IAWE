<?php
proteger_usuario();
include 'includes/cabecera.php';

$envios = obtener_envios($conexion);
?>

<h2>Listado de envíos</h2>

<table class="tabla-envios">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Estado</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Acción</th>
    </tr>

    <?php foreach ($envios as $e): ?>
    <tr>
        <td><?= h($e['id']) ?></td>
        <td><?= h($e['nombre'].' '.$e['apellido']) ?></td>
        <td><?= h($e['estado']) ?></td>
        <td><?= h($e['descripcion']) ?></td>
        <td><?= h($e['fecha']) ?></td>

        <?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
            <td>
                <a href="index.php?accion=eliminar_envio&id=<?= $e['id'] ?>"
                    class="btn btn-danger"
                    onclick="return confirm('¿Eliminar este envío?')">
                    🗑 Eliminar
                </a>
            </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>

<?php include 'includes/pie.php'; ?>
