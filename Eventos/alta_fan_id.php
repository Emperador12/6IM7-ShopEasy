<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $curp = $_POST['curp'];
    $compradorImage = $_FILES['compradorImage']['name'];
    $documentImage = $_FILES['documentImage']['name'];

    $target_dir = "uploads/";
    $target_comprador = $target_dir . basename($compradorImage);
    $target_document = $target_dir . basename($documentImage);

    if (move_uploaded_file($_FILES['compradorImage']['tmp_name'], $target_comprador) && move_uploaded_file($_FILES['documentImage']['tmp_name'], $target_document)) {
        $data = $nombre . ',' . $apellidoPaterno . ',' . $apellidoMaterno . ',' . $curp . ',' . $target_comprador . ',' . $target_document . "\n";
        file_put_contents('fan_ids.txt', $data, FILE_APPEND);
        echo "Fan ID agregado exitosamente.";
    } else {
        echo "Error al subir las imágenes.";
    }
}
?>
