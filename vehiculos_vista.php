<?php
include("includes/cabecera.php");
include("funciones.php");

// Datos - array multidimensional de vehículos
$vehiculos = [
    "v1" => ["id"=>1, "tipo"=>"Furgoneta", "matricula"=>"1234-ABC", "capacidad"=>1200, "disponible"=>true, "km"=>120000],
    "v2" => ["id"=>2, "tipo"=>"Moto", "matricula"=>"MOTO-01", "capacidad"=>30, "disponible"=>true, "km"=>25000],
    "v3" => ["id"=>3, "tipo"=>"Furgón", "matricula"=>"9999-ZZZ", "capacidad"=>2500, "disponible"=>false, "km"=>340000],
    "v4" => ["id"=>4, "tipo"=>"Furgoneta", "matricula"=>"5678-DEF", "capacidad"=>1000, "disponible"=>true, "km"=>90000],
];

// acciones simples por GET (ordenar/filter)
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    if ($accion === 'ordenar_km') {
        $orden = ($_GET['orden'] ?? 'asc');
        ordenarVehiculosPorKm($vehiculos, $orden);
    } elseif ($accion === 'filtrar_tipo') {
        $tipo = $_GET['tipo'] ?? '';
        $vehiculos = vehiculosPorTipo($vehiculos, $tipo);
    }
}

// mostrar resumen
echo "<h2>Nuestros Vehículos</h2>";
echo "<div class='card'>";
echo "<strong>Total vehículos:</strong> " . count($vehiculos) . "<br>";
echo "<strong>Disponibles:</strong> " . contarVehiculosDisponibles($vehiculos) . "<br>";
echo "<strong>Capacidad total:</strong> " . number_format(capacidadTotal($vehiculos),0,',','.') . " kg";
echo "</div>";

// controles
echo "<div class='controls card'>";
echo "<form method='get' style='display:flex; gap:8px; flex-wrap:wrap; align-items:center;'>";
echo "<label>Ordenar por km:</label>";
echo "<button name='accion' value='ordenar_km'>Asc</button>";
echo "<input type='hidden' name='orden' value='asc'>";
echo "</form>";

echo "<form method='get' style='display:flex; gap:8px; flex-wrap:wrap; align-items:center; margin-top:8px;'>";
echo "<label>Filtrar por tipo:</label>";
echo "<select name='tipo'>";
$tipos = ['Furgoneta','Moto','Furgón'];
foreach ($tipos as $t) {
    echo "<option value='".htmlspecialchars($t)."'>".htmlspecialchars($t)."</option>";
}
echo "</select>";
echo "<button name='accion' value='filtrar_tipo'>Filtrar</button>";
echo "</form>";
echo "</div>";

// mostrar tabla
pintarTablaVehiculos($vehiculos);

include("includes/pie.php");
?>
