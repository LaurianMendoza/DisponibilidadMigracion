@extends('Docentes.layouts.main')

@section('aditional_css')
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link href="{{ asset('css/adicionales.css') }}" rel="stylesheet">
    <link href="{{ asset('FontAwesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/top-notifications/top-notifications.css') }}">
@endsection

@section('content')
    <div class="mb-3"
        style="display: flex; justify-content: space-between; width: 100%; align-items: center; margin-top: 1%;">
        <span style="font-size: 30px !important; font-weight: 700; margin-left: 1%;">
            <label class="text-l fw-700 text-primary font-medium mr-5 ml-2">ALUMNOS CANDIDATOS A PRÁCTICAS</label>
        </span>
        <div style="float: left;">
            <div class="intro-y flex items-center h-10">
                <a onclick="location.reload()" class="ml-auto flex items-center text-primary cursor-pointer">
                    <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i>
                    RECARGAR PÁGINA
                </a>
            </div>
        </div>
    </div>

    @if($periodoPracticas != [])
        <!-- Muestra nombre del cuatrimestre del periodo activo para estancia -->
        <span style="font-size: 20px !important; margin-left: 1.4%" class="text-primary">PERIODO {{$periodoPracticas[0]->cuatrimestre}}</span>
    @else
        <span style="font-size: 20px !important; margin-left: 1.4%" class="text-danger">NO EXISTE PERIODO ACTIVO</span>
    @endif

    <div class="card">
        <div class="p-3 animate__animated animate__fadeIn" style="overflow-x: auto;">
            <table data-ordering="false" id="info" class="table w-100">
                <thead
                    style="background-color: purple; vertical-align: middle; color:white; height: 40px; text-align: center;">
                    <tr>
                        <th style="vertical-align: middle;"> </th>
                        <th style="vertical-align: middle;">ALUMNO:</th>
                        <th style="vertical-align: middle;">MATRÍCULA:</th>
                        <th style="vertical-align: middle;">PLAN DE ESTUDIOS:</th>
                        <th style="vertical-align: middle;">PRÁCTICAS A REALIZAR:</th>
                        <th style="vertical-align: middle;">ESTATUS PRE-REGISTRO:</th>
                        <th style="vertical-align: middle;">ACCIONES:</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($alumnos as $item)
                        <tr style="text-align: center;">
                            <td style="vertical-align: middle;"> </td>
                            <td style="vertical-align: middle;">
                                <label for="checkButton">
                                    {{ $item->Nombre }}
                                </label>
                            </td>
                            <td style="vertical-align: middle;">{{ $item->Matricula }}</td>
                            <td style="vertical-align: middle;">{{ $item->PlanEstudio }}</td>
                            <td style="vertical-align: middle;">{{ $item->Materia }}</td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="columnAsesor{{ $item->idAlumno }}">
                                    <div id="cont_badge_estatus_asesor_{{ $item->idAlumno }}">
                                        @if ($item->EstatusPreRegistro != NULL)
                                            @foreach ($estatusPreRegistro as $estatus)
                                                @if ($estatus->IdCatalogo == $item->EstatusPreRegistro)
                                                    @if ($estatus->IdCatalogo == 200)
                                                        <span class="right badge badge-success">
                                                            {{$estatus->Nombre}}
                                                        </span>
                                                    @elseif ($estatus->IdCatalogo == 201)
                                                        <span class="right badge badge-warning">
                                                            {{$estatus->Nombre}}
                                                        </span>
                                                    @elseif ($estatus->IdCatalogo == 202)
                                                        <span class="right badge badge-primary">
                                                            {{$estatus->Nombre}}
                                                        </span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @else
                                            <span class="right badge badge-danger">
                                                SIN PRE-REGISTRO
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">


                                <div class="columnAsesor{{ $item->idAlumno }}">
                                    <div id="cont_badge_estatus_asesor_{{ $item->idAlumno }}">
                                        @if ($item->EstatusPreRegistro != NULL)
                                            @foreach ($estatusPreRegistro as $estatus)
                                                @if ($estatus->IdCatalogo == $item->EstatusPreRegistro)
                                                <button onclick="location.href='{{route('docentes.asesores.showPreRegistroCandidato',[base64_encode($item->idAlumno)])}}'" data-open="modaleditCandidato" class="tooltip btn btn-warning btn_anim btn_AsignarAsesor"  id="btnCandidato{{ $item->idAlumno }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @endif
                                            @endforeach
                                        @else
                                        <button disabled data-open="modaleditCandidato" class="btn btn-warning btn_anim " id="btnCandidato{{ $item->idAlumno }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>








    <div class="ourModal" id="modalInfo" data-animation="slideInOutLeft" style="display: none;">
        <div class="ourModal-dialog" style="width: 680px !important; min-width: 300px !important;">
            <header class="ourModal-header">
                <h3 class="modal-title mx-2" id="exampleModalLabel">
                    <b>INFORMACIÓN</b>
                </h3>
                <button onclick="cleanModalHorarios()" type="button"
                    class="btn btn-danger close-ourModal mx-2 zoomin_smooth" aria-label="close ourModal" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </header>
            <section class="ourModal-content addNewCand" style="overflow-x: auto">
                <div class="cont-HorariosDinamicos">
                    <div>
                        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                            <div class="w-100" style="vertical-align: middle;">
                                <span>
                                    <b>DEBES ASIGNAR AL MENOS 1 DOCENTE COMO ASESOR PARA CALCULAR
                                        LOS CANDIDATOS A PRÁCTICAS, ESTO LO PUEDES HACER EN EL
                                        MÓDULO DE ASESORES EN EL APARTADO DE DIRECCIÓN ACADÉMICA > ESTANCIAS > ASESORES
                                    </b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@section('aditional_js')
    <!-- Scripts -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
        tippy('#btn_genCandidatos', {
            content: 'CALCULAR CANDIDATOS A PRACTICAS.',
        });
        tippy('.btn_del', {
            content: 'ELIMINAR CANDIDATO.',
        });
        tippy('#btn_addCandidato', {
            content: 'AGREGAR CANDIDATO.',
        });
        tippy('.btn_AsignarAsesor', {
            content: 'VER DATOS DE PRE-REGISTRO DEL PROYECTO.',
        });
        tippy('#btn_question', {
            content: '¿NO APARECE EL BOTÓN PARA CALCULAR CANDIDATOS A PRÁCTICAS?.',
        });

        $('#info').on('draw', function() {
            tippy('#btn_Estancias1', {
                content: 'ESTANCIAS I.',
            });
            tippy('#btn_Estancias2', {
                content: 'ESTANCIAS II.',
            });
            tippy('#btn_Estadias', {
                content: 'ESTADIAS.',
            });
        });
        $(document).ready(function() {
            setTimeout(() => {
                $('.preloaderDocente').css('display', 'none')
            }, 900)
            $('#modalInfo').css('display', 'flex')
            $('#modalAddNewCandidato').css('display', 'flex')
            $('#modaleditCandidato').css('display', 'flex')
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
        });

        tabla = $('#info').DataTable({
            "pageLength": 8,
            responsive: false,
            autoWidth: false,
            "lengthChange": false,

            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "NO SE ENCONTRARON REGISTROS...",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(Se encontraron _MAX_ registros)",
                "search": "Buscar:",
                "paginate": {
                    "NEXT": "SIGUIENTE",
                    "PREVIOUS": "ANTERIOR"
                }
            },
        });

        tabla.on( 'order.dt search.dt', function () {
            tabla.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        function cleanModal() {
            $('.cont-formNewCand').find('input[type="text"]', 'select]').each(function() {
                $(this).val('')
            });
        }





    </script>
    <!--LINK QUE MANDA A TRAER LAS DEPENCIAS DE SWEET ALERT QUE SE UTILIZAN PARA TODOS LOS ALERT BOX-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('candidatoDelete') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                html: 'CANDIDATO ELIMINADO CON ÉXITO.',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
            })
        </script>
    @elseif (session('candidatoDelete') == 'error')
        <script>
            Swal.fire({
                icon: 'error',
                html: 'ERROR AL INTENTAR ELIMINAR AL CANDIDATO.',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
            })
        </script>
    @elseif (session('candidatoDelete') == 'no se puede')
        <script>
            Swal.fire({
                icon: 'error',
                html: ' .',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
            })
        </script>
    @endif

    <script>
        function 卵() {
            Swal.fire({
                icon: 'info',
                html: 'HUEVO DE PASCUA 2/10\n LA PIZZA CON PIÑA ESTA EXQUISITA',
                showConfirmButton: true,
            }).then((result) => {
                if (result.value) {
                    location.reload()
                }
            })
        }
    </script>
@endsection

@endsection
