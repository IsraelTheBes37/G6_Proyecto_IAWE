<?php
session_start();

// ==========================
// INCLUDES PRINCIPALES
// ==========================
require_once 'modelos/modelo.php';
require_once 'herramientas/funciones.php';
require_once 'herramientas/funciones_para_arrays.php';

// ==========================
// CONEXIÓN BBDD
// ==========================
$conexion = conectar_db();

// ==========================
// DATOS ESTÁTICOS (ARRAYS)
// ==========================
$vehiculosBase = [
    ["id"=>1, "tipo"=>"Furgoneta", "matricula"=>"1234-ABC", "capacidad"=>1200, "disponible"=>true, "km"=>120000],
    ["id"=>2, "tipo"=>"Moto", "matricula"=>"MOTO-01", "capacidad"=>30, "disponible"=>true, "km"=>25000],
    ["id"=>3, "tipo"=>"Furgón", "matricula"=>"9999-ZZZ", "capacidad"=>2500, "disponible"=>false, "km"=>340000],
    ["id"=>4, "tipo"=>"Furgoneta", "matricula"=>"5678-DEF", "capacidad"=>1000, "disponible"=>true, "km"=>90000],
];

// ==========================
// ACCIÓN POR DEFECTO
// ==========================
$accion = $_GET['accion'] ?? 'home';

// ==========================
// ROUTER PRINCIPAL
// ==========================
switch ($accion) {

    // ==========================
    // HOME
    // ==========================
    case 'home':
        include 'vistas/home.php';
        break;

    // ==========================
    // LOGIN
    // ==========================
    case 'login':
        $errores = [];
        include 'vistas/login.php';
        break;

    case 'validar_login':

        $correo = trim($_POST['correo'] ?? '');
        $clave  = $_POST['clave'] ?? '';
        $errores = [];

        if ($correo === '') {
            $errores['correo'] = 'Correo obligatorio';
        }
        if ($clave === '') {
            $errores['clave'] = 'Contraseña obligatoria';
        }

        if (!empty($errores)) {
            include 'vistas/login.php';
            exit;
        }

        $usuario = login_usuario($conexion, $correo, $clave);

        if (is_string($usuario)) {
            $errores['login'] = 'Error interno de base de datos';
            include 'vistas/login.php';
            exit;
        }

        if (!$usuario) {
            $errores['login'] = 'Credenciales incorrectas';
            include 'vistas/login.php';
            exit;
        }

        $_SESSION['usuario'] = $usuario;
        header('Location: index.php?accion=dashboard');
        exit;

    // ==========================
    // LOGOUT
    // ==========================
    case 'logout':
        session_destroy();
        header('Location: index.php');
        exit;

    // ==========================
    // REGISTRO
    // ==========================
    case 'registro':
        $errores = [];
        include 'vistas/registro.php';
        break;

    case 'guardar_registro':

        $nombre   = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $correo   = trim($_POST['correo'] ?? '');
        $clave    = $_POST['clave'] ?? '';

        $errores = [];

        if ($nombre === '')   $errores['nombre'] = 'Nombre obligatorio';
        if ($apellido === '') $errores['apellido'] = 'Apellido obligatorio';
        if ($correo === '' || !validar_email($correo)) {
            $errores['correo'] = 'Email no válido';
        }
        if ($clave === '')    $errores['clave'] = 'Contraseña obligatoria';

        if (!empty($errores)) {
            include 'vistas/registro.php';
            exit;
        }

        $resultado = registrar_cliente($conexion, $nombre, $apellido, $correo, $clave);

        if ($resultado !== true) {
            $errorDB = $resultado;
            include 'vistas/registro.php';
            exit;
        }

        $_SESSION['usuario'] = login_usuario($conexion, $correo, $clave);
        header('Location: index.php?accion=dashboard');
        exit;

    // ==========================
    // DASHBOARD
    // ==========================
    case 'dashboard':
        proteger_usuario();
        include 'vistas/dashboard.php';
        break;

    // ==========================
    // SERVICIOS (ARRAYS)
    // ==========================
    case 'servicios':
        include 'vistas/servicios.php';
        break;

    // ==========================
    // VEHÍCULOS (ARRAYS)
    // ==========================
    case 'vehiculos':

        $vehiculos = $vehiculosBase;
        $total = count($vehiculos);
        $disponibles = contarVehiculosDisponibles($vehiculos);
        $capacidadTotal = capacidadTotal($vehiculos);

        include 'vistas/vehiculos.php';
        break;

    case 'ordenar_km':

        $vehiculos = $vehiculosBase;
        $orden = $_GET['orden'] ?? 'asc';

        ordenarVehiculosPorKm($vehiculos, $orden);

        $total = count($vehiculos);
        $disponibles = contarVehiculosDisponibles($vehiculos);
        $capacidadTotal = capacidadTotal($vehiculos);

        include 'vistas/vehiculos.php';
        break;

    case 'filtrar_tipo':

        $vehiculos = $vehiculosBase;
        $tipo = $_GET['tipo'] ?? '';

        if ($tipo !== '') {
            $vehiculos = vehiculosPorTipo($vehiculos, $tipo);
        }

        $total = count($vehiculos);
        $disponibles = contarVehiculosDisponibles($vehiculos);
        $capacidadTotal = capacidadTotal($vehiculos);

        include 'vistas/vehiculos.php';
        break;

    // ==========================
    // LISTA CLIENES
    // ==========================
    case 'listar_clientes':
        include 'vistas/listar_clientes.php';
        break;

    // ==========================
    // LISTAR ENVÍOS
    // ==========================
    case 'listar_envios':

        proteger_usuario();

        if ($_SESSION['usuario']['rol'] === 'admin') {
            $envios = obtener_envios($conexion);
        } else {
            $envios = obtener_envios_cliente(
                $conexion,
                $_SESSION['usuario']['id']
            );
        }

        if (is_string($envios)) {
            die($envios);
        }

        include 'vistas/listar_envios.php';
        break;

    // ==========================
    // CREAR ENVÍO
    // ==========================
    case 'crear_envio':
        proteger_admin();
        $clientes = obtener_clientes($conexion);
        $estados  = obtener_estados($conexion);
        include 'vistas/crear_envio.php';
        break;

    case 'guardar_envio':
        proteger_admin();

        $cliente_id = (int)($_POST['cliente_id'] ?? 0);
        $estado_id  = (int)($_POST['estado_id'] ?? 0);
        $descripcion = trim($_POST['descripcion'] ?? '');

        $errores = [];

        if ($cliente_id <= 0) $errores['cliente'] = 'Cliente obligatorio';
        if ($estado_id <= 0)  $errores['estado'] = 'Estado obligatorio';

        if (!empty($errores)) {
            $clientes = obtener_clientes($conexion);
            $estados  = obtener_estados($conexion);
            include 'vistas/crear_envio.php';
            exit;
        }

        $resultado = insertar_envio($conexion, $cliente_id, $estado_id, $descripcion);

        if ($resultado !== true) {
            $errorDB = $resultado;
            include 'vistas/crear_envio.php';
            exit;
        }

        header('Location: index.php?accion=listar_envios');
        exit;

    // ==========================
    // ELIMINAR ENVÍO
    // ==========================
    case 'eliminar_envio':
        proteger_admin();

        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $resultado = eliminar_envio($conexion, $id);
            if ($resultado !== true) {
                die($resultado);
            }
        }

        header('Location: index.php?accion=listar_envios');
        exit;

    // ==========================
    // ACERCA
    // ==========================
    case 'acerca':
        include 'vistas/acerca.php';
        break;

    // ==========================
    // POR DEFECTO
    // ==========================
    default:
        include 'vistas/home.php';
        break;
}
