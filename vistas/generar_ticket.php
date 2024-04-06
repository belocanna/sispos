<?php
    
    if (isset($_GET['numero'])) {
        $numero = $_GET['numero'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Venta</title>
</head>
<body>
<main>
    <div class="container-fluid vh-100">
        <iframe src="<?php echo "http://localhost/sispos/ajax/ventas.ajax.php?venta_id=".$numero;?>" frameborder= "0" height="100%" width="100%">
        </iframe>
    </div>
</main>
</body>
</html>