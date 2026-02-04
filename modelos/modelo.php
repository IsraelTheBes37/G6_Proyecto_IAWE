<?php

function conectar_db() {
    $conexion = mysqli_connect('localhost','root','','swiftpack');
    if (!$conexion) {
        die("Error conexión BBDD");
    }
    mysqli_set_charset($conexion, 'utf8mb4');
    return $conexion;
}

/* =========================
   LOGIN
========================= */
function login_usuario($con, $correo, $clave) {
    $correo = mysqli_real_escape_string($con, $correo);
    $clave = hash('sha256', $clave);

    $sql = "SELECT * FROM usuarios 
            WHERE correo='$correo' AND clave='$clave'";
    $res = mysqli_query($con, $sql);

    if (!$res) return mysqli_error($con);
    return mysqli_fetch_assoc($res);
}

/* =========================
   USUARIOS
========================= */
function obtener_clientes($con) {
    $sql = "SELECT id, nombre, apellido FROM usuarios WHERE rol='cliente'";
    $res = mysqli_query($con, $sql);
    if (!$res) return mysqli_error($con);

    $clientes = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $clientes[] = $row;
    }
    return $clientes;
}

/* =========================
   ESTADOS
========================= */
function obtener_estados($con) {
    $sql = "SELECT * FROM estados";
    $res = mysqli_query($con, $sql);
    if (!$res) return mysqli_error($con);

    $estados = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $estados[] = $row;
    }
    return $estados;
}

/* =========================
   INSERTAR ENVIOS
========================= */
function insertar_envio($con, $cliente_id, $estado_id, $descripcion) {
    $descripcion = mysqli_real_escape_string($con, $descripcion);

    $sql = "INSERT INTO envios (cliente_id, estado_id, descripcion)
            VALUES ($cliente_id, $estado_id, '$descripcion')";
    if (!mysqli_query($con, $sql)) {
        return mysqli_error($con);
    }
    return true;
}

/* =========================
   LISTAR ENVIOS
========================= */
function obtener_envios($con) {
    $sql = "SELECT e.id, u.nombre, u.apellido, es.nombre AS estado, e.descripcion, e.fecha
            FROM envios e
            JOIN usuarios u ON e.cliente_id=u.id
            JOIN estados es ON e.estado_id=es.id
            ORDER BY e.fecha DESC";
    $res = mysqli_query($con, $sql);
    if (!$res) return mysqli_error($con);

    $envios = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $envios[] = $row;
    }
    return $envios;
}

/* =========================
   REGISTRO CLIENTE
========================= */
function registrar_cliente($con, $nombre, $apellido, $correo, $clave) {

    // Saneamiento SQL
    $nombre   = mysqli_real_escape_string($con, $nombre);
    $apellido = mysqli_real_escape_string($con, $apellido);
    $correo   = mysqli_real_escape_string($con, $correo);
    $clave    = hash('sha256', $clave);

    $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave, rol)
            VALUES ('$nombre','$apellido','$correo','$clave','cliente')";

    if (!mysqli_query($con, $sql)) {
        return mysqli_error($con);
    }
    return true;
}

/* =========================
   ENVIOS POR CLIENTE
========================= */
function obtener_envios_cliente($con, $cliente_id) {

    $cliente_id = (int)$cliente_id;

    $sql = "SELECT e.id, es.nombre AS estado, e.descripcion, e.fecha
            FROM envios e
            JOIN estados es ON e.estado_id = es.id
            WHERE e.cliente_id = $cliente_id
            ORDER BY e.fecha DESC";

    $res = mysqli_query($con, $sql);
    if (!$res) return mysqli_error($con);

    $envios = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $envios[] = $row;
    }
    return $envios;
}

/* =========================
   ELIMINAR ENVIO (ADMIN)
========================= */
function eliminar_envio($con, $id) {
    $id = (int)$id;

    $sql = "DELETE FROM envios WHERE id=$id";
    if (!mysqli_query($con, $sql)) {
        return mysqli_error($con);
    }
    return true;
}

/* =========================
   OBTENER ENVIO POR ID
========================= */
function obtener_envio_por_id($con, $id) {

    $id = (int)$id;

    $sql = "SELECT * FROM envios WHERE id = $id";
    $res = mysqli_query($con, $sql);

    if (!$res) return mysqli_error($con);
    return mysqli_fetch_assoc($res);
}

/* =========================
   ACTUALIZAR ENVIO
========================= */
function actualizar_envio($con, $id, $estado_id, $descripcion) {

    $id = (int)$id;
    $estado_id = (int)$estado_id;
    $descripcion = mysqli_real_escape_string($con, $descripcion);

    $sql = "UPDATE envios
            SET estado_id = $estado_id,
                descripcion = '$descripcion'
            WHERE id = $id";

    if (!mysqli_query($con, $sql)) {
        return mysqli_error($con);
    }
    return true;
}


