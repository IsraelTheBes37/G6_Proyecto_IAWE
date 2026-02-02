<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>SwiftPack - Agencia de Paquetería</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <div class="brand">
            <img src="images/Copilot_logo.png" alt="SwiftPack" class="logo">
            <h1>Agencia de Paquetería</h1>
        </div>
        <nav class="main-nav">
            <a href="index.php">Inicio</a>
            <a href="index.php?accion=servicios">Servicios</a>
            <a href="index.php?accion=vehiculos">Vehículos</a>
            <a href="index.php?accion=acerca">Sobre nosotros</a>

            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="index.php?accion=dashboard">Dashboard</a>
                <a href="index.php?accion=logout">Salir</a>
            <?php else: ?>
                <a href="index.php?accion=login">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
