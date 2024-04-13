<html class="swal2-shown swal2-height-auto"><head><link rel="icon" href="favicons/favicon.ico">

    <!--Fondo de pantalla-->

    <!--Fondo de pantalla-->
    <body style='background: url("logos/backgroundMantenimiento.jpg");
    background-repeat:no-repeat;
    background-size:cover;
    background-position:center center;
    background-attachment: fixed;'>
    </body>


    <style>
      .my-swal-popup-class {
      top: 25%; /* Posición vertical en píxeles */
      left: 0%; /* Posición horizontal en píxeles */

      width: 500px; /* Ancho en píxeles */
      height: 300px; /* Altura en píxeles */
}

    </style>

    <!--LINK QUE MANDA A TRAER LAS DEPENCIAS DE SWEET ALERT QUE SE UTILIZAN PARA TODOS LOS ALERT BOX-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" aria-hidden="true"></script>

    <script aria-hidden="true">
        Swal.fire({
          icon: 'warning',
          title: 'SISTEMA INACTIVO',
          html: '<div style="font-size: 22px">La plataforma se encuentra en mantenimiento, favor de intentar mas tarde.</div>',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          permitirEnterKey: true,
          customClass: {
            popup: 'my-swal-popup-class' // Agrega tu propia clase CSS para el cuadro de diálogo
          }

        })
    </script>

    </body></html>
