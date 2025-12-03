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

function pintarTablaServicios($servicios) {
    echo "<table class='table'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Zona</th><th>Precio base (€)</th><th>Tiempo estimado (h)</th></tr>";
    foreach ($servicios as $s) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($s['id'])."</td>";
        echo "<td>".htmlspecialchars($s['nombre'])."</td>";
        echo "<td>".htmlspecialchars($s['zona'])."</td>";
        echo "<td>".number_format($s['precio'],2,'.','')."</td>";
        echo "<td>".intval($s['tiempo'])."</td>";
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

// Aumentar precio de todos los servicios en porcentaje (ej 10 -> +10%)
function aumentarPrecioServicios(&$servicios, $porcentaje) {
    foreach ($servicios as &$s) {
        $s['precio'] *= (1 + $porcentaje/100);
    }
    unset($s);
}

// Buscar servicio por id devuelve index o null
function buscarServicioPorId($servicios, $id) {
    foreach ($servicios as $s) {
        if ($s['id'] == $id) return $s;
    }
    return null;
}

// Editar el precio de un servicio por id
function cambiarPrecioServicio(&$servicios, $id, $nuevoPrecio) {
    foreach ($servicios as &$s) {
        if ($s['id'] == $id) {
            $s['precio'] = floatval($nuevoPrecio);
            return true;
        }
    }
    unset($s);
    return false;
}

// Extraer todas las zonas disponibles (array único)
function zonasUnicas($servicios) {
    $zonas = [];
    foreach ($servicios as $s) $zonas[] = $s['zona'];
    return array_values(array_unique($zonas));
}

// Calcular coste estimado de envío según servicio, peso y distancia (ejemplo de uso)
function estimarCoste($servicio, $pesoKg, $km) {
    // fórmula simple: precio base + 0.5€/kg + 0.15€/km
    $base = floatval($servicio['precio']);
    $coste = $base + (0.5 * $pesoKg) + (0.15 * $km);
    return $coste;
}
?>
