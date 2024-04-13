@extends('RecursosHumanos.layouts.main')

@section('aditional_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link href="{{ asset('css/preloader.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/loaderRH.css') }}">
@endsection

@section('content')

<title>SIISU - INCIDENCIAS POR SELECCIÓN</title>

<br>

<div class="intro-y flex items-center h-10">
    <label class="text-l fw-700 text-primary font-medium mr-5 ml-2">INCIDENCIAS POR SELECCIÓN</label>
    <a href="" class="ml-auto flex items-center text-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="refresh-ccw" data-lucide="refresh-ccw" class="lucide lucide-refresh-ccw w-4 h-4 mr-3"><path d="M3 2v6h6"></path><path d="M21 12A9 9 0 006 5.3L3 8"></path><path d="M21 22v-6h-6"></path><path d="M3 12a9 9 0 0015 6.7l3-2.7"></path></svg> RECARGAR DATOS </a>
</div>

<style>
    .select2-container {
        display: inline-block;
    }
</style>

<br>

<div class="card mb-4 animate__animated animate__fadeIn mt-2">

    <div class="p-3 mb-2">
            <form class="Buscar w-100" method="POST" class="form-inline" method="POST" action="{{ route('RH.buscarIncidenciaSeleccion') }}"
                enctype="multipart/form-data" novalidate>
                @csrf

                <div class="form-group mx-sm-3 mb-2" style="display: flex; justify-content: start; align-items: center;">


                    <span>FECHA: </span>

                    <div class="mx-1" style="margin-left: 10px;">
                        <input type="date" name="fechaInicio" id="fechaInicio" @if($fechaInicio != null) value="{{$fechaInicio}}" @else value="" @endif>
                    </div>

                    <span style="margin-left: 10px;">AL</span>

                    <div class="mx-1" style="margin-left: 10px;">
                        <input type="date" name="fechaFin" id="fechaFin" @if($fechaFin != null) value="{{$fechaFin}}" @else value="" @endif>
                    </div>

                    {{-- Select que enlista a los empleados --}}
                    <div class="mx-1" style="width: 340px !important;">
                        <select class="select2 mx-1 " name="empleado" id="empleado" style="margin-left: 20px;">
                            <option value='0'>--- SELECCIONE UN EMPLEADO ---</option>


                            <option value='todos' @if($idpersona == 'todos') selected @endif>TODOS LOS EMPLEADOS</option>


                            @foreach($empleados as $empleado)
                                <option @if($empleado->IdPersona == $idpersona) selected @endif value='{{$empleado->IdPersona}}'>{{$empleado->Nombre}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mx-1" style="margin-left: 10px;">
                        <button class="btn btn-info" id="buscador" type="button">BUSCAR</button>
                    </div>


                </div>
              </form>


<br>


<!-- Aquí va ir el reporte -->
@if($idpersona != null || $idpersona != 0)


<div class="preloader-body">

    <div id="preloader" style="text-align: center;">

        <style>
            .document-loader:before{
                background: #4c4c4c #4c4c4c rgba(255,255,255,.35) rgba(255,255,255,.35);
            }

        </style>
                <div class="wrap" style="margin-left: 10%; margin-top: 100px;">
                    <div class="center">
                        <div class="document-loader" style="background: #f38730">
                            <span class="heading short" style="background: #333;"></span>
                            <span class="line short" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line short" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line short" style="background: #eee;"></span>
                            <span class="heading" style="background: #333;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line short" style="background: #333;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line" style="background: #eee;"></span>
                            <span class="line short" style="background: #333;"></span>
                        </div>
                        <p style="color: black;">Cargando incidencias...</p>
                    </div>
                </div>

    </div>

</div>


<div id="pdfhistorial" style="text-align: center;">
    @if($idpersona == 'todos')

        <iframe src="{{ asset(route('RH.reporteIncidenciaSeleccionTodos', [$idpersona, $fechaInicio, $fechaFin]))}}"style="width:100%; height:1000px;" frameborder="0"></iframe>

    @elseif($idpersona != 0)

        <iframe src=" {{--}} {{ asset('pdfjs/web/viewer.html?file=') }} {{--}} {{ asset(route('RH.reporteIncidenciaSeleccion', [$idpersona, $fechaInicio, $fechaFin]))}}"style="width:100%; height:1000px;" frameborder="0"></iframe>

    @endif

</div>


@endif



</div>


</div>


@endsection


@section('aditional_js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <!--LINK QUE MANDA A TRAER LAS DEPENCIAS DE SWEET ALERT QUE SE UTILIZAN PARA TODOS LOS ALERT BOX-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $( document ).ready(function() {
        setTimeout(() => {
        $('.preloaderRH').css('display','none')
    }, 2300)
    });
</script>

<script>
    $('#pdfkardex').hide();
    $('#preloader').show();
    $( window ).on( "load", function() {
        $('#pdfkardex').show();
        $('#preloader').hide();
    });
</script>




<script>

    //Activador del submit con el dato del empleado
    $('#empleado').on('change', function() {
            if ($('input[name="fechaInicio"]').val() != "" && $('input[name="fechaFin"]').val() != "") {

                if($('input[name="fechaInicio"]').val() > $('input[name="fechaFin"]').val()){

                    Swal.fire({
                    html: 'LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FECHA DE FIN',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })

                }else{
                    console.log('SE ENVIO EL FORMULARIO AUTOMATICAMENTE AL SELEC. EL CHECKBOX')
                    $('.Buscar').submit()
                }


            } else {

                document.getElementById("empleado").value = "0";
                document.getElementById("select2-empleado-container").textContent = "--- SELECCIONE UN PROFESOR ---";

                Swal.fire({
                    html: 'DEBES LLENAR LOS CAMPOS DE FECHAS PARA REALIZAR LA CONSULTA',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })
            }
        });






        //Activador del submit con el dato del empleado
    $('#buscador').on('click', function() {
            if ($('input[name="fechaInicio"]').val() != "" && $('input[name="fechaFin"]').val() != "") {

                if($('input[name="fechaInicio"]').val() > $('input[name="fechaFin"]').val()){

                    Swal.fire({
                    html: 'LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FECHA DE FIN',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })

                }else{
                    console.log('SE ENVIO EL FORMULARIO AUTOMATICAMENTE AL SELEC. EL CHECKBOX')
                    $('.Buscar').submit()
                }


            } else {

                document.getElementById("empleado").value = "0";
                document.getElementById("select2-empleado-container").textContent = "--- SELECCIONE UN PROFESOR ---";

                Swal.fire({
                    html: 'DEBES LLENAR LOS CAMPOS DE FECHAS PARA REALIZAR LA CONSULTA',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })
            }
        });



</script>
@endsection
