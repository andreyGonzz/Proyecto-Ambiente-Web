<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'vocatio');

// Configuración de la URL base
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
define('BASE_URL', $protocol . $domainName . '/Proyecto%20Ambiente%20Web');

// Datos generales del sitio
define('siteName', 'Vocatio');
define('year', date('Y'));
