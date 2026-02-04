<?php
include("includes/cabecera.php");
?>
<section class="hero card">
    <h2>SwiftPack — Envíos rápidos y seguros</h2>
    <p>Servicio de paquetería a domicilio con cobertura nacional en España. Rutas optimizadas, vehículos adaptados y seguimiento en tiempo real.</p>
</section>

<section class="card">
    <h3>¿Por qué elegir SwiftPack?</h3>
    <ul>
        <li>Entrega en 24-48h en la mayoría de destinos peninsulares.</li>
        <li>Vehículos para todo tipo de paquetería: furgonetas, furgones y motos.</li>
        <li>Seguimiento de envíos y atención al cliente.</li>
    </ul>
</section>

<section class="card">
    <h3>Acciones rápidas</h3>
    <div class="controls">
        <a class="button" href="index.php?accion=servicios"><button>Ver servicios</button></a>
        <a href="index.php?accion=vehiculos"><button>Ver vehículos</button></a>
        <!-- AÑADIDO MÍNIMO -->
        <?php if (!isset($_SESSION['usuario'])): ?>
                <a href="index.php?accion=login"><button>Iniciar sesión</button></a>
                <a href="index.php?accion=registro"><button>Registrarse</button></a>
        <?php endif; ?>

    </div>
</section>



<?php
include("includes/pie.php");
?>
