<!DOCTYPE html>
<html lang="es" class="light">
<!-- BEGIN: Head -->

<head>
    <meta name="theme-color" content="#0077b5">
    <meta charset="utf-8">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIISU - DASHBOARD</title>

    <link href="{{ asset('favicons/favicon.ico') }}" rel="icon" type="image/ico">


    <link rel="stylesheet" href="{{ asset('css/DataTables/dataTable.button.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/DataTables/dataTable.responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/DataTables/dataTables.bootstrap4.min.css') }}">

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('css/ourModal.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loaderDocentes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adicionales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/countDownClock.css') }}">
    <link rel="stylesheet" href="{{ asset('FontAwesome/css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('css/tippy6.3.7/tippy.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/remodal1.1.1/remodal.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/remodal1.1.1/remodal-default-theme.css') }}">



    <link rel="stylesheet" href="{{ asset('css/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/animate4.1.1/animate.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Jquery-Confirm3.3.0/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Jquery-Confirm3.3.0/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ asset('css/sweetalert2-11.9.0/sweetalert2.min.css') }}">

    @yield('aditional_css')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->


<?php
$enlace = Request::url();
$menuChiquito = 0;
$enlace_dividido = explode('/', $enlace);
$esDashboard = 0;
$esGrupoAsignatura = 0;
$esCalificaciones = 0;
$esManual = 0;
$esExtensiones = 0;
$esReinscripciones = 0;
$esDirCarrera = 0;
$esPreRegistro = 0;
$esExamenUbicacion = 0;
$esDeptoIdiomas = 0;
$esCalifXUnidades = 0;
$esEstanciaEstadia = 0;
$esAlumnosEnEstadia = 0;
foreach ($enlace_dividido as $key) {
    if ($key == 'Dashboard') {
        $esDashboard = 1;
    } elseif ($key == 'Grupos-Asignaturas') {
        $esGrupoAsignatura = 1;
    } elseif ($key == 'Calificaciones') {
        $esCalificaciones = 1;
    } elseif ($key == 'Examen-Ubicacion') {
        $esDeptoIdiomas = 1;
        $esExamenUbicacion = 1;
    } elseif ($key == 'Extensiones-Telefonicas') {
        $esExtensiones = 1;
    } elseif ($key == 'PreRegistro-Proyectos') {
        $esPreRegistro = 1;
        $menuChiquito = 1;
    } elseif ($key == 'Manual') {
        $esManual = 1;
    } elseif ($key == 'Reinscripciones-MapaCurricular'){
        $menuChiquito = 1;
        $esReinscripciones=1;
    } elseif ($key == 'Direccion-Carrera'){
        $esDirCarrera=1;
    } elseif ($key == 'Direccion-Estancia-Estadia'){
        $esEstanciaEstadia=1;
    } elseif ($key == 'Alumnos-Realizando-Practicas'){
        $esAlumnosEnEstadia=1;
    }
}
?>


<body class="py-5" style="opacity: 1;">


    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="" class="flex mr-auto">
                <img alt="LogoUPV" class="w-6" style="width: 9rem" src="{{ asset('logos/logoUPVblanco.png') }}">
            </a>
            <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <ul class="border-t border-white/[0.08] py-5 hidden">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="menu
                    @if ($esDashboard == 1) menu--active @endif">
                    <div class="menu__icon"> <i class="fas fa-home"></i> </div>
                    <div class="menu__title"> DASHBOARD </div>
                </a>
            </li>

            <li class="menu__devider my-6"></li>

            <li>
                <a class="menu cursor-pointer @if ($esGrupoAsignatura == 1) menu--active @endif"
                    href="{{ route('docentes.indexGruposAsignaturas') }}">
                    <div class="menu__icon"> <i class="fas fa-users"></i> </div>
                    <div class="menu__title"> GRUPO - ASIGNATURA </div>
                </a>
            </li>

        </ul>
    </div>
    <!-- END: Mobile Menu -->


    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav @if ($esPreRegistro == 1 || $esReinscripciones == 1) side-nav--simple @endif">
            <a id="siisu" href="{{ route('dashboard') }}" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Midone - HTML Admin Template" class="w-8 logoUPV" style='width: 11rem'
                    src="{{ asset('logos/logoUPVblanco.png') }}">
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a id="menu-gral-dash" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                        href="{{ route('dashboard') }}"
                        class="side-menu @if ($esDashboard == 1) side-menu--active @endif">
                        <div class="side-menu__icon"><i class="fas fa-home"></i></div>
                        <div class="side-menu__title">
                            DASHBOARD
                        </div>
                    </a>
                </li>

                <li class="side-nav__devider my-6"></li>

                <li>
                    <a id="menu-gral-Calif" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                        class="side-menu cursor-pointer
                    @if ($esGrupoAsignatura == 1) side-menu--active @endif"
                        href="{{ route('docentes.indexGruposAsignaturas') }}">
                        <div class="side-menu__icon"><i class="fas fa-users"></i></div>
                        <div class="side-menu__title"> GRUPO - ASIGNATURA </div>
                    </a>
                </li>
               


                @if (session('idPerfil') == 4 || session('idPerfil') == 1)
                    <li class="side-nav__devider my-6"></li>
                    <li>
                        <a id="subMenu-gral-DirCarrera" class="side-menu cursor-pointer @if ($esPreRegistro == 1) side-menu--active @endif">
                            <div class="side-menu__icon"><i class="fas fa-books"></i></div>
                            <div class="side-menu__title">
                                DIRECCIÓN CARRERA
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="@if ($esDirCarrera == 1) side-menu__sub-open @else side-menu__sub @endif">

                            <li>
                                <a class="side-menu cursor-pointer"
                                    href="{{ route('docentes.indexDisponibilidadDirector') }}">
                                    <div class="side-menu__icon"><i class="fas fa-file-alt"></i></div>
                                    <div class="side-menu__title">DISPONIBILIDAD</div>
                                </a>
                            </li>


                        </ul>
                    </li>

                @endif


            
                <li class="side-nav__devider my-6"></li>
                <li>
                        <li>
                            <a class="side-menu cursor-pointer"id="menu-gral-Calif" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                href="{{ route('docentes.indexDisponibilidad') }}">
                                <div class="side-menu__icon"><i class="fas fa-file-alt"></i></div>
                                <div class="side-menu__title">DISPONIBILIDAD</div>
                            </a>
                        </li>


                    
                </li>
                <li class="side-nav__devider my-5"></li>
                <li>
                        <li>
                            <a class="side-menu cursor-pointer"
                                href="{{ route('docentes.indexPlaneacionAcademica') }}">
                                <div class="side-menu__icon"><i class="fas fa-file-alt"></i></div>
                                <div class="side-menu__title">PLANEACION ACADEMICA</div>
                            </a>
                        </li>


                    
                </li>

          

                {{-- DEPTO IDIOMAS --}}
                @if (session("idPerfil") == 24)
                    <li class="side-nav__devider my-6"></li>
                    <li>
                        <a class="side-menu cursor-pointer @if ($esDeptoIdiomas == 1) side-menu--active @endif">
                            <div class="side-menu__icon"><i class="fas fa-cog"></i></div>
                            <div class="side-menu__title">
                                DEPTO. IDIOMAS
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="@if ($esExamenUbicacion == 1) side-menu__sub-open @else side-menu__sub @endif">

                            <li>
                                <a class="side-menu cursor-pointer @if ($esExamenUbicacion == 1) side-menu--active @endif">
                                    <div class="side-menu__icon"><i class="fas fa-cog"></i></div>
                                    <div class="side-menu__title">
                                        EXAMEN DE UBICACION
                                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                    </div>
                                </a>
                                <ul class="@if ($esExamenUbicacion == 1) side-menu__sub-open @else side-menu__sub @endif">
                                    <li>
                                        <a href="{{ route('idiomas.Examenindex') }}" class="side-menu @if ($esExamenUbicacion == 1) side-menu--active @endif">
                                            <div class="side-menu__icon"><i class="fas fa-users"></i></div>
                                            <div class="side-menu__title">LISTA DE ASPIRANTES</div>
                                        </a>
                                    </li>

                                {{-- <li>
                                        <a href="{{ route('Procesos.showIncripciones') }}" class="side-menu">
                                            <div class="side-menu__icon"><i class="far fa-file-alt"></i></div>
                                            <div class="side-menu__title"> ASIGNAR NIVELES </div>
                                        </a>
                                    </li>--}}
                                </ul>
                            </li>

                            <li>
                                <a class="side-menu cursor-pointer @if ($esCalifXUnidades == 1) side-menu--active @endif"
                                    href="{{ route('global.CalifXUnidades') }}">
                                    <div class="side-menu__icon"><i class="fas fa-file-alt"></i></div>
                                    <div class="side-menu__title"> CALIFICACION POR UNIDADES </div>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

                <li class="side-nav__devider my-6"></li>



            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
                    <h2 class="text-s fw-700 text-primary font-medium mr-5 ml-2" style="text-transform: uppercase;">
                        {{ session('Nombre') }} {{ session('Apellidos') }}
                    </h2>
                    {{-- <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">SIISU</a></li>
                        <li class="breadcrumb-item" >DOCENTES</li>
                        @yield('location')
                    </ol> --}}
                </nav>
                <!-- END: Breadcrumb -->


                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8">
                    <div class="bg-menu-light text-white dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit  zoomin_smooth"
                        role="button" aria-expanded="false" data-tw-toggle="dropdown"
                        style="display: flex; justify-content: center; align-items: center;">
                        <span>{{ session('Nombre')[0] }}</span>
                    </div>
                    <div class="dropdown-menu w-56">
                        <ul class="dropdown-content bg-primary text-white">
                            <li class="p-2">
                                <div class="font-medium">{{ session('Nombre') }} {{ session('Apellidos') }}</div>
                                <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">
                                    {{ session('UsuarioPerfil') }}</div>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-white/[0.08]">
                            </li>
                            <li>
                                <a href="{{route('Docente.Perfil')}}"
                                    class="dropdown-item hover:bg-white/5">
                                    <i data-lucide="user" class="w-4 h-4 mr-2"></i> PERFIL </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5"> <i
                                        data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> CERRAR SESIÓN </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Account Menu -->

            </div>
            <!-- END: Top Bar -->

            <!-- BEGIN: Content -->
            @yield('content')
            <!-- END: Content -->


        </div>
    </div>

    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


    <div class="preloaderDocente" style="flex-direction: column">
        <div class="loaderDocente mb-3">
            <div class="smoke">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cup">
                <div class="body"></div>
                <div class="plate"></div>
                <div class="hand"></div>
            </div>
        </div>
        <span class="mt-5" style="font-size: 20px; color:white;">CARGANDO...</span>
    </div>


    <!-- BEGIN: JS Assets-->

    <!-- Scripts -->
    <script src="{{asset('js/sweetalert2-11.9.0/sweetalert2-11.9.0.js')}}"></script>
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('js/ourModal.js') }}"></script>
    <!-- RE Modal -->
    <script src="{{ asset('js/remodal1.1.1/remodal.min.js') }}"></script>
    <script src="{{ asset('css/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('css/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/customSelect2.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

    <!-- CDNJS DE TIPPY Y POPPER -->
    <script src="{{ asset('js/popper2.10.1/popper.min.js') }}"></script>
    <script src="{{ asset('js/tippy6.3.7/tippy-bundle.umd.min.js') }}"></script>

    <script src="{{ asset('js/customTimePicker.js') }}"></script>
    <script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts-3.44.0/apexcharts.js') }}"></script>
    {{--<script src="https://apexcharts.com/samples/vanilla-js/column/data.js"></script>--}}

    <script>
        /*----------------------- VALIDAR TIEMPO DE INACTIVIDAD -----------------------*/
            let timer; // variable global para almacenar el temporizador
            let activo = 0
            resetTimer()
            function resetTimer() {
                // reiniciar el temporizador cada vez que se detecta una actividad
                clearTimeout(timer);
                if(activo == 0){
                    //console.log("se valido activo")
                    //timer = setTimeout(showMessage, 1000); // mostrar el mensaje después de 10 segundos de inactividad
                    timer = setTimeout(showMessage, 360000); // mostrar el mensaje después de 6 min de inactividad
                }
            }

            function showMessage() {
                // mostrar el mensaje
                activo = 1
                //console.log("activo se hizo 1")
                $.confirm({
                    title: 'ALERTA!',
                    content: 'LA SESIÓN ESTA POR EXPIRAR.',
                    autoClose: 'logoutUser|60000',
                    buttons: {
                        logoutUser: {
                            text: 'CERRAR SESIÓN',
                            action: function () {
                                $.alert('LA SESIÓN HA EXPIRADO');
                                let url = "{{ route('logout') }}"
                                window.location.href = url;
                            }
                        },
                        PERMANECER: function () {
                            $.alert('SIGUE TRABAJANDO 👀');
                            resetTimer()
                            activo = 0
                            //console.log("activo se hizo 0")
                        }
                    }
                });
            }

            // detectar la actividad del usuario
            document.addEventListener("mousemove", resetTimer); // cuando el usuario mueve el ratón
            document.addEventListener("keydown", resetTimer); // cuando el usuario presiona una tecla
            document.addEventListener("click", resetTimer);
        /*------------------------------------------------------------------------------*/

        $(document).ready(function() {
            let menuChiquito = '{{$menuChiquito}}'
            if(menuChiquito == 1){
                $('.side-nav').addClass('side-nav--simple')
            }

            $.ajax({
                type: "get",
                url: "{{ route('docentes.returnDiasRestantesFinCuatri') }}",
                dataType: 'json',
                success: function(datos) {
                    if(datos <= 10){
                        $('.content_all_clock').css('display', 'flex')
                    }
                },
                error: function(error) {
                    console.log('.....ERROR AL CONSULTAR LOS DATOS.....')
                }
            })

        })

        function timeCountDown() {
            if ($('.content_all_clock').hasClass('close-timer')) {
                $('.content_all_clock').addClass('open-timer-profe')
                $('.content_all_clock').removeClass('close-timer')
            } else {
                $('.content_all_clock').removeClass('open-timer-profe')
                $('.content_all_clock').addClass('close-timer')
            }

            if ($('.container_icon').is(":visible")) {
                $('.container_icon').css('display', 'none')
            } else {
                $('.container_icon').css('display', 'flex')
            }

            if ($('.container_content_clock').is(":visible")) {
                $('.container_content_clock').css('display', 'none')
            } else {
                setTimeout(() => {
                    $('.container_content_clock').css('display', 'block')
                    $.ajax({
                        type: "get",
                        url: "{{ route('docentes.returnFinCuatri') }}",
                        dataType: 'json',
                        success: function(datos) {
                            let arr = Object.values(datos)

                            console.log(datos)

                            function getTimeRemaining(endtime) {
                                var t = Date.parse(datos) - Date.now();
                                var minutes = Math.floor((t / 1000 / 60) % 60);
                                var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
                                var days = Math.floor(t / (1000 * 60 * 60 * 24));
                                return {
                                    'total': t,
                                    'days': days,
                                    'hours': hours,
                                    'minutes': minutes,
                                };
                            }

                            function initializeClock(id, endtime) {
                                var clock = document.getElementById(id);
                                var daysSpan = clock.querySelector('.days');
                                var hoursSpan = clock.querySelector('.hours');
                                var minutesSpan = clock.querySelector('.minutes');

                                function updateClock() {
                                    var t = getTimeRemaining(endtime);

                                    daysSpan.innerHTML = t.days;
                                    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                                    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);

                                    if (t.total <= 0) {
                                        clearInterval(timeinterval);
                                    }
                                }

                                updateClock();
                                var timeinterval = setInterval(updateClock, 1000);
                            }
                            // count down timer:
                            var deadline = new Date(Date.now() + 1 * 30 * 60 * 60 * 1000);
                            initializeClock('clockdiv', deadline);
                        },
                        error: function(error) {
                            console.log('.....ERROR AL CONSULTAR LOS DATOS.....')
                        }
                    });
                }, 400)
            }
        }

        function genTippys() {
            tippy('#menu-gral-dash', {
                content: 'DASHBOARD.',
                placement: 'right',
            });

            tippy('#menu-gral-Calif', {
                content: 'GRUPO-ASIGNATURA.',
                placement: 'right',
            });

            tippy('#menu-gral-Extensiones', {
                content: 'DIRECTORIO TELEFONICO.',
                placement: 'right',
            });

            tippy('#subMenu-gral-Manual', {
                content: 'MANUAL DE USUARIO.',
                placement: 'right',
            });

            tippy('#subMenu-gral-Reinscripciones', {
                content: 'REINSCRIPCIONES.',
                placement: 'right',
            });

            tippy('#subMenu-gral-Practicas', {
                content: 'ESTANCIAS / ESTADIAS.',
                placement: 'right',
            });

            tippy('#sub_Candidatos', {
                content: 'CANDIDATOS A PRACTICAS.',
                placement: 'right',
            });

            tippy('#siisu', {
                content: 'SISTEMA INTEGRAL DE INFORMACIÓN Y SERVICIOS UNIVERSITARIOS.',
                placement: 'right',
            });
        }

        function formatFecha(fechaOriginal){
            if(fechaOriginal == ''){
                return '--'
            }
            const componentesFecha = fechaOriginal.split("-");
            const año = componentesFecha[0];
            const mes = componentesFecha[1];
            const dia = componentesFecha[2];

            // Crear un objeto Date con los componentes de la fecha
            const fecha = new Date(año, mes - 1, dia); // El mes se resta en 1 ya que en JavaScript los meses van de 0 a 11

            // Obtener los componentes de la nueva fecha en el formato "d-m-y"
            const nuevoDia = fecha.getDate();
            const nuevoMes = fecha.getMonth() + 1; // Se suma 1 porque los meses son de 0 a 11
            const nuevoAño = fecha.getFullYear();

            // Formatear la fecha en el nuevo formato "d-m-y"
            const fechaFormateada = `${nuevoDia}/${nuevoMes}/${nuevoAño}`;
            return fechaFormateada
        }


        function abrirModal(id){
            document.getElementById(id).classList.add(isVisible);
        }

        function cerrarModal(id){
            document.getElementById(id).classList.remove(isVisible);
        }
    </script>

    @if ($esPreRegistro == 0 || $esReinscripciones == 0)
        <script>
            if ($(window).width() < 1370) {
                $('.cont_datos').css('flex-direction', 'column')
                $('.side-nav').addClass('side-nav--simple')
                $('.sissu-title').css('display', 'none')
                $('.side-menu__icon').css('font-size', '24px')
                $('.dr-mode-content').css('display', 'none')
                $('.logoUPV').removeAttr('src')
                $('.logoUPV').attr('src', '{{ asset('logos/NewlogoUPVblanco.png') }}')
                $('.logoUPV').css('width', '170px')
                $('.logoUPV').css('height', '40px')

                genTippys()

            } else if ($(window).width() > 1370) {
                $('.cont_datos').css('flex-direction', 'row')
                $('.side-nav').removeClass('side-nav--simple')
                $('.sissu-title').css('display', 'block')
                $('.dr-mode-content').css('display', 'flex')

                $('.logoUPV').attr('src', '{{ asset('logos/logoUPVblanco.png') }}')
                $('.logoUPV').css('width', '170px')
                $('.logoUPV').css('height', '68px')
                $('.side-nav').removeClass('side-nav--simple')
            }

            if ($(window).width() < 1200) {
                $('.pdfViewerMobileContainer').css('display', 'flex')
                $('.iframePdf').css('display', 'none')

                $('.btn_info_class_mobile').css('display', 'flex')
                $('.menu-area').css('display', 'none')
            } else if ($(window).width() > 1200) {
                $('.pdfViewerMobileContainer').css('display', 'none')
                $('.iframePdf').css('display', 'block')

                $('.menu-area').css('display', 'flex')
                $('.btn_info_class_mobile').css('display', 'none')
            }

            if ($(window).width() < 900) {
                $('.titulo_Modulo').removeClass('text-xl')
                $('.titulo_Modulo').addClass('text-l')

                $('.form-group').addClass('mb-3')
                $('.cont_referencias').addClass('mb-2')


                $('.header_info').addClass('flex-div-row')
                $('.header_info').removeClass('flex-div-col')

                $('.btn_editRef').removeClass('w-15')
                $('.btn_editRef').addClass('w-90')

                document.addEventListener('touchmove', e => {
                    if (e.touches.length > 1) {
                        e.preventDefault();
                    }
                }, {
                    passive: false
                })
            } else if ($(window).width() > 900) {
                $('.titulo_Modulo').removeClass('text-m')
                $('.titulo_Modulo').addClass('text-xl')

                $('.header_info').addClass('flex-div-row')
                $('.header_info').removeClass('flex-div-col')

                $('.form-group').removeClass('mb-3')
                $('.cont_referencias').removeClass('mb-2')

                $('.btn_editRef').addClass('w-15')
                $('.btn_editRef').removeClass('w-70')
            }

            if ($(window).width() < 800) {
                $('.ruta-mobile').css('display', 'flex')
                $('.ruta-pc').css('display', 'none')
            } else if ($(window).width() > 800) {
                $('.ruta-mobile').css('display', 'none')
                $('.ruta-pc').css('display', 'flex')
            }

            $(window).resize(function() {
                //aqui el codigo que se ejecutara cuando se redimencione la ventana
                var alto = $(window).height();
                var ancho = $(window).width();

                if (ancho > 1370) {
                    $('.cont_datos').css('flex-direction', 'row')

                    $('.datos_perfil').addClass('col-lg-8')
                    $('.datos_perfil').removeClass('w-100')

                    $('.foto_perfil').addClass('col-lg-4')
                    $('.foto_perfil').removeClass('w-100')

                    $('.logoUPV').attr('src', '{{ asset('logos/logoUPVblanco.png') }}')
                    $('.logoUPV').css('width', '170px')
                    $('.logoUPV').css('height', '68px')
                    $('.side-nav').removeClass('side-nav--simple')

                } else if (ancho < 1370) {
                    $('.cont_datos').css('flex-direction', 'column')

                    $('.datos_perfil').removeClass('col-lg-8')
                    $('.datos_perfil').addClass('w-100')

                    $('.foto_perfil').removeClass('col-lg-4')
                    $('.foto_perfil').addClass('w-100')

                    $('.side-nav').addClass('side-nav--simple')

                    $('.logoUPV').attr('src', '{{ asset('logos/NewlogoUPVblanco.png') }}')
                    $('.logoUPV').css('width', '170px')
                    $('.logoUPV').css('height', '40px')

                }

                if (ancho < 900) {
                    $('.titulo_Modulo').removeClass('text-xl')
                    $('.titulo_Modulo').addClass('text-m')

                    $('.flex-div-row').addClass('flex-div-col')
                    $('.flex-div-col').removeClass('flex-div-row')
                    $('.form-group').addClass('mb-3')
                    $('.cont_referencias').addClass('mb-2')

                    $('.btn_editRef').removeClass('w-15')
                    $('.btn_editRef').addClass('w-90')

                    $('.btn_saveRef').removeClass('w-15')
                    $('.btn_saveRef').addClass('w-90')

                } else if (ancho > 900) {
                    $('.titulo_Modulo').removeClass('text-m')
                    $('.titulo_Modulo').addClass('text-xl')

                    $('.flex-div-col').addClass('flex-div-row')
                    $('.flex-div-row').removeClass('flex-div-col')
                    $('.form-group').removeClass('mb-3')
                    $('.cont_referencias').removeClass('mb-2')

                    $('.btn_editRef').addClass('w-15')
                    $('.btn_editRef').removeClass('w-70')

                    $('.btn_saveRef').addClass('w-15')
                    $('.btn_saveRef').removeClass('w-70')

                }

                if (ancho < 800) {
                    $('.ruta-mobile').css('display', 'flex')
                    $('.ruta-pc').css('display', 'none')
                } else if (ancho > 800) {
                    $('.ruta-mobile').css('display', 'none')
                    $('.ruta-pc').css('display', 'flex')
                }
            })
        </script>
    @endif

    @if ($esPreRegistro == 1 || $esReinscripciones == 1)
        <script>
            $('.logoUPV').removeAttr('src')
            $('.logoUPV').attr('src', '{{ asset('logos/NewlogoUPVblanco.png') }}')
            $('.logoUPV').css('width', '170px')
            $('.logoUPV').css('height', '40px')
            genTippys()
        </script>
    @endif



    @yield('aditional_js')

</body>

</html>
