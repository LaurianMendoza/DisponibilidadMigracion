@extends('Docentes.layouts.main')


@section('aditional_css')
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link href="{{ asset('css/adicionales.css') }}" rel="stylesheet">
@endsection


@section('location')
    <li class="breadcrumb-item"><b>PLANEACION ACADEMICA</b></li>
@endsection


@section('content')


    <div style="display: flex; justify-content: space-between; width: 100%; align-items: center; margin-top: 1%; flex-wrap: wrap;">
        <span class="text-xl text-primary titulo_Modulo" style="font-weight: 700; margin-left: 1%; line-height: 25pt">
            PLANEACION ACADEMICA
        </span>
        <div style="float: left;">
            <div style="display: flex; justify-content: center; align-items: center;">
                <div class="mx-1 my-1" style="display: flex; justify-content: end; align-items: center;">
                    <button class="btn btn-blue btn_anim" id="btn_question" data-open="infoModulo">
                        <i class="fa fa-question" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div style="display:flex; align-items: center; justify-content: end; ">
                <a onclick="location.reload()" class="ml-auto flex items-center text-primary zoomin_smooth_sm cursor-pointer">
                    <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i>
                    RECARGAR
                </a>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-6 gap-3">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">

                <!-- BEGIN: General Report -->
                <div class="col-span-12">
                    <div class="mt-5">
                        <div class="card">
                            <div class="p-3 animate__animated animate__fadeIn " style="overflow-x: auto;">
                                <table data-ordering="false" id="info" class="table w-100 table-hover">
                                    <thead style="background-color: rgb(100, 13, 100); vertical-align: middle; color:white; height: 40px; text-align: center;">
                                        <tr>
                                            <th style="vertical-align: middle;">CLAVE:</th>
                                            <th style="vertical-align: middle;">MATERIA:</th>
                                            <th style="vertical-align: middle;">ESTATUS:</th>
                                            <th style="vertical-align: middle;">CÓDIGO CLASE:</th>
                                            <th style="vertical-align: middle;">ACCESO A CLASE:</th>
                                            <th style="vertical-align: middle;">LISTA ASISTENCIA:</th>
                                            <th style="vertical-align: middle; width: 100px;">ACCIONES:</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- END: General Report -->
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


    <!-- MODAL AYUDA -->
    <div class="ourModal" id="infoModulo" data-animation="slideInOutLeft" style="display: none;">
        <div class="ourModal-dialog">
            <header class="ourModal-header">
                <h3 class="modal-title" id="exampleModalLabel"><b>INFORMACIÓN SOBRE EL MÓDULO</b></h3>
                <button onclick="limpiarModal('addPlanContent')" type="button" class="btn btn-danger btn_anim close-ourModal"
                    aria-label="close ourModal" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </header>
            <section class="ourModal-content addPlanContent">
                <div class="w-100">
                    <p>EN ESTE MODULO SE ADMINISTRAN LOS GRUPOS ASIGNADOS A CADA DOCENTE. SE PUEDE:
                        <ul class="mt-2 ml-2" style="list-style: square;">
                            <li class="ml-4 mt-2">DESCARGAR LA LISTA DE ASISTENCIA DE CADA GRUPO.</li>
                            <li class="ml-4 mt-2">AL DESPLEGAR EL SUBMENU DE ACCIONES (<i class="fa fa-chevron-down text-primary mx-1" style="font-size: 19px;"></i>) SE MUESTRAN LAS SIGUIENTES OPCIONES :
                                <ul class="mt-1" style="list-style: square;">
                                    <li class="ml-4">ACCEDER AL MODULO PARA CALIFICAR A LOS ESTUDIANTES. (<i class="fa fa-clipboard-list-check text-success mx-1" style="font-size: 19px;"></i>)</li>
                                    <li class="ml-4">HABILITAR LA EDICION DE CIERTOS DATOS DEL GRUPO (CODIGO CLASE Y CLAVE DE ACCESO A LA CLASE) . (<i class="fa fa-chalkboard-teacher text-success mx-1" style="font-size: 19px;"></i>)</li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                </div>
            </section>
            <footer>
            </footer>
        </div>
    </div>


@section('aditional_js')
    <script>
        $(document).ready(function() {
            $('#infoModulo').css('display', 'flex')
            setTimeout(() => {
                $('.preloaderDocente').css('display', 'none')
            }, 900)
        });
    </script>
    <!-- Scripts -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#info').DataTable({

            "pageLength": 7,
            "lengthMenu": [
                [7, 14, -1],
                [7, 14, "All"]
            ],
            responsive: false,
            autoWidth: false,
            "lengthChange": false,

            "language": {
                "lengthMenu": "MOSTRAR _MENU_ REGISTROS POR PÁGINA",
                "zeroRecords": "NO SE ENCONTRARON GRUPOS ASIGNADOS AL PROFESOR.",
                "info": "MOSTRANDO LA PÁGINA _PAGE_ DE _PAGES_",
                "infoEmpty": "SIN REGISTROS DISPONIBLES",
                "infoFiltered": "(SE ENCONTRARON _MAX_ REGISTROS)",
                "search": "BUSCAR:",
                "paginate": {
                    "next": "SIGUIENTE",
                    "previous": "ANTERIOR"
                }
            },
        });
    </script>
    <!--LINK QUE MANDA A TRAER LAS DEPENCIAS DE SWEET ALERT QUE SE UTILIZAN PARA TODOS LOS ALERT BOX-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function habilitarEdicion(idGrupo) {
            $('#CodigoClase' + idGrupo).css('display', 'block')
            $('#AccesoClase' + idGrupo).css('display', 'block')

            $('.lblCodigoClase' + idGrupo).css('display', 'none')
            $('.lblAccesoClase' + idGrupo).css('display', 'none')

            $('#btn_opc' + idGrupo).hide()
            $('#btn_opc' + idGrupo + " > .dropdown-toggle").removeAttr('aria-expanded')
            $('#btn_opc' + idGrupo + " > .dropdown-toggle").attr('aria-expanded', 'false')
            $('.dropdown-menu').removeClass('show')

            $('.buttons_edit' + idGrupo).css('display', 'block')
        }

        function deshabilitarEdicion(idGrupo) {
            $('#CodigoClase' + idGrupo).css('display', 'none')
            $('#AccesoClase' + idGrupo).css('display', 'none')


            $('.lblCodigoClase' + idGrupo).css('display', 'block')
            $('.lblAccesoClase' + idGrupo).css('display', 'block')

            $('#btn_opc' + idGrupo).show()
            $('.buttons_edit' + idGrupo).css('display', 'none')
        }


        tippy('#btn_question', {
            content: 'AYUDA.',
        });
    </script>


@endsection

@endsection
