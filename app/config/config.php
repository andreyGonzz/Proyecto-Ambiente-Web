<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'jose.Ph1193');
define('DB_NAME', 'vocatio');

// Configuración de la URL base
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];

// Raíz del proyecto en el sistema de archivos (app/config -> app -> raíz)
$sitioRaiz = realpath(__DIR__ . '/../..');
$docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$path = '';
if ($sitioRaiz && $docRoot && strpos($sitioRaiz, $docRoot) === 0) {
    // Ruta URL de la raíz del proyecto relativa al document root
    $path = str_replace('\\', '/', substr($sitioRaiz, strlen($docRoot)));
} else {
    // Fallback: derivar del script actual
    $path = dirname($_SERVER['SCRIPT_NAME']);
    if (basename($path) === 'public') {
        $path = dirname($path);
    }
}
$path = rtrim($path, '/\\');
define('BASE_URL', $protocol . $domainName . $path);

// Datos generales del sitio
define('siteName', 'Vocatio');
define('year', date('Y'));
