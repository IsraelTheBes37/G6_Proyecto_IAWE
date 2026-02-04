<?php
include("includes/cabecera.php");

// El controlador debe enviar:
// $vehiculos
// $total
// $disponibles
// $capacidadTotal
?>

<h2>Nuestros Vehículos</h2>

<div class='card'>
    <strong>Total vehículos:</strong> <?= $total ?><br>
    <strong>Disponibles:</strong> <?= $disponibles ?><br>
    <strong>Capacidad total:</strong> <?= number_format($capacidadTotal, 0, ',', '.') ?> kg
</div>

<div class='controls card'>

    <!-- Ordenar -->
    <form method='get' style='display:flex; gap:8px; flex-wrap:wrap; align-items:center;'>
        <label>Ordenar por km:</label>
        <input type='hidden' name='accion' value='ordenar_km'>
        <select name='orden'>
            <option value='asc'>Ascendente</option>
            <option value='desc'>Descendente</option>
        </select>
        <button type='submit'>Ordenar</button>
    </form>

    <!-- Filtrar -->
    <form method='get' style='display:flex; gap:8px; flex-wrap:wrap; align-items:center; margin-top:8px;'>
        <label>Filtrar por tipo:</label>
        <select name='tipo'>
            <option value=''>Todos</option>
            <option value='Furgoneta'>Furgoneta</option>
            <option value='Moto'>Moto</option>
            <option value='Furgón'>Furgón</option>
        </select>
        <input type='hidden' name='accion' value='filtrar_tipo'>
        <button type='submit'>Filtrar</button>
    </form>

</div>

<?php pintarTablaVehiculos($vehiculos); ?>

<?php include("includes/pie.php"); ?>