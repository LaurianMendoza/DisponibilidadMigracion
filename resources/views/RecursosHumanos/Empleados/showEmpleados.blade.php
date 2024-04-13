@extends('RecursosHumanos.layouts.main')

@section('aditional_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection

@section('content')

<title>SIISU - EMPLEADOS</title>

    <div style="display: flex; justify-content: space-between; width: 100%; align-items: center; margin-top: 1%;">
        <span style="font-size: 30px !important; font-weight: 700; margin-left: 1%;">
            EMPLEADOS
        </span>
        <div style="float: left;">
            <div class="btn-group mb-4">
                <button onclick="location.href=''"
                    class="btn btn-primary btn_anim" id="btn_add">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>

            <a href="" class="ml-auto flex items-center text-primary zoomin_smooth_sm">
                <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i>
                RECARGAR DATOS
            </a>
        </div>
    </div>

    <div class="col-span-12 mt-2">
        <div class="grid grid-cols-1 gap-6">
            <div class="card p-3 animate__animated animate__fadeIn ">

                <div class="p-5" style="overflow-x: auto;">

                    <div style="margin-left: 16px">
                        <input type="checkbox" id="checkboxFiltrar" class="form-check-input">
                        <label for="checkboxFiltrar" class="form-check-label">MOSTRAR INACTIVOS</label>
                    </div>

                    <table data-ordering="true" id="info" class="table w-100 table-hover">
                        <thead
                            style="background-color: rgb(100, 13, 100); vertical-align: middle; color:white;
                                height: 40px; text-align: center;">
                            <tr>
                                <th hidden style="vertical-align: middle; text-align: center;">BORRADO:</th>
                                <th style="vertical-align: middle; text-align: center;">NUMERO:</th>
                                <th style="vertical-align: middle; text-align: center;">EMPLEADO:</th>
                                <th style="vertical-align: middle; text-align: center;">PUESTO:</th>
                                <th style="vertical-align: middle; text-align: center;">AREA:</th>
                                <th style="vertical-align: middle; text-align: center;">ACCIONES:</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($empleados as $item)
                                <tr class="zoomin_smooth_smX">
                                    <td hidden style="vertical-align: middle; text-align: center;">{{ $item->borrado }}</td>
                                    <td style="vertical-align: middle; text-align: center;">{{ $item->numero }}</td>
                                    <td style="vertical-align: middle; text-align: center;">{{ $item->Empleado }}</td>
                                    <td style="vertical-align: middle; text-align: center;">{{ $item->Puesto }}</td>
                                    <td style="vertical-align: middle; text-align: center;">{{ $item->Area }}</td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <button onclick="location.href=''" class="btn btn-success btn_anim zoomin_smooth_sm" id="btn_edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
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

    <!-- LIBRERIAS PARA LOS MENSAJES EMERGENTES DE LOS BOTONES -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    @if (session('addEmpleado') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                html: 'EL EMPLEADO FUE REGISTRADO CON ÉXITO.',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
                allowOutsideClick: false,
                allowEscapeKey: false,
            })
        </script>
    @elseif (session('addEmpleado') == 'existe')
        <script>
            Swal.fire({
                icon: 'warning',
                html: 'EL EMPLEADO YA EXISTE',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
                allowOutsideClick: false,
                allowEscapeKey: false,
            })
        </script>
    @elseif (session('addEmpleado') == 'error')
        <script>
            Swal.fire({
                icon: 'error',
                html: 'ERROR AL REGISTRAR AL EMPLEADO',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
                allowOutsideClick: false,
                allowEscapeKey: false,
            })
        </script>
    @endif


    @if (session('addPersona') == 'error')
        <script>
            Swal.fire({
                icon: 'error',
                html: 'ERROR AL REGISTRAR LOS DATOS DE LA PERSONA.',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
                allowOutsideClick: false,
                allowEscapeKey: false,
            })
        </script>
    @endif


    <script>
        $(document).ready(function() {
            $('.preloaderRH').css('display', 'none')
            $('#addContacto').css('display', 'flex')
            $('#infoEmpresa').css('display', 'flex')

           var tabla = $('#info').DataTable({
                "pageLength": 6,
                responsive: false,
                autoWidth: false,
                "lengthChange": false,

                "language": {
                    "lengthMenu": "MOSTRAR _MENU_ REGISTROS POR PÁGINA",
                    "zeroRecords": "NO SE ENCONTRARON REGISTROS",
                    "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros encontrados",
                    "infoEmpty": "NO EXISTEN COINCIDENCIAS CON TU BUSQUEDA",
                    "infoFiltered": "",
                    "search": "BUSCAR:",
                    "paginate": {
                        "next": "SIGUIENTE",
                        "previous": "ANTERIOR"
                    }
                },

                initComplete: function() {
                // Evento para filtrar los datos cuando el checkbox cambie
                $('#checkboxFiltrar').on('change', function() {
                    var val = $(this).prop('checked') ? '1' : '0';
                    tabla.column(0).search(val, true, false).draw();
                });


            },

            });
            // Aplicar el filtro por defecto al cargar la tabla
            var valInicial = $('#checkboxFiltrar').prop('checked') ? '0' : '0';
                tabla.column(0).search(valInicial, true, false).draw();
        });

        tippy('#btn_edit', {
            content: 'EDITAR EMPLEADO.',
        });

        tippy('.btn_disabled', {
            content: 'DESHABILITAR EMPRESA.',
        });

        tippy('#btn_add', {
            content: 'REGISTRAR EMPLEADO.',
        });

        tippy('.btn_horarioProfesor', {
            content: 'HORARIO DE PROFESOR.',
        });
    </script>
@endsection
