<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destino = "tucorreo@dominio.com"; // CAMBIA ESTE CORREO

    $nombre = htmlspecialchars($_POST["nombre"] ?? "");
    $correo = htmlspecialchars($_POST["correo"] ?? "");
    $empresa = htmlspecialchars($_POST["empresa"] ?? "");
    $eventos = $_POST["evento"] ?? [];
    $terminos = isset($_POST["terminos"]) ? "Aceptados" : "No aceptados";

    $listaEventos = !empty($eventos) ? implode(", ", $eventos) : "No seleccionó opciones";

    $asunto = "Nuevo contacto desde UNISONOS";

    $mensaje = "
    Nombre: $nombre\n
    Correo: $correo\n
    Empresa: $empresa\n
    Evento(s): $listaEventos\n
    Términos: $terminos\n
    ";

    $cabeceras = "From: no-reply@unisonos.com\r\n";
    $cabeceras .= "Reply-To: $correo\r\n";

    if (mail($destino, $asunto, $mensaje, $cabeceras)) {
        echo "<script>alert('Mensaje enviado correctamente'); window.location.href='contacto.html';</script>";
    } else {
        echo "<script>alert('Error al enviar el mensaje'); window.history.back();</script>";
    }
}
?>