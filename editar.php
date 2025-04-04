<?php

$id= $_GET['id']?? null;

$tardanzas= file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$registro=null;

foreach($tardanzas as &$linea){
    $tardanza= explode(",", $linea);
    if($tardanza[0]==$id){
        $registro= $tardanza;
        break;
    }


}

if ($_SERVER['REQUEST_METHOD']=='POST' && $registro){
    [$_POST['matricula'], $_POST['nombre'], $_POST['apellido'], $_POST['curso'], $_POST['motivo'], date('Y-m-d H:i:s')];

    foreach($tardanzas as $linea){
        if (explode(",", $linea)[0]==$id){
            $linea= implode(",", $registro);
        }
    }

    file_put_contents("tardanzas.dat", implode("\n", $tardanzas));

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tardanza</title>
    <link rel="Stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Editar tardanzas</h1>

        <?php if($registro): ?>
        <form method="POST">
            <?php
            $labels=["Matricula","Nombre","Apellido","Curso","Motivo",];

            foreach($labels as $i => $label): ?>
            <div class="mb-3">
                <label class="form-label"><?php echo $label; ?></label>
                <input type="text" class="form-control" name="<?php echo strtolower($label); ?>" value="<?php echo htmlspecialchars($registro[$i]); ?>" <?php echo $i === 0 ? 'readonly' : 'required'; ?>>
            </div>
            <?php endforeach; ?>

            <button type= "submit" class="btn btn- success">Guardar Cambios</button>

        </form>
        <?php else: ?>
            <p class="text-center text-danger">No se encontro el registro </p>
        <?php endif; ?>



    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"></script>
    
</body>
</html>