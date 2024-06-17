<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Leer el archivo de Fan IDs
    $file = 'fan_ids.txt';
    $lines = file($file, FILE_IGNORE_NEW_LINES);

    // Buscar y eliminar el Fan ID con el email proporcionado
    $new_lines = [];
    $found = false;
    foreach ($lines as $line) {
        list($nombre, $apellidoPaterno, $apellidoMaterno, $curp, $compradorImage, $documentImage, $fanEmail) = explode(',', $line);
        if (trim($fanEmail) !== $email) {
            $new_lines[] = $line;
        } else {
            $found = true;
        }
    }

    if ($found) {
        file_put_contents($file, implode("\n", $new_lines));
        echo "Fan ID eliminado exitosamente.";
    } else {
        echo "No se encontró un Fan ID con el correo electrónico proporcionado.";
    }
}
?>
