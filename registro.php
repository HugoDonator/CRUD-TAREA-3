<?php

date_default_timezone_set('Anerica/Santo_Domingo');

$matricula = $nombre = $apellido = $curso = $motivo='';
$editando= false;
$archivo="tardanza.dat";

if (isset($_GET['id'])){
    $id= $_GET['id'];
    $tardanzas= @file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];

    foreach ($tardanzas as $linea){
        $valores= explode("," , trim($linea));
        if(count($valores )>=6 && $valores[0]==$id){
            list($matricula, $nombre, $apellido, $curso,$motivo, $fechaHora)=$valores;
            $editando=true;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD']==='POST'){
    $matricula= trim($_POST['matricula']);
    $nombre= trim($_POST['nombre']);
    $apellido= trim($_POST['mapellido']);
    $curso= trim($_POST['curso']);
    $motivo= trim($_POST['motivo']);
    $fechaHora= date('Y-m-d H:i:s');

    $tardanzas= @file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    $actualizado=false;
    $nuevasTardanzas=[];

    // Recorrer los registros y actualizar si es necesario
    foreach ($tardanzas as $linea) {
        $valores = explode(",", trim($linea));
        if (count($valores) >= 6) {
            if ($valores[0] == $matricula) { // Si la matrícula coincide, actualizar los datos
                $nuevasTardanzas[] = "$matricula,$nombre,$apellido,$curso,$motivo,$fechaHora";
                $actualizado = true;
            } else {
                $nuevasTardanzas[] = $linea; // Conservar el resto de los registros
            }
        }
    }

    // Si no se encontró el registro en el archivo, agregar uno nuevo
    if (!$actualizado) {
        $nuevasTardanzas[] = "$matricula,$nombre,$apellido,$curso,$motivo,$fechaHora";
    }

    // Guardar los cambios en el archivo
    file_put_contents($archivo, implode("\n", $nuevasTardanzas) . "\n");
    header("Location: index.php"); // Redirigir a la página principal
    exit();
}

?>


























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$editando ? 'Editar' : 'Registrar' ?> Tardanza</title>
    <link rel="Stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h1 class="text-center mb-4"> <?= $editando ? 'Editar': 'Registrar' ?>Tardanza</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="matricula" class="form-label">Matricula</label>
            <input type="text" class="form-control" id="matricula" name="matricula" value="<?= htmlspecialchars($matricula) ?>" <?=$editando ? 'readonly' : '' ?>required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre) ?>"required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($apellido) ?>"required>
        </div>
        <div class="mb-3">
            <label for="curso" class="form-label">Curso</label>
            <input type="text" class="form-control" id="curso" name="curso" value="<?= htmlspecialchars($curso) ?>"required>
        </div>
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>
            <textarea class="form-control" id="motivo" name="motivo" value="<?= htmlspecialchars($motivo) ?>"required></textarea>
        </div>

        <button type="submit" class="btn btn-sucess"><?=$editando ? 'Guardar Cambios': 'Resgistrar tardanza' ?></button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php';">Volver</button>

    </form>
</body>
</html>