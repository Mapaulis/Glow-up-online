<?php
/**
 * ROUTER PRINCIPAL DEL PROYECTO GLOWUP
 * Se encarga de cargar controladores, modelos y vistas
 * Autor: Proyecto Final
 */

session_start();

// ---- 1. Conexión a la base de datos ---- //
require_once '../app/config/database.php';
$db = conectarBD(); // función en database.php

// ---- 2. Cargar modelos automáticamente ---- //
spl_autoload_register(function ($clase) {
    $rutaModelo = "../app/models/$clase.php";
    if (file_exists($rutaModelo)) {
        require_once $rutaModelo;
    }
});

// ---- 3. Obtener parámetros del router ---- //
$controller = $_GET['controller'] ?? 'auth';
$action     = $_GET['action'] ?? 'login';

// ---- 4. Resolver si es admin o cliente ---- //
if (strpos($controller, 'admin/') === 0) {
    // ejemplo: admin/producto
    $partes = explode('/', $controller);
    $folder = $partes[0];   // admin
    $file   = ucfirst($partes[1]) . "Controller"; // ProductoController

    $controllerFile = "../app/controllers/$folder/$file.php";
} else {
    $file = ucfirst($controller) . "Controller";
    $controllerFile = "../app/controllers/$file.php";
}

// ---- 5. Verificar que el archivo existe ---- //
if (!file_exists($controllerFile)) {
    die("Controlador no encontrado: $controllerFile");
}

require_once $controllerFile;

// ---- 6. Instanciar el controlador con DB ---- //
$controlador = new $file($db);

// ---- 7. Verificar el método ---- //
if (!method_exists($controlador, $action)) {
    die("La acción '$action' no existe en el controlador '$file'");
}

// ---- 8. Ejecutar la acción ---- //
$controlador->$action();

