<?php
/**
 * Funciones auxiliares del proyecto
 */

/**
 * Protege rutas solo para usuarios logueados
 */
function proteger_usuario() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?accion=login');
        exit;
    }
}

/**
 * Protege rutas solo para admin
 */
function proteger_admin() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
        header('Location: index.php?accion=login');
        exit;
    }
}

/**
 * Escape seguro para HTML
 */
function h($texto) {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}


/**
 * Validar email
 */
function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
