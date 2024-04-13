<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">

    <title>INCIDENCIAS</title>

</head>

<!--Encabezado del pdf-->
<header>
    <img src="{{ asset('logos/reportes/TamSecr.png') }}" width="255" class="float-left" style="margin-left: -20px;" alt="..." >
    <img src="{{ asset('logos/reportes/SEP-NoFondo.png') }}" width="190" height="40" class="float-right" alt="...">
  </header>

<!-- Pie de pagina del pdf -->
<footer class="footerConstancia">
    <img src="{{ asset('logos/reportes/Texto.png') }}" style="width: 250px;" alt="...">
    <img src="{{ asset('logos/reportes/LogoUpv2023.png') }}" style="margin-left: 200px; margin-top: -15px; width: 160px;"  alt="...">
    <img src="{{ asset('logos/reportes/LOGOCGUTYP.png') }}" style="margin-left: 10px; margin-top: -4px; width: 130px;" alt="...">
</footer>

<body>


<main>

    <!-- Titulo -->
<div>
    <h5 class="font-weight-bold text-center" style="color: rgb(0, 0, 0); font-size: 15.5px">REGISTRO DE ASISTENCIA</h5>
    <h5 class="font-weight-bold text-center" style="color: rgb(0, 0, 0); font-size: 15.5px">{{$fechaInicio}} - {{$fechaFin}}</h5>
</div>



<table class="table-nombreEmpleadoincidenciaSeleccion">
	<thead>
		<tr class="font-weight-bold">
			<th style="text-align: center;">{{$empleado[0]->numero}}</th>
			<th style="text-align: left;">{{$empleado[0]->Nombre}}</th>
        </tr>
	</thead>

</table>




<table class="table-incidenciaSeleccion" style="margin-top: 10px;">
	<thead>
		<tr class="font-weight-bold">
			<th style="text-align: center; font-size: 8pt;">Incidencia</th>
			<th style="text-align: center; font-size: 8pt;">Fecha</th>
			<th style="text-align: center; font-size: 8pt;">Hora de registro</th>

            {{--}}
			<th style="text-align: center; font-size: 8pt;">Justificado</th>
			<th style="text-align: center; font-size: 8pt;">Justificante</th>
            {{--}}



		</tr>
	</thead>
	<tbody>

        @foreach($lista as $incidencias)
            <tr>
                <td style="text-align: center; width: 85px; font-size: 8pt;">{{$incidencias->Incidencia}}</td>
                <td style="text-align: center; width: 85px; font-size: 8pt;">{{$incidencias->Fecha}}</td>
                <td style="text-align: center; width: 85px; font-size: 8pt;">{{$incidencias->HoraRegistro}}</td>
                {{--}}
                <td style="text-align: center; width: 85px; font-size: 8pt;">{{$incidencias->JustificadoPorJefe}}</td>
                <td style="text-align: center; width: 85px; font-size: 8pt;">{{$incidencias->Justificante}}</td>
                {{--}}


            </tr>
        @endforeach



	</tbody>
</table>




<div class="saltoPaginaTabla"> <!--evita que la tabla se rompa y en su lugar da un salto de pagina -->
    <table class="table-incidenciaSeleccionConteo" style="margin-top: 10px;">
        <thead>
            <tr class="font-weight-bold">
                <th style="text-align: center; font-size: 8pt;">Incidencia</th>
                <th style="text-align: center; font-size: 8pt;">#Incidencias</th>
                <th style="text-align: center; font-size: 8pt;">#Faltas</th>


            </tr>
        </thead>
        <tbody>

            @php
                $totalIncidencias = 0;
                $totalFaltas = 0;
            @endphp

            @foreach($conteos as $conteo)
                <tr>
                    <td style="text-align: center; width: 85px; font-size: 8pt;">{{$conteo->Incidencia}}</td>
                    <td style="text-align: center; width: 85px; font-size: 8pt;">{{$conteo->Cantidad}}</td>
                    <td style="text-align: center; width: 85px; font-size: 8pt;">{{$conteo->FaltasSubtotal}}</td>
                </tr>

            @php
                $totalIncidencias = $totalIncidencias + $conteo->Cantidad;
                $totalFaltas = $totalFaltas + $conteo->FaltasSubtotal;
            @endphp

            @endforeach

            <tr style="border-top: 1px">
                <td style="text-align: center; width: 85px; font-size: 8pt;"></td>
                <td style="text-align: center; width: 85px; font-size: 8pt; border-top: 1px solid black;">{{$totalIncidencias}}</td>
                <td style="text-align: center; width: 85px; font-size: 8pt; border-top: 1px solid black;">{{$totalFaltas}}</td>
            </tr>



        </tbody>
    </table>
</div>


<div class="saltoPaginaTabla"> <!--evita que la tabla se rompa y en su lugar da un salto de pagina -->
<br><br><br>
    <p class="text-center" style="color: rgb(0, 0, 0);"><a class="datosFirmaincidenciaSeleccion">________________________________________________________</a></p>
    <p class="text-center" style="line-height: 0.1; color: rgb(0, 0, 0)"><a class="firmaincidenciaSeleccion">Firma de aceptación del empleado</a></p>
</div>

</main>

</body>

</html>
