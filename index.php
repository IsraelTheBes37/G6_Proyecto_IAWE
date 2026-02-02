<?php
session_start();

require_once 'modelos/modelo.php';
require_once 'herramientas/funciones.php';

// Conectar a la base de datos
$conexion = conectar_db();

// Acción por defecto
$accion = $_GET['accion'] ?? 'home';

// Router principal
switch ($accion) {

    // ==========================
    // HOME (listado envíos)
    // ==========================
    case 'home':
        include 'vistas/home.php';
        break;

    // ==========================
    // LOGIN
    // ==========================
    case 'login':
        include 'vistas/login.php';
        break;

    case 'validar_login':

        // Saneamiento
        $correo = trim($_POST['correo'] ?? '');
        $clave  = $_POST['clave'] ?? '';

        $errores = [];

        // Validación
        if (empty($correo)) {
            $errores['correo'] = 'Correo obligatorio';
        }
        if (empty($clave)) {
            $errores['clave'] = 'Clave obligatoria';
        }

        if (!empty($errores)) {
            include 'vistas/login.php';
            exit;
        }

        // Modelo
        $usuario = login_usuario($conexion, $correo, $clave);

        if (is_string($usuario)) {
            $errorDB = $usuario;
            include 'vistas/login.php';
            exit;
        }

        if (!$usuario) {
            $errores['login'] = 'Credenciales incorrectas';
            include 'vistas/login.php';
            exit;
        }

        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
        exit;

    // ==========================
    // LOGOUT
    // ==========================
    case 'logout':
        session_destroy();
        header('Location: index.php');
        exit;

    // ==========================
    // SERVICIOS
    // ==========================
    case 'servicios':
        include 'vistas/servicios.php';
        break;

    // ==========================
    // VEHÍCULOS
    // ==========================
    case 'vehiculos':
        include 'vistas/vehiculos.php';
        break;

    // ==========================
    // SOBRE NOSOTROS
    // ==========================
    case 'acerca':
        include 'vistas/acerca.php';
        break;

    // ==========================
    // NUEVO ENVÍO (FORMULARIO)
    // ==========================
    case 'nuevo_envio':
        proteger_admin(); // función tuya
        include 'vistas/nuevo_envio.php';
        break;

    // ==========================
    // GUARDAR ENVÍO
    // ==========================
    case 'guardar_envio':
        proteger_admin();

        $cliente_id = (int)($_POST['cliente_id'] ?? 0);
        $estado_id  = (int)($_POST['estado_id'] ?? 0);
        $descripcion = trim($_POST['descripcion'] ?? '');

        $errores = [];

        if ($cliente_id <= 0) {
            $errores['cliente'] = 'Cliente obligatorio';
        }
        if ($estado_id <= 0) {
            $errores['estado'] = 'Estado obligatorio';
        }

        if (!empty($errores)) {
            include 'vistas/nuevo_envio.php';
            exit;
        }

        $resultado = insertar_envio($conexion, $cliente_id, $estado_id, $descripcion);

        if ($resultado !== true) {
            $errorDB = $resultado;
            include 'vistas/nuevo_envio.php';
            exit;
        }

        header('Location: index.php');
        exit;
    
    // ==========================
    // REGISTRO
    // ==========================
    case 'registro':
        include 'vistas/registro.php';
        break;
    
    // ==========================
    // DASHBOOARD
    // ==========================
    case 'dashboard':
        include 'vistas/dashboard.php';
        exit;

    case 'guardar_registro':

        // Recoger datos
        $nombre   = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $correo   = trim($_POST['correo'] ?? '');
        $clave    = $_POST['clave'] ?? '';

        $errores = [];

        // Validaciones
        if ($nombre === '') {
            $errores['nombre'] = 'Nombre obligatorio';
        }
        if ($apellido === '') {
            $errores['apellido'] = 'Apellido obligatorio';
        }
        if ($correo === '' || !validar_email($correo)) {
            $errores['correo'] = 'Email no válido';
        }
        if ($clave === '') {
            $errores['clave'] = 'Contraseña obligatoria';
        }

        // Si hay errores volver al formulario
        if (!empty($errores)) {
            include 'vistas/registro.php';
            exit;
        }

        // Insertar cliente
        $resultado = registrar_cliente($conexion, $nombre, $apellido, $correo, $clave);

        if ($resultado !== true) {
            $errorDB = $resultado;
            include 'vistas/registro.php';
            exit;
        }

        // Login automático tras registro
        $usuario = login_usuario($conexion, $correo, $clave);
        $_SESSION['usuario'] = $usuario;

        header('Location: index.php?accion=dashboard');
        exit;


    // ==========================
    // POR DEFECTO
    // ==========================
    default:
        include 'vistas/home.php';
        break;
}
