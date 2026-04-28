<?php

// Dynamic BASEURL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
$base_url = $protocol . $domainName . str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));
// Hapus trailing slash jika ada
$base_url = rtrim($base_url, '/');

define('BASEURL', $base_url);

// DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_fried_chicken');
