<!DOCTYPE html>
<html lang="es" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('favicons/favicon.ico') }}" rel="icon" type="image/ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('css/ourModal.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/loaderRH.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adicionales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/countDownClock.css') }}">
    <link rel="stylesheet" href="{{ asset('FontAwesome/css/all.css') }}">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal-default-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.css" />

    <link rel="stylesheet" href="{{ asset('css/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <style>
        .select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: var(--RH_main_color);}
        .nav-link.active { background-color: var(--RH_main_color) !important; }
        .table thead{background-color: var(--RH_main_color) !important; }
        .ruta-mobile,.ruta-pc{color: var(--RH_main_color) !important;}
        .btn-primary{background-color: var(--RH_main_color) !important; border-color:var(--RH_main_color) !important;}
        .top-nav > ul li ul,.top-nav > ul li ul::before, .top-nav > ul li ul ul{ background-color: var(--RH_main_color_hover) !important;}
        html{ --color-primary: var(--RH_main_color); background-color: var(--RH_main_color) !important; }
        body{ background-color: var(--RH_main_color) !important; }
        .bg-primary{ background-color: var(--RH_main_color) !important; }
        .bg-menu-light{ background-color: var(--RH_main_color) !important; }
        .text-primary{ color:var(--RH_main_color) !important; }.text-primary:hover{ color:var(--RH_main_color_hover) !important; }
    </style>

    @yield('aditional_css')

    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->





<body class="py-5" style="opacity: 1;">

       {{-- <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="dist/images/logo.svg">
                </a>
                <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <div class="scrollable">
                <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
                <ul class="scrollable__content py-2">
                    <li>
                        <a href="javascript:;.html" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="menu__title"> Dashboard <i data-lucide="chevron-down" class="menu__sub-icon transform rotate-180"></i> </div>
                        </a>
                        <ul class="menu__sub-open">
                            <li>
                                <a href="index.html" class="menu menu--active">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Overview 1 </div>
                                </a>
                            </li>
                            <li>
                                <a href="side-menu-light-dashboard-overview-2.html" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Overview 2 </div>
                                </a>
                            </li>
                            <li>
                                <a href="side-menu-light-dashboard-overview-3.html" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Overview 3 </div>
                                </a>
                            </li>
                            <li>
                                <a href="side-menu-light-dashboard-overview-4.html" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Overview 4 </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Mobile Menu -->--}}


    <!-- BEGIN: Menú para moviles -->
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
                <a href="{{ route('dashboard') }}" class="menu">
                    <div class="menu__icon"> <i class="fas fa-home"></i> </div>
                    <div class="menu__title"> DASHBOARD </div>
                </a>
            </li>

            <li class="menu__devider my-6"></li>


        </ul>
    </div>
    <!-- END: Mobile Menu -->


    <div class="">
        {{--<!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a id="siisu" href="{{ route('dashboard') }}" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Midone - HTML Admin Template" class="w-8 logoUPV" style='width: 11rem'
                    src="{{ asset('logos/logoUPVblanco.png') }}">
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a id="menu-gral-dash" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                        href="{{ route('RH.dashboard') }}"
                        class="side-menu @if (Route::currentRouteName() == 'RH.dashboard') sub-menu-active @endif">
                        <div class="side-menu__icon"><i class="fas fa-home"></i></div>
                        <div class="side-menu__title">
                            DASHBOARD
                        </div>
                    </a>
                </li>


                <li class="side-nav__devider my-6"></li>
                <li>
                    <a id="menu-gral-Informes"
                        class="side-menu cursor-pointer @if (in_array(Route::currentRouteName(), ['RH.empleados.showEmpleados'])) side-menu--active @endif">
                        <div class="side-menu__icon"><i class="fas fa-file-chart-line"></i></div>
                        <div class="side-menu__title">
                            EMPLEADOS
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>

                    <ul class="@if (in_array(Route::currentRouteName(), ['RH.empleados.showEmpleados'])) side-menu__sub-open @else side-menu__sub @endif">
                        <li class="zoomin_smooth_sm">
                            <a id="subMenu-proc-reins" href="{{ route('RH.empleados.showEmpleados') }}"
                                class="side-menu cursor-pointer @if(Route::currentRouteName() == 'RH.empleados.showEmpleados') sub-menu-active @endif">
                                <div class="side-menu__icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="side-menu__title">
                                    PERSONAL
                                </div>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="side-nav__devider my-6"></li>
                <li>
                    <a id="menu-gral-Informes"
                        class="side-menu cursor-pointer @if (in_array(Route::currentRouteName(), ['RH.reportes.horarioprofesor'])) side-menu--active @endif">
                        <div class="side-menu__icon"><i class="fas fa-file-chart-line"></i></div>
                        <div class="side-menu__title">
                            REPORTES
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>

                    <ul class="@if (in_array(Route::currentRouteName(), ['RH.reportes.horarioprofesor'])) side-menu__sub-open @else side-menu__sub @endif">
                        <li class="zoomin_smooth_sm">
                            <a id="subMenu-proc-reins" href="{{ route('RH.reportes.horarioprofesor') }}"
                                class="side-menu cursor-pointer @if (in_array(Route::currentRouteName(), ['RH.reportes.horarioprofesor'])) sub-menu-active @endif">
                                <div class="side-menu__icon"> <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="side-menu__title">
                                    HORARIO PROFESORES
                                </div>
                            </a>
                        </li>
                    </ul>

                </li>


            </ul>
        </nav>--}}
        <!-- END: Side Menu -->

{{--}}
        <div class="top-bar-boxed flex items-center">
            <!-- BEGIN: Logo -->
            <a href="{{ route('asp.sesionAsp') }}" class="-intro-x md:flex" style="margin-top: -20px">
                <img alt="LogoUPV" class="w-6" style="width: 9rem" src="{{ asset('logos/logoUPVblanco.png') }}">
            </a>

        </div>
{{--}}


        <!-- BEGIN: Top Menu -->
        <nav class="top-nav mt-2">
            <ul>
                <li class="zoomin_smooth_sm">
                    <a href="{{ route('RH.dashboard') }}" class="top-menu @if (Route::currentRouteName() == 'RH.dashboard') top-menu--active @endif">
                        <div class="top-menu__icon"><i class="fas fa-home"></i></div>
                        <div class="top-menu__title">DASHBOARD</div>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" class="top-menu  @if(Route::currentRouteName() == 'RH.empleados.showEmpleados' || Route::currentRouteName() == 'RH.empleados.showFormAddEmpleado') top-menu--active @endif">
                        <div class="top-menu__icon"><i class="far fa-briefcase"></i></div>
                        <div class="top-menu__title"> EMPLEADOS
                            <i data-lucide="chevron-down" class="top-menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="" style="z-index: 99999;">
                        <li class="zoomin_smooth_sm">
                            <a href="{{ route('RH.empleados.showEmpleados') }}" class="top-menu">
                                <div class="top-menu__icon"> <i class="fas fa-users"></i> </div>
                                <div class="top-menu__title"> PERSONAL </div>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>



        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
                    <h2 class="text-s fw-700 text-primary font-medium mr-5 ml-2" style="text-transform: uppercase;">
                        RECURSOS HUMANOS - {{ session('user') }}
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
                                <a href="" class="dropdown-item hover:bg-white/5">
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


    <div class="preloaderRH" style="flex-direction: column; background-color: var(--RH_main_color) !important;">
        <div class="overlay">
            <div class="wrap">
                <div class="center">
                    <div class="document-loader">
                        <span class="heading short"></span>
                        <span class="line short"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line short"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line short"></span>
                        <span class="heading"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line short"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line short"></span>
                    </div>
                    <p>Cargando...</p>
                </div>
            </div>
        </div>
    </div>


    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('js/ourModal.js') }}"></script>
    <!-- RE Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.js"></script>
    <script src="{{ asset('css/select2/js/select2.full.min.js') }}"></script>

    <!-- CDNJS DE TIPPY Y POPPER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/esm/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy-bundle.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="{{ asset('js/customSelect2Original.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://apexcharts.com/samples/vanilla-js/column/data.js"></script>

    @yield('aditional_js')


    <script>

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


        var pestañaOut = true;
        var ratonParado = false;
        var milisegundosLimiteCierreSesion = 200;
        var milisegundosLimiteCierreSesionFueraVentana = 180000;
        let mensajeShow = 0


        window.addEventListener("blur", () => {
            console.log("Dejo La Pestaña")
            pestañaOut = setTimeout(function() {
                console.log("mostrando mensaje de cierre de sesion")
                mensaje(mensajeShow)
            }, milisegundosLimiteCierreSesionFueraVentana)
        });

        // Cuando el enfoque del usuario vuelve a tu pestaña (sitio web) nuevamente
        window.addEventListener("focus", () => {
            console.log("Volvio a La Pestaña")
            clearTimeout(pestañaOut)
        });


        function mensaje(mensajeShow) {
            if (mensajeShow == 0) {
                mensajeShow = 1
                $.confirm({
                    title: 'ALERTA!',
                    content: 'LA SESIÓN ESTA POR EXPIRAR.',
                    autoClose: 'logoutUser|60000',
                    buttons: {
                        logoutUser: {
                            text: 'CERRAR SESIÓN',
                            action: function() {
                                $.alert('LA SESIÓN HA EXPIRADO');
                                window.location.href = "{{ route('logout') }}";
                            }
                        },
                        PERMANECER: function() {
                            mensajeShow = 0
                            $.alert('SIGUE TRABAJANDO 🥰💖');
                        }
                    }
                });
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

            tippy('#menu-gral-Tutorados', {
                content: 'TUTORADOS.',
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
    </script>




    <!--<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>-->
    <!-- END: JS Assets-->
</body>

</html>
