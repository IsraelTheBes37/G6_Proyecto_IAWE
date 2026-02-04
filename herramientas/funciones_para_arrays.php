<?php
// funciones.php - funciones para Agencia SwiftPack

// ---------- Funciones de presentación ----------
function pintarTablaVehiculos($vehiculos) {
    echo "<table class='table'>";
    echo "<tr><th>ID</th><th>Tipo</th><th>Matricula</th><th>Capacidad (kg)</th><th>Disponible</th><th>Km Recorridos</th></tr>";
    foreach ($vehiculos as $v) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($v['id'])."</td>";
        echo "<td>".htmlspecialchars($v['tipo'])."</td>";
        echo "<td>".htmlspecialchars($v['matricula'])."</td>";
        echo "<td>".number_format($v['capacidad'],0,',','.')."</td>";
        echo "<td>".($v['disponible'] ? 'Sí' : 'No')."</td>";
        echo "<td>".number_format($v['km'],0,',','.')."</td>";
        echo "</tr>";
    }
    echo "</table>";
}


// ---------- Funciones utilitarias sobre arrays ----------

// Contar vehículos disponibles
function contarVehiculosDisponibles($vehiculos) {
    $count = 0;
    foreach ($vehiculos as $v) {
        if (!empty($v['disponible'])) $count++;
    }
    return $count;
}

// Sumar capacidad total
function capacidadTotal($vehiculos) {
    $total = 0;
    foreach ($vehiculos as $v) {
        $total += floatval($v['capacidad']);
    }
    return $total;
}

// Filtrar vehículos por tipo (ej: 'Furgoneta', 'Moto', 'Furgón')
function vehiculosPorTipo($vehiculos, $tipo) {
    $res = [];
    foreach ($vehiculos as $v) {
        if ($v['tipo'] === $tipo) $res[] = $v;
    }
    return $res;
}

// Ordenar vehículos por km (asc o desc) - usa uasort para mantener claves
function ordenarVehiculosPorKm(&$vehiculos, $orden='asc') {
    uasort($vehiculos, function($a, $b) use ($orden) {
        if ($a['km'] == $b['km']) return 0;
        if ($orden === 'asc') return ($a['km'] < $b['km']) ? -1 : 1;
        return ($a['km'] > $b['km']) ? -1 : 1;
    });
}


?>
