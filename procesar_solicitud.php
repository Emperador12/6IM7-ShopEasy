<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evento = trim($_POST['evento']);
    $cantidad = trim($_POST['cantidad']);
    $asiento = trim($_POST['asiento']);

    if ($cantidad > 0) {
        header("Location: compra_boletos.php?evento=" . urlencode($evento) . "&cantidad=" . $cantidad . "&asiento=" . urlencode($asiento));
        exit();
    } else {
        echo "La cantidad de boletos debe ser mayor a cero.";
    }
} else {
    echo "Método no permitido.";
}
?>
