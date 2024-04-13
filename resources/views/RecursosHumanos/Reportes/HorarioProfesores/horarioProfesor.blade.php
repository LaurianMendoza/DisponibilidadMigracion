@php $layout = ''; @endphp

@if(session('active') == 'RecursosHumanos')
    @php $layout = 'RecursosHumanos.layouts.main'; @endphp
@elseif(session('active') == 'DirAcad')
    @php $layout = 'DirAcademica.layouts.main'; @endphp
@endif

@extends($layout)

@section('aditional_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link href="{{ asset('css/preloader.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/loaderRH.css') }}">
@endsection

@section('content')

<title>SIISU - HORARIOS PROFESORES</title>

<br>

<div class="intro-y flex items-center h-10">
    <label class="text-l fw-700 text-primary font-medium mr-5 ml-2">HORARIOS PROFESORES</label>
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
            <form class="Buscar w-100" method="POST" class="form-inline" method="POST" @if(session('active') == 'RecursosHumanos') action="{{ route('RH.buscarHorarioProfesor') }}" @elseif(session('active') == 'DirAcad') action="{{ route('DirAcad.buscarHorarioProfesor') }}" @endif
                enctype="multipart/form-data" novalidate>
                @csrf

                <div class="form-group mx-sm-3 mb-2" style="display: flex; justify-content: start; align-items: center;">


                    {{-- Select que enlista a los profesores --}}
                    <div class="mx-1" style="width: 340px !important;">
                        <select class="select2 mx-1 " name="profesor" id="profesor" style="margin-left: 20px;">
                            <option value='0'>--- SELECCIONE UN PROFESOR ---</option>
                            <option value='todos' @if($idempleado == 'todos') selected @endif>TODOS LOS HORARIOS</option>
                            @foreach($profesores as $profesor)
                                <option @if($profesor->idEmpleado == $idempleado) selected @endif value='{{$profesor->idEmpleado}}'>{{$profesor->empleado}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mx-1" style="width: 300px !important;">
                        <select class="select2 mx-1" name="periodo" id="periodo" style="margin-left: 20px;">
                            @foreach($cuatrimestre as $cuatri)
                                <option @if($Periodo != null) @if($cuatri->idcuatrimestre == $Periodo) selected @endif @elseif($cuatri->idcuatrimestre == $cuatriActual[0]->idcuatrimestre) selected @endif value='{{$cuatri->idcuatrimestre}}'>{{$cuatri->cuatrimestre}}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
              </form>


<br>
<!-- Aquí va ir el reporte -->
@if($idempleado != null || $idempleado != 0)


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
                        <p style="color: black;">Cargando horarios...</p>
                    </div>
                </div>

    </div>

</div>


<div id="pdfhistorial" style="text-align: center;">
    @if($idempleado == 'todos')
        @if(session('active') == 'RecursosHumanos')
            <iframe src="{{ asset(route('RH.reporteTodosHorarioProfesor', [$idempleado, $Periodo]))}}"style="width:100%; height:1000px;" frameborder="0"></iframe>
        @elseif(session('active') == 'DirAcad')
            <iframe src="{{ asset(route('DirAcad.reporteTodosHorarioProfesor', [$idempleado, $Periodo]))}}"style="width:100%; height:1000px;" frameborder="0"></iframe>
        @endif
    @elseif($idempleado != 0)

    @if(session('active') == 'RecursosHumanos')
        <iframe src="{{ asset('pdfjs/web/viewer.html?file=') }} {{ asset(route('RH.reporteHorarioProfesor', [$idempleado, $Periodo]))}}"style="width:100%; height:1000px;" frameborder="0"></iframe>
    @elseif(session('active') == 'DirAcad')
        <iframe src="{{ asset('pdfjs/web/viewer.html?file=') }} {{ asset(route('DirAcad.reporteHorarioProfesor', [$idempleado, $Periodo]))}}"style="width:100%; height:1000px;" frameborder="0"></iframe>
    @endif

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

    //Activador del submit con el dato del profesor
    $('#profesor').on('change', function() {
            if ($('input[name="profesor"]').val() != "0") {
                console.log('SE ENVIO EL FORMULARIO AUTOMATICAMENTE AL SELEC. EL CHECKBOX')
                $('.Buscar').submit()
            } else {
                Swal.fire({
                    html: 'DEBES INGRESAR UNA MATRÍCULA PARA GENERAR UNA NUEVA CONSTANCIA',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    if (result.value) {
                        $('#profesor').val('');
                    }
                })
            }
        });



        //Activador del submit con el dato del periodo
        $('#periodo').on('change', function() {
            if ($('input[name="profesor"]').val() != "0") {
                console.log('SE ENVIO EL FORMULARIO AUTOMATICAMENTE AL SELEC. EL CHECKBOX')
                $('.Buscar').submit()
            } else {
                Swal.fire({
                    html: 'DEBES INGRESAR UNA MATRÍCULA PARA GENERAR UNA NUEVA CONSTANCIA',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    if (result.value) {
                        $('#periodoInicio').val('');
                    }
                })
            }
        });
</script>
@endsection
