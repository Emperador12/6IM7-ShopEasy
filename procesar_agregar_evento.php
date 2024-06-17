<?php
// Ruta del archivo CSV donde se guardarán los datos
$csv_file = 'eventos.csv';

// Función para validar el formato de la fecha (formato: YYYY-MM-DD)
function validar_fecha($fecha) {
    return preg_match("/^\d{4}-\d{2}-\d{2}$/", $fecha);
}

// Función para validar el formato de la hora (formato: HH:MM)
function validar_hora($hora) {
    return preg_match("/^\d{2}:\d{2}$/", $hora);
}

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los datos del formulario
    $titulo = $_POST["titulo"];
    $nombre = $_POST["nombre"];
    $lugar = $_POST["lugar"];
    $cupo = $_POST["cupo"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $costo_min = $_POST["costo_min"];
    $costo_max = $_POST["costo_max"];
    $tipo_asiento = $_POST["tipo_asiento"];

    // Validamos los campos
    $errores = array();
    if (empty($titulo)) {
        $errores[] = "El campo Título es obligatorio.";
    }
    if (empty($nombre)) {
        $errores[] = "El campo Nombre es obligatorio.";
    }
    if (empty($lugar)) {
        $errores[] = "El campo Lugar es obligatorio.";
    }
    if (empty($cupo) || !is_numeric($cupo)) {
        $errores[] = "El campo Cupo debe ser un número entero.";
    }
    if (!validar_fecha($fecha)) {
        $errores[] = "El campo Fecha debe tener el formato YYYY-MM-DD.";
    }
    if (!validar_hora($hora)) {
        $errores[] = "El campo Hora debe tener el formato HH:MM.";
    }
    if (empty($costo_min) || !is_numeric($costo_min)) {
        $errores[] = "El campo Costo Mínimo debe ser un número.";
    }
    if (empty($costo_max) || !is_numeric($costo_max)) {
        $errores[] = "El campo Costo Máximo debe ser un número.";
    }
    if ($tipo_asiento != "Público General" && $tipo_asiento != "VIP") {
        $errores[] = "El campo Tipo de Asiento debe ser 'Público General' o 'VIP'.";
    }

    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
        exit();
    }

    $evento = array($titulo, $nombre, $lugar, $cupo, $fecha, $hora, $costo_min, $costo_max, $tipo_asiento);

    $fp = fopen($csv_file, 'a');
    fputcsv($fp, $evento);
    fclose($fp);

    echo "El evento se ha agregado correctamente.";
} else {
    header("Location: agregar_evento.html");
    exit();
}
?>
