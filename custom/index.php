<?php
// Encabezado visible para demostrar el despliegue automatizado
echo "<h1 style='color:red; text-align:center; margin-top:40px;'>
  WordPress desplegado por pipeline CI/CD (build: " . date('Y-m-d H:i:s') . ")
</h1>";

// Llamamos al WordPress real
require __DIR__ . '/../wp-blog-header.php';