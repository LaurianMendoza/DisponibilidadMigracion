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

    <title>Document</title>

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
    <h5 class="font-weight-bold text-center" style="color: rgb(0, 0, 0); font-size: 15.5px">HORARIO</h5>
    <h5 class="font-weight-bold text-center" style="color: rgb(0, 0, 0); font-size: 15.5px">{{$periodoEscolar[0]->cuatrimestre}}</h5>
</div>






<table class="table-horarioProfesor">
	<thead>
		<tr class="font-weight-bold">
			<th style="text-align: center; font-size: 10pt; background-color: rgb(223, 223, 223);">{{$profesor[0]->idempleado}}</th>
			<th style="text-align: left; font-size: 10pt; background-color: rgb(223, 223, 223);">{{$nombreProfe[0]->nombre}} {{$nombreProfe[0]->paterno}} {{$nombreProfe[0]->materno}}</th>
        </tr>
	</thead>

</table>




<table class="table table-horarioProfesor" style="margin-top: 10px;">
	<thead>
		<tr class="font-weight-bold">
			<th style="text-align: center; font-size: 8pt;"></th>
			<th style="text-align: center; font-size: 8pt;">LUNES</th>
			<th style="text-align: center; font-size: 8pt;">MARTES</th>
			<th style="text-align: center; font-size: 8pt;">MIERCOLES</th>
			<th style="text-align: center; font-size: 8pt;">JUEVES</th>
			<th style="text-align: center; font-size: 8pt;">VIERNES</th>

            <!-- Este codigo php sirve para verificar si existe algun horario en sabado, de lo contrario no aparece sabado en el horario -->
            @php
                $existeSabado = 0;
                foreach($horarioMaterias as $h){
                    if($h->numDia == 5){
                        $existeSabado = 1;
                    }
                }
            @endphp

 <!-- Aquí hace la validación si existe o no el sabado -->
        @if($existeSabado == 1)
			<th style="text-align: center; font-size: 8pt;">SABADO</th>
        @endif
		</tr>
	</thead>
	<tbody>

        @foreach($horarioHoras as $horas)
            <tr>
                <td style="text-align: center; width: 85px; font-size: 8pt;">{{$horas->horaConcatenada}}</td>

                <td style="text-align: left; width: 85px;">
                    @foreach ($horarioMaterias as $matLunes)
                        @if($matLunes->numDia == 0 && $horas->horaConcatenada == $matLunes->horaConcatenada)
                            {{$matLunes->Materia}} <br><br><br> {{$matLunes->claveGrupo}} <br><br> {{$matLunes->Aula}} <br> {{$matLunes->Edificio}}
                        @endif
                    @endforeach
                </td>

                <td style="text-align: left; width: 85px;">
                    @foreach ($horarioMaterias as $matMartes)
                        @if($matMartes->numDia == 1 && $horas->horaConcatenada == $matMartes->horaConcatenada)
                            {{$matMartes->Materia}} <br><br><br> {{$matMartes->claveGrupo}} <br><br> {{$matMartes->Aula}} <br> {{$matMartes->Edificio}}
                        @endif
                    @endforeach
                </td>

                <td style="text-align: left; width: 85px;">
                    @foreach ($horarioMaterias as $matMiercoles)
                        @if($matMiercoles->numDia == 2 && $horas->horaConcatenada == $matMiercoles->horaConcatenada)
                            {{$matMiercoles->Materia}} <br><br><br> {{$matMiercoles->claveGrupo}} <br><br> {{$matMiercoles->Aula}} <br> {{$matMiercoles->Edificio}}
                        @endif
                    @endforeach
                </td>

                <td style="text-align: left; width: 85px;">
                    @foreach ($horarioMaterias as $matJueves)
                        @if($matJueves->numDia == 3 && $horas->horaConcatenada == $matJueves->horaConcatenada)
                            {{$matJueves->Materia}} <br><br><br> {{$matJueves->claveGrupo}} <br><br> {{$matJueves->Aula}} <br> {{$matJueves->Edificio}}
                        @endif
                    @endforeach
                </td>

                <td style="text-align: left; width: 85px;">
                    @foreach ($horarioMaterias as $matViernes)
                        @if($matViernes->numDia == 4 && $horas->horaConcatenada == $matViernes->horaConcatenada)
                            {{$matViernes->Materia}} <br><br><br> {{$matViernes->claveGrupo}} <br><br> {{$matViernes->Aula}} <br> {{$matViernes->Edificio}}
                        @endif
                    @endforeach
                </td>

                @if($existeSabado == 1)
                <td style="text-align: left; width: 85px;">
                    @foreach ($horarioMaterias as $matSabado)
                        @if($matSabado->numDia == 5 && $horas->horaConcatenada == $matSabado->horaConcatenada)
                            {{$matSabado->Materia}} <br><br><br> {{$matSabado->claveGrupo}} <br><br> {{$matSabado->Aula}} <br> {{$matSabado->Edificio}}
                        @endif
                    @endforeach
                </td>
                @endif


            </tr>
        @endforeach



	</tbody>
</table>

</main>

</body>

</html>
