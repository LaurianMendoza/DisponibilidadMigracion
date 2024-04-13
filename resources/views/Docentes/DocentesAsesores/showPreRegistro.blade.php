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
        <span style="font-size: 24px !important; font-weight: 700; margin-left: 1%;">
            <label class="text-l fw-700font-medium  ml-2">PRE-REGISTRO DEL ALUMNO</label>
            <label class="text-l text-primary font-medium ">{{ $datosAlumno[0]->Estudiante }}</label><br>
        </span>
        <div style="float: left;">

            <div style="display: flex; justify-content: center; align-items: center;">

                @if ($datosPreRegistro[0]->estatus != 202)
                    <button data-open="modalObservaciones" class="tooltip btn btn-blue btn_anim mx-1" title="HACER OBSERVACIÓN" id="btn_Observaciones">
                        <i class="fas fa-comments"></i>
                    </button>
                @endif
                @if ($datosPreRegistro[0]->estatus != 200)

                <form action="{{route('docentes.asesores.AceptarProyecto')}}" method="POST" id="FormAceptarProyecto">
                    @csrf
                    @method('put')
                    <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">

                        <input value="{{base64_encode($idAlumno)}}" type="hidden" id="idAlumnoo" name="idAlumnoo">
                        <input value="{{base64_encode($datosPreRegistro[0]->idAlumnoRegistroProyecto)}}" type="hidden" id="idProyectoo" name="idProyectoo">

                        <div style="width: 100%; display: flex; justify-content: end; align-items: center;">
                            <button type="submit" class="tooltip btn btn-success btn_anim mx-1" id="btn_aceptarProyecto"><i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </form>

                @endif
                <button class="tooltip btn btn-danger btn_anim mx-1" onclick="location.href='{{route('docentes.asesores.showCandidatosPracticas')}}'" id="btn_atras"><i class="fas fa-arrow-alt-to-left"></i></button>

            </div>
        </div>
    </div>

    <div class="card p-3">
        <div class="p-3 animate__animated animate__fadeIn w-100" style="display: flex; justify-content: space-around; align-items: center; flex-direction: row;">
            <div class="w-100">
                <div>
                    <label style="font-size: 18px;"><b>FECHA DE CREACION DEL PRE-REGISTRO:</b></label><br>
                    <span>
                        @if ($datosPreRegistro != [] || $datosPreRegistro != NULL)
                            {{ $datosPreRegistro[0]->fechaRegistro }}
                        @else
                            ----
                        @endif
                    </span>
                </div>
                <div class="mt-2">
                    <label style="font-size: 18px;"><b>NOMBRE DEL PROYECTO:</b></label><br>
                    <span>
                        @if ($datosPreRegistro != [] || $datosPreRegistro != NULL)
                            {{ $datosPreRegistro[0]->NombreProyecto }}
                        @else
                            ----
                        @endif
                    </span>
                </div>
                <div class="mt-2">
                    <label style="font-size: 18px;"><b>EMPRESA:</b></label><br>
                    <span>
                        @if ($datosPreRegistro != [] || $datosPreRegistro != NULL)
                            {{ $datosPreRegistro[0]->Empresa }}
                        @else
                            ----
                        @endif
                    </span>
                </div>
            </div>

            <div class="w-100">
                <div>
                    <label style="font-size: 18px;"><b>ASESOR EMPRESARIAL:</b></label><br>
                    <span>
                        @if ($datosPreRegistro != [] || $datosPreRegistro != NULL)
                            {{ $datosPreRegistro[0]->NombreAsesor }}
                        @else
                            ----
                        @endif
                    </span>
                </div>
                <div class="mt-2">
                    <label style="font-size: 18px;"><b>CORREO ASESOR EMPRESARIAL:</b></label><br>
                    <span>
                        @if ($datosPreRegistro != [] || $datosPreRegistro != NULL)
                            {{ $datosPreRegistro[0]->CorreoAsesor }}
                        @else
                            ----
                        @endif
                    </span>
                </div>
                <div class="mt-2">
                    <label style="font-size: 18px;"><b>TELÉFONO ASESOR EMPRESARIAL:</b></label><br>
                    <span>
                        @if ($datosPreRegistro != [] || $datosPreRegistro != NULL)
                            {{ $datosPreRegistro[0]->TelefonoAsesor }}
                        @else
                            ----
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-3 p-3 w-100">
            <label style="font-size: 25px;"><b>ESTATUS DEL PROYECTO</b></label>

            <div class="cont_badge">
                @if ($datosPreRegistro[0]->estatus == 200)
                    <span class="right badge badge-success">
                        ACEPTADO
                    </span>
                @elseif ($datosPreRegistro[0]->estatus == 201)
                    <span class="right badge" style="background-color: rgb(255, 155, 6) !important;">
                        EN REVISION
                    </span>
                @elseif ($datosPreRegistro[0]->estatus == 202)
                    <span class="right badge badge-primary">
                        EN OBSERVACIONES
                    </span>
                @endif
            </div>
        </div>

        <div class="mt-3 p-3 w-100">
            <label style="font-size: 25px;"><b>MATERIA</b></label>
            <p><span>{{$datosPreRegistro[0]->Materia}}</span></p>
        </div>

        {{-- DIV QUE CONTIENE EL OBJETIVO GENERAL EN CASO DE ESTADIA --}}
        @if ($datosPreRegistro[0]->idMateria == 124)
            <div class="mt-3 p-3 w-100">
                <div class="mt-2">
                    <label style="font-size: 25px;"><b>OBJETIVO GENERAL:</b></label><br>

                    @if ($datosPreRegistro != [] || $datosPreRegistro != null)
                        <p class="w-90"><span>{{$datosPreRegistro[0]->objGenerales}}</span></p>
                    @else
                        <p><span>----</span></p>
                    @endif
                </div>
            </div>
        @endif

        {{-- DIV QUE CONTIENE LAS ACTIVIDADES DEL PROYECTO --}}
        <div class="mt-3 p-3 w-100">
            <div class="mt-2">
                @if ($datosPreRegistro[0]->idMateria == 124)
                    <label style="font-size: 25px;"><b>OBJETIVOS ESPECIFICOS:</b></label><br>
                @elseif ($datosPreRegistro[0]->idMateria != 124)
                    <label style="font-size: 25px;"><b>ACTIVIDADES DEL PROYECTO:</b></label><br>
                @endif

                @if ($datosPreRegistro != [] || $datosPreRegistro != null)
                    <?php $arrActividades = explode('/', $datosPreRegistro[0]->Descripcion); ?>
                    <ul style="list-style-type: square;">
                        @foreach ($arrActividades as $act)
                            <li style="margin-left: 1.4%;">
                                @if ($act != [] || $act != null)
                                    {{ $act }}
                                @else
                                    ----
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <span>----</span>
                @endif
            </div>
        </div>


        {{-- DIV QUE CONTIENE LOS COMENTARIOS DEL PROYECTO --}}
        <div class="mt-3 p-3 w-100">
            <div class="mt-2">
                <label style="font-size: 25px;"><b>COMENTARIOS:</b></label><br>
                @if ($comentariosProyecto != [] || $comentariosProyecto != null)
                    @foreach ($comentariosProyecto as $comentario)
                        <span>
                            <ul style="list-style-type: square;"><li style="margin-left: 1.4%;">{{$comentario->comentario}}</li></ul>
                        </span>
                    @endforeach
                @else
                    <span>----</span>
                @endif
            </div>
        </div>

    </div>




    <div class="ourModal" id="modalObservaciones" data-animation="slideInOutLeft" style="display: none;">
        <div class="ourModal-dialog" style="width: 680px !important; min-width: 300px !important;">
            <header class="ourModal-header">
                <h3 class="modal-title mx-2" id="exampleModalLabel">
                    <b>AGREGAR OBSERVACIÓN</b>
                </h3>
                <button onclick="cleanModalHorarios()" type="button" class="btn btn-danger close-ourModal mx-2 zoomin_smooth" aria-label="close ourModal" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </header>
            <section class="ourModal-content addNewCand" style="overflow-x: auto">
                <div>
                    <div>
                        <form action="{{route('docentes.asesores.AddObservacion',[base64_encode($idAlumno)])}}" method="POST" id="FormAddObservacion">
                            @csrf
                            @method('put')
                            <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                <div class="w-100" style="vertical-align: middle;">
                                    <span>
                                        <b>AGREGA UNA OBSERVACION AL PROYECTO:</b><br>
                                        (NOTA: SE PUEDE HACER CLIC EN AGREGAR SIN ESCRIBIR ALGUNA OBSERVACIÓN)
                                    </span>
                                    <input value="{{base64_encode($datosPreRegistro[0]->idAlumnoRegistroProyecto)}}" type="hidden" id="idProyecto" name="idProyecto">
                                    <textarea id="textAreaComent" style="height: 100px; border-radius: 12px; font-size: 15px;" name="comentario" placeholder="Comentario..."></textarea>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: center;">
                                    <button type="submit" class="btn btn-primary btn_animNone zoomin_smooth_sm">AGREGAR</button>
                                </div>
                            </div>
                        </form>
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
        tippy('#btn_Observaciones', {
            content: 'AGREGAR OBSERVACIONES.',
        });
        tippy('#btn_aceptarProyecto', {
            content: 'ACEPTAR PRE-REGISTRO.',
        });
        tippy('#btn_atras', {
            content: 'REGRESAR.',
        });

        $(document).ready(function() {
            setTimeout(() => {
                $('.preloaderDocente').css('display', 'none')
            }, 900)
            $('#modalObservaciones').css('display', 'flex')
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
        });

        $('#info').DataTable({
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

        function cleanModal() {
            $('.cont-formNewCand').find('input[type="text"]', 'select]').each(function() {
                $(this).val('')
            });
        }
    </script>
    <!--LINK QUE MANDA A TRAER LAS DEPENCIAS DE SWEET ALERT QUE SE UTILIZAN PARA TODOS LOS ALERT BOX-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('aceptProyecto') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                html: 'PROYECTO APROBADO CON ÉXITO.',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
            })
        </script>
        @endif

    @if (session('addObservacion') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                html: 'OBSERVACIONES REGISTRADAS CON ÉXITO.',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
            })
        </script>
    @elseif (session('addObservacion') == 'error')
        <script>
            Swal.fire({
                icon: 'error',
                html: 'ERROR AL AGREGAR LAS OBSERVACIONES.',
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


<script>
    $('#FormAceptarProyecto').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                html: '¿CONFIRMA ACEPTAR EL PROYECTO DEL ALUMNO?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#640d64',
                cancelButtonColor: '#d33',
                cancelButtonText: 'CANCELAR',
                confirmButtonText: 'CONFIRMAR'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            })
        });
</script>
@endsection

@endsection
