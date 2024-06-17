<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $originalEmail = trim($_POST['originalEmail']);
    $nombre = trim($_POST['nombre']);
    $apellidoPaterno = trim($_POST['apellidoPaterno']);
    $apellidoMaterno = trim($_POST['apellidoMaterno']);
    $curp = trim($_POST['curp']);
    $email = trim($_POST['email']);

    // Leer el archivo de Fan IDs
    $file = 'fan_ids.txt';
    $lines = file($file, FILE_IGNORE_NEW_LINES);

    $new_lines = [];
    foreach ($lines as $line) {
        list($lineNombre, $lineApellidoPaterno, $lineApellidoMaterno, $lineCurp, $compradorImage, $documentImage, $lineEmail) = explode(',', $line);
        if (trim($lineEmail) === $originalEmail) {
            $new_lines[] = "$nombre,$apellidoPaterno,$apellidoMaterno,$curp,$compradorImage,$documentImage,$email";
        } else {
            $new_lines[] = $line;
        }
    }

    file_put_contents($file, implode("\n", $new_lines));
    echo "Fan ID actualizado exitosamente.";
}
?>
