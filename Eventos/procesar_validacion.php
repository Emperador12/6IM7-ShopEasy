<?php
// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificamos si se han recibido los datos del Fan ID y el Boleto ID
    if (isset($_POST["fanId"]) && isset($_POST["boletoId"])) {
        // Obtenemos los datos del formulario
        $fanId = $_POST["fanId"];
        $boletoId = $_POST["boletoId"];

        // Verificamos si el Fan ID es "1234" y el Boleto ID es "5678" (solo como ejemplo)
        if ($fanId == "1234" && $boletoId == "5678") {
            echo "Fan ID válido. Asociado con el Boleto ID: " . $boletoId;
        } else {
            echo "Fan ID inválido o no asociado con el Boleto ID: " . $boletoId;
        }
    } else {
        // Si no se recibieron los datos esperados, muestra un mensaje de error
        echo "Error: Datos incompletos.";
    }
} else {
    // Si el método de solicitud no es POST, muestra un mensaje de error
    echo "Error: Método de solicitud incorrecto.";
}
?>

