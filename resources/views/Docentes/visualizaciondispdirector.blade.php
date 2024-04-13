@extends('Docentes.layouts.main')


@section('aditional_css')
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link href="{{ asset('css/adicionales.css') }}" rel="stylesheet">
@endsection


@section('location')
    <li class="breadcrumb-item"><b>DISPONIBILIDAD</b></li>
@endsection


@section('content')


    <div style="display: flex; justify-content: space-between; width: 100%; align-items: center; margin-top: 1%; flex-wrap: wrap;">
        <span class="text-xl text-primary titulo_Modulo" style="font-weight: 700; margin-left: 1%; line-height: 25pt">
            DISPONIBILIDAD
        </span>

        <div style="float: left;">

            <div style="display:flex; align-items: center; justify-content: end; ">
                <tr>
                    <td colspan="7">
                        {{--}}@if($enviado)
                            <button class="btn btn-primary" disabled>Enviar estatus</button>
                        @else
                            <form action="{{ route('enviarEstatus') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Enviar estatus</button>
                            </form>
                        @endif
                        {{--}}
                    </td>
                </tr>
            </div>
        </div>


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
                    RECARGAR PAGINA
                </a>
            </div>
        </div>


    </div>
    <div class="container center-table">
        <table class="table">
            <thead>
                <tr>
                    <th></th> <!-- Celda vacía para la esquina superior izquierda -->
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sábado</th>
                </tr>
            </thead>
            <tbody>
                @for($hour = 1; $hour < 15; $hour++)
                <tr>
                    <td> <!-- Celda de la hora -->
                        @if($hour == 1)
                        7:00 - 7:55
                        @elseif($hour == 2)
                        7:55 - 8:50
                        @elseif($hour == 3)
                        8:50 - 9:45
                        @elseif($hour == 4)
                        9:45 - 10:40
                        @elseif($hour == 5)
                        11:10 - 12:05
                        @elseif($hour == 6)
                        12:05 - 13:00
                        @elseif($hour == 7)
                        13:00 - 13:55
                        @elseif($hour == 8)
                        14:00 - 14:55
                        @elseif($hour == 9)
                        14:55 - 15:50
                        @elseif($hour == 10)
                        15:50 - 16:45
                        @elseif($hour == 11)
                        16:45 - 17:40
                        @elseif($hour == 12)
                        18:00 - 18:55
                        @elseif($hour == 13)
                        18:55 - 19:50
                        @elseif($hour == 14)
                        19:50 - 20:45
                        @endif
                    </td>
                    @for($day = 1; $day < 7; $day++)
                    <td class="disponibilidad" data-day="{{$day}}" data-hour="{{$hour}}">
                        @php
                        $disponible = $disponibilidad->where('iddias', $day)->where('idcathoras', $hour)->first();
                        @endphp
                        <button class="btn btn-default btn-disponibilidad" disabled style="{{ $disponible ? 'background-color: green;' : '' }}">Disponible</button>
                    </td>
                    @endfor
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
    
               <!-- <tr>
                    <td colspan="7">
                        {{--}}@if($enviado)
                            <button class="btn btn-primary" disabled>Enviar estatus</button>
                        @else
                            <form action="{{ route('enviarEstatus') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Enviar estatus</button>
                            </form>
                        @endif{{--}}
                    </td>
                </tr>-->
            </tbody>
        </table>
    </div>
    
    
    
    
                    <!-- END: General Report -->
                </div>
            </div>
        </div>
    </div>

<!-- resources/views/disponibilidad.blade.php -->
<script>
    // Función para cambiar el color del botón al hacer clic
    $('.btn-disponibilidad').click(function() {
        var btn = $(this);
        var day = btn.data('day');
        var hour = btn.data('hour');

  
        $.ajax({
            url: "{{ route('disponibilidad.update') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "day": day,
                "hour": hour
            },
            success: function(response) {
                if (response.disponible) {
                    btn.removeClass('btn-default').addClass('btn-success').text('Disponible');
                } else {
                    btn.removeClass('btn-success').addClass('btn-default').text('No disponible');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>



    
    






    

    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


   

@section('aditional_js')


<script>
    document.querySelectorAll('.btn-disponibilidad').forEach(button => {
        button.addEventListener('click', () => {
            button.classList.toggle('btn-success'); // Cambia el color del botón al hacer clic
            button.innerText = button.classList.contains('btn-success') ? 'Disponible' : 'No disponible'; // Cambia el texto del botón
        });
    });
</script>




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
