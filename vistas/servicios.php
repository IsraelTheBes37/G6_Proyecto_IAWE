<?php
include("includes/cabecera.php");
?>
<h2>Nuestros Servicios</h2>
<div class="envio-cards-wrapper">

    <div class="envio-card">
        <div class="envio-card-img envio-card-img-estandar"></div>
        <div class="envio-card-title">Envío estándar peninsular</div>
        <div class="envio-card-zone">Zona: Peninsular</div>
        <div class="envio-card-price">6.90 €</div>
        <div class="envio-card-time">48 h</div>
        <div class="envio-card-btn" data-servicio="Envío estándar peninsular">Seleccionar</div>
    </div>

    <div class="envio-card">
        <div class="envio-card-img envio-card-img-urgente"></div>
        <div class="envio-card-title">Envío urgente peninsular</div>
        <div class="envio-card-zone">Zona: Peninsular</div>
        <div class="envio-card-price">12.50 €</div>
        <div class="envio-card-time">24 h</div>
        <div class="envio-card-btn" data-servicio="Envío urgente peninsular">Seleccionar</div>
    </div>

    <div class="envio-card">
        <div class="envio-card-img envio-card-img-islas"></div>
        <div class="envio-card-title">Envío islas (Baleares/Canarias)</div>
        <div class="envio-card-zone">Zona: Islas</div>
        <div class="envio-card-price">18.00 €</div>
        <div class="envio-card-time">72 h</div>
        <div class="envio-card-btn" data-servicio="Envío islas (Baleares/Canarias)">Seleccionar</div>
    </div>

    <div class="envio-card">
        <div class="envio-card-img envio-card-img-2h"></div>
        <div class="envio-card-title">Entrega en 2h (ciudades)</div>
        <div class="envio-card-zone">Zona: Local</div>
        <div class="envio-card-price">9.99 €</div>
        <div class="envio-card-time">2 h</div>
        <div class="envio-card-btn" data-servicio="Entrega en 2h (ciudades)">Seleccionar</div>
    </div>

    <div class="envio-card">
        <div class="envio-card-img envio-card-img-recogida"></div>
        <div class="envio-card-title">Recogida programada</div>
        <div class="envio-card-zone">Zona: Peninsular</div>
        <div class="envio-card-price">4.50 €</div>
        <div class="envio-card-time">48 h</div>
        <div class="envio-card-btn" data-servicio="Recogida programada">Seleccionar</div>
    </div>

</div>

<?php
include("includes/pie.php");
?>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const botones = document.querySelectorAll(".envio-card-btn");

    botones.forEach(boton => {
        boton.addEventListener("click", function () {

            const servicio = this.getAttribute("data-servicio");

            const confirmar = confirm("¿Estás seguro de comprar: " + servicio + "?");

            if (confirmar) {
                alert("Gracias por tu compra");
            }
        });
    });

});
</script>