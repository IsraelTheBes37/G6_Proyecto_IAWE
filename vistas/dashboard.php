<?php
proteger_usuario();
include 'includes/cabecera.php';
//include("../includes/cabecera.php");
?>

<h2>Panel de control</h2>

<div class="card">
    <p><strong>Bienvenido:</strong> <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></p>
    <p><strong>Rol:</strong> <?= $_SESSION['usuario']['rol'] ?></p>
</div>

<?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
    <div class="card">
        <h3>Zona administrador</h3>
        <ul>
            <li><a href="crear_envio.php">➕ Crear envío</a></li>
            <li><a href="listar_envios.php">📦 Ver envíos</a></li>
        </ul>
    </div>
<?php else: ?>
    <div class="card">
        <h3>Mis envíos</h3>
        <a href="index.php?accion=listar_envios">📦 Ver envíos</a>
    </div>
<?php endif; ?>

<a href="../logout.php">Cerrar sesión</a>

<?php include("../includes/pie.php"); ?>
