<?php
$id= $_GET['id']?? null;

$archivo="tardanzas.dat";

if ($id && file_exists($archivo)){
    $tardanzas= file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $tardanzas= array_filter($tardanzas, fn($linea) => explode(",", $linea)[0] !==$id);

    file_put_contents($archivo, implode("\n", $tardanzas). "\n");

    Header("Location: index.php");
    exit();
}
?>