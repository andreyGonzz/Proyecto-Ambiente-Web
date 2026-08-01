<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '131106');
define('DB_NAME', 'vocatio');

// Configuración de la URL base
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
$path = dirname($_SERVER['SCRIPT_NAME']);
if (basename($path) === 'public') {
    $path = dirname($path);
}
$path = rtrim($path, '/\\');
define('BASE_URL', $protocol . $domainName . $path);

// Datos generales del sitio
define('siteName', 'Vocatio');
define('year', date('Y'));
