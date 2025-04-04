<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Tardanza</title>
    <link rel="Stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Lista de Tardanza</h1>

        <div class="text-end mb-4">
            <a href="registro.php" class="btn btn-primary">Registrar nueva Tardanza</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Curso</th>
                    <th>Motivo</th>
                    <th>Fecha y Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tardanzas as $linea): ?>
                    <?php $v= explode("," , trim($linea)); ?>

                    <?php if (count($v) >=6): ?>
                        <tr>
                            <?php foreach(array_slice($v,0,6) as $dato): ?>
                                <td><?= htmlspecialchars($dato) ?></td>
                            <?php endforeach; ?>

                            <td>
                                <a href="registro.php?id=<?= htmlspecialchars($v[0]) ?>" class="btn btn-warning btn-sm"> Editar</a>
                                <a href="?eliminar=<?= htmlspecialchars($v[0]) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Quieres Eliminar esta tardanza');"> Eliminar</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>