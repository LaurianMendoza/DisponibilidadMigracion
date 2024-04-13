@extends('Docentes.layouts.main')

@section('aditional_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="grid grid-cols-6 gap-3">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">


                <!-- BEGIN: General Report -->
                <div class="col-span-12">

                    <div class="intro-y flex items-center h-10">
                        <a href="" class="ml-auto flex items-center text-primary zoomin_smooth">
                            <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i>
                            RECARGAR DATOS
                        </a>
                    </div>
                    <h2 class="text-l fw-700 text-primary font-medium mr-5 ml-2">
                        MODULOS
                    </h2>

                    <div class="grid grid-cols-12 gap-6 mt-5">

                        <a href="{{ route('docentes.indexGruposAsignaturas') }}"
                            class="col-span-12 sm:col-span-2 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in-cards">
                                <div class="box p-5">
                                    <div class="flex">
                                    </div>
                                    <div class="text-l font-medium leading-8 text-center"
                                        style="display:flex; justify-content:space-between; align-items:center;">
                                        <label class="text-grey cursor-pointer">GRUPO - ASIGNATURA</label>
                                        <i class="far fa-users text-5xl text-green"></i>
                                    </div>
                                </div>
                            </div>
                        </a>




                    </div>

                    <hr class="mt-5 mb-5" style="height:1px;border-width:0;color:gray;background-color:rgb(205, 205, 205);">
                    @if (session('idPerfil') == 4)
                        <div class="card p-3">
                            <h2 class="text-l fw-700 text-primary font-medium mr-5 ml-2 mb-3">
                                INFORMES
                            </h2>
                            <div>
                                <div class="card p-5">
                                    <ul class="nav nav-boxed-tabs" role="tablist">
                                        <li id="example-3-tab" class="nav-item flex-1" role="presentation">
                                            <button onclick="select_tab('tab_horario')"
                                                class="nav-link w-full py-2 btn_animNone @if (session('tab_horario') == true) active @endif"
                                                data-tw-toggle="pill" data-tw-target="#horario_clase" type="button" role="tab"
                                                aria-controls="horario_clase" aria-selected="true">
                                                HORARIO DE CLASES
                                            </button>
                                        </li>
                                        <li id="example-4-tab" class="nav-item flex-1" role="presentation">
                                            <button onclick="select_tab('tab_alumnos_reprobados')"
                                                class="nav-link w-full py-2 btn_animNone @if (session('tab_alumnos_reprobados') == true) active @endif"
                                                data-tw-toggle="pill" data-tw-target="#alumnos_Reprobados" type="button"
                                                role="tab" aria-controls="alumnos_Reprobados" aria-selected="false">
                                                ALUMNOS REPROBADOS
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-5">
                                        <div id="horario_clase" class="tab-pane leading-relaxed @if (session('tab_horario') == true) active @endif"
                                            role="tabpanel" aria-labelledby="horario_clase-tab">

                                            <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                                <div style=" width: 96%;" class="mb-3">
                                                    <button class="btn btn-info zoomin_smooth btn_animNone"
                                                        onclick="location.href=''">
                                                        DESCARGAR HORARIO
                                                    </button>
                                                </div>
                                                <div class="p-1" style="display: flex; justify-content: center; align-items: center; width: 100%;">
                                                    <div style="display: flex; max-height: 450px; overflow-y: auto;" class="p-3 w-100">
                                                        <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 60px;">HORARIO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="font-size: 13px;">

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 80px;">LUNES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="font-size: 10px;">

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 60px;">MARTES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="font-size: 10px;">


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 60px;">MIERCOLES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="font-size: 10px;">


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 60px;">JUEVES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="font-size: 10px;">


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 60px;">VIERNES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="font-size: 10px;">


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 60px;">SABADO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="font-size: 10px;">


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div id="alumnos_Reprobados"
                                            class="tab-pane leading-relaxed @if (session('tab_alumnos_reprobados') == true) active @endif"
                                            role="tabpanel" aria-labelledby="alumnos_Reprobados-tab">



                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        <h2 class="text-l fw-700 text-primary font-medium mr-5 ml-2 mb-3">
                            INFORMES
                        </h2>
                        <div>
                            <div class="card" style="padding-top: 1%; padding-right: 1%;">
                                <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                    <div style=" width: 96%;" class="mb-3">
                                        <button class="btn btn-info zoomin_smooth btn_animNone"
                                            onclick="location.href='{{ route('docentes.descargarHorario') }}'">
                                            DESCARGAR HORARIO
                                        </button>
                                    </div>
                                    <div class="p-1" style="display: flex; justify-content: center; align-items: center; width: 100%;  overflow-x: auto; overflow-y: auto;">
                                        <div style="display: flex; overflow-x: auto; overflow-y: auto; max-height: 450px;" class="p-3 w-100">
                                            <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 60px;">HORARIO</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="font-size: 13px;">

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 80px;">LUNES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="font-size: 10px;">


                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 60px;">MARTES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="font-size: 10px;">


                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 60px;">MIERCOLES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="font-size: 10px;">


                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 60px;">JUEVES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="font-size: 10px;">


                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 60px;">VIERNES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="font-size: 10px;">


                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mx-1" style="display: flex; justify-content: center; width: 200px;">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 60px;">SABADO</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="font-size: 10px;">


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- END: General Report -->
                </div>
            </div>
        </div>
    </div>



    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">



    <!-- MODAL add notificacion -->
    <div class="ourModal" id="addNotify" data-animation="slideInOutLeft" style="display: none;">
        <div class="ourModal-dialog">
            <header class="ourModal-header">
                <h3 class="modal-title" id="exampleModalLabel"><b>ENVIAR NOTIFICACION AL ALUMNO</b></h3>
                <button onclick="limpiarModal('addPlanContent')" type="button" class="btn btn-danger btn_anim close-ourModal"
                    aria-label="close ourModal" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </header>
            <section class="ourModal-content addPlanContent">

            </section>
            <footer>
            </footer>
        </div>
    </div>

@endsection




@section('aditional_js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
       function findNaughtyStep(original, modified) {
            let naughtyStep = ''
            for (let u = 0; u < modified.length; u++) {
                if(!original.includes(modified[u])){
                    naughtyStep = naughtyStep + modified[u]
                }
            }

            for (let u = 0; u < original.length; u++) {
                if(!modified.includes(original[u])){
                    naughtyStep = naughtyStep + original[u]
                }
            }
            return naughtyStep
        }


        $(document).ready(function() {
            setTimeout(() => {
                $('.preloaderDocente').css('display', 'none')
                $('#addMateria').css('display', 'flex')
                $('#info').DataTable({
                    "pageLength": 4,
                    "lengthMenu": [
                        [4, 14, -1],
                        [4, 14, "All"]
                    ],
                    responsive: false,
                    autoWidth: false,
                    "lengthChange": false,

                    "language": {
                        "lengthMenu": "MOSTRAR _MENU_ REGISTROS POR PÁGINA.",
                        "zeroRecords": "DE MOMENTO NINGÚN ALUMNO ESTÁ REPROBADO.",
                        "info": "MOSTRANDO LA PÁGINA _PAGE_ de _PAGES_",
                        "infoEmpty": "SIN REGISTROS",
                        "infoFiltered": "(SE ENCONTRARON _MAX_ REGISTROS)",
                        "search": "BUSCAR:",
                        "paginate": {
                            "next": "SIGUIENTE",
                            "previous": "ANTERIOR"
                        }
                    },
                });

                $('#info2').DataTable({
                    "pageLength": 4,
                    "lengthMenu": [
                        [4, 14, -1],
                        [4, 14, "All"]
                    ],
                    responsive: false,
                    autoWidth: false,
                    "lengthChange": false,

                    "language": {
                        "lengthMenu": "MOSTRAR _MENU_ REGISTROS POR PÁGINA",
                        "zeroRecords": "NO SE ENCONTRARON CARRERAS REGISTRADAS.",
                        "info": "MOSTRANDO LA PÁGINA _PAGE_ de _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(Se encontraron _MAX_ registros)",
                        "search": "BUSCAR:",
                        "paginate": {
                            "next": "SIGUIENTE",
                            "previous": "ANTERIOR"
                        }
                    },
                });

            }, 900)
        })

        $(".ckecks_group input:checkbox").change(function() {
            $(".ckecks_group input:checkbox").not(this).prop('checked', false);
        });

        function select_tab(tab) {
            let _token = $('#token').val();
            $.ajax({
                type: "PUT",
                url: "{{ route('docentes.selectTab') }}",
                data: {
                    _token: _token,
                    tab: tab,
                },
                success: function(success) {
                    console.log(success)
                },
                error: function(error) {
                    console.log('.....ERROR AL CONSULTAR LOS GRUPOS.....')
                    console.log(error);
                }
            });
        }
    </script>
@endsection
