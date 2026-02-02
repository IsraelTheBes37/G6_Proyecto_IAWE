<?php
include("includes/cabecera.php");
include("funciones.php");

// datos servicios
$servicios = [
    ["id"=>1,"nombre"=>"Envío estándar peninsular","zona"=>"Peninsular","precio"=>6.90,"tiempo"=>48],
    ["id"=>2,"nombre"=>"Envío urgente peninsular","zona"=>"Peninsular","precio"=>12.50,"tiempo"=>24],
    ["id"=>3,"nombre"=>"Envío islas (Baleares/Canarias)","zona"=>"Islas","precio"=>18.00,"tiempo"=>72],
    ["id"=>4,"nombre"=>"Entrega en 2h (ciudades)","zona"=>"Local","precio"=>9.99,"tiempo"=>2],
    ["id"=>5,"nombre"=>"Recogida programada","zona"=>"Peninsular","precio"=>4.50,"tiempo"=>48],
];

// acciones: aumentar precio global (+10%), cambiar precio individual
if (isset($_GET['accion'])) {
    if ($_GET['accion'] === 'aumentar') {
        aumentarPrecioServicios($servicios, 10);
    } elseif ($_GET['accion'] === 'cambiar' && isset($_GET['id'], $_GET['nuevo'])) {
        cambiarPrecioServicio($servicios, intval($_GET['id']), floatval($_GET['nuevo']));
    } elseif ($_GET['accion'] === 'filtrar_zona' && isset($_GET['zona'])) {
        $zona = $_GET['zona'];
        $servicios = array_filter($servicios, fn($s)=> $s['zona'] === $zona);
    }
}

// mostrar
echo "<h2>Servicios</h2>";
echo "<div class='card'>";
echo "<strong>Zonas disponibles:</strong> ";
$zonas = zonasUnicas($servicios);
echo implode(" • ", $zonas);
echo "</div>";

// controles
echo "<div class='controls card'>";
echo "<form method='get' style='display:flex; gap:8px; align-items:center;'>";
echo "<button name='accion' value='aumentar'>Aumentar precios +10%</button>";
echo "</form>";

echo "<form method='get' style='display:flex; gap:8px; align-items:center; margin-top:8px;'>";
echo "<label>Filtrar zona:</label>";
echo "<select name='zona'>";
echo "<option value=''>--</option>";
foreach ($zonas as $z) echo "<option value='".htmlspecialchars($z)."'>".htmlspecialchars($z)."</option>";
echo "</select>";
echo "<button name='accion' value='filtrar_zona'>Filtrar</button>";
echo "</form>";

echo "<form method='get' style='display:flex; gap:8px; align-items:center; margin-top:8px;'>";
echo "Cambiar precio id: <input type='number' name='id' style='width:80px'>";
echo " Nuevo (€): <input step='0.01' type='number' name='nuevo' style='width:120px'>";
echo "<button name='accion' value='cambiar'>Cambiar</button>";
echo "</form>";

echo "</div>";

// tabla servicios
pintarTablaServicios($servicios);

// cálculo ejemplo de coste estimado (usar servicio id=2, peso 5kg, 30km)
$serv = buscarServicioPorId($servicios, 2);
if ($serv) {
    $coste = estimarCoste($serv, 5, 30);
    echo "<div class='card small'>Ejemplo: coste estimado (Envío urgente, 5kg, 30km): <strong>".number_format($coste,2,'.','')."€</strong></div>";
}

include("includes/pie.php");
?>
