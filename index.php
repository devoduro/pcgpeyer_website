<?php

// Serve Laravel directly when the hosting document root points at the project
// root instead of the public directory. Apache deployments with mod_rewrite
// are routed through the public directory by .htaccess.
require __DIR__ . '/public/index.php';
