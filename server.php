<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve CSS files with correct MIME type
if (preg_match('/\.css$/', $uri)) {
    header('Content-Type: text/css');
    readfile(__DIR__ . '/public' . $uri);
    exit;
}

// Serve JS files with correct MIME type  
if (preg_match('/\.js$/', $uri)) {
    header('Content-Type: application/javascript');
    readfile(__DIR__ . '/public' . $uri);
    exit;
}

// Serve images
if (preg_match('/\.(jpg|jpeg|png|gif|svg|ico)$/', $uri)) {
    $info = pathinfo($uri);
    $ext = $info['extension'];
    
    $mimeTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon'
    ];
    
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
        readfile(__DIR__ . '/public' . $uri);
        exit;
    }
}

require_once __DIR__ . '/public/index.php';
