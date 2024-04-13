<!DOCTYPE html>
<html lang="es" class="@if(session('dark_mode') == 'off') light @elseif (session('dark_mode') == 'on') dark @endif">
<!-- BEGIN: Head -->

<head>
    <meta name="theme-color" content="#0077b5">
    <meta charset="utf-8">
    <link href="{{ asset('favicons/favicon.ico') }}" rel="icon" type="image/ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIISU - DASHBOARD</title>

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('css/ourModal.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loaderEscolares.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adicionales.css') }}">
    <link rel="stylesheet" href="{{ asset('FontAwesome/css/all.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal-default-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.css" />

    <link rel="stylesheet" href="{{asset('css/select2/css/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @yield('aditional_css')

    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->


<?php
 $enlace = Request::url();
 $enlace_dividido=explode('/',$enlace);
 $esDashboard=0;
 $esSeguridad=0;
 foreach ($enlace_dividido as $key) {
     if($key=="Dashboard"){
         $esDashboard=1;
     }elseif($key=="Seguridad"){
         $esSeguridad=1;
     }
 }
?>

<body class="py-5" style="opacity: 1;">


    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a id="siisu" href="{{ route('dashboard') }}" class="intro-x flex items-center pl-5 pt-4">
                <img alt="UPV BIS" class="w-8 logoUPV" style='width: 11rem' src="{{ asset('logos/logoUPVblanco.png') }}">
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a id="menu-gral-dash" href="{{ route('dashboard') }}" class="side-menu @if ($esDashboard == 1) side-menu--active @endif">
                        <div class="side-menu__icon"><i class="fas fa-home"></i></div>
                        <div class="side-menu__title">
                            DASHBOARD
                        </div>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">

                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
                    <h2 class="text-s fw-700 text-primary font-medium mr-5 ml-2">
                        SERVICIOS ESCOLARES - {{ session('UsuarioPerfil') }}
                    </h2>
                  {{--  <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">SIISU</a></li>
                        <li class="breadcrumb-item" >SERV. ESCOLARES</li>
                        @yield('location')
                    </ol>--}}
                </nav>
                <!-- END: Breadcrumb -->



                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-10 zoomin_smooth" style="float: right !important;">
                    <div class="bg-menu-light text-white dropdown-toggle w-8 h-8 rounded-full
                    overflow-hidden shadow-lg image-fit"
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
                           {{-- <li>
                                <a href="{{ route('Perfil.indexPerfil') }}" class="dropdown-item hover:bg-white/5">
                                    <i data-lucide="user" class="w-4 h-4 mr-2"></i> PERFIL </a>
                            </li>--}}

                            <li>
                                <a href=""
                                    class="dropdown-item hover:bg-white/5">
                                    <i data-lucide="user" class="w-4 h-4 mr-2"></i> PERFIL </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5 zoomin_smooth"> <i
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



    <section class="loader">
            <div class="folder-loader">
                <div class="folder">
                    <div class="folder__back"></div>
                    <div class="folder__paper folder__paper--1"></div>
                    <div class="folder__paper folder__paper--2"></div>
                    <div class="folder__paper folder__paper--3"></div>
                    <div class="folder__front"></div>
                </div>
            </div>
    </section>


    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('js/anime-3.2.1/lib/anime.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('js/loaderEscolares.js') }}"></script>
    <script src="{{ asset('js/inputSearch.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('js/ourModal.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://apexcharts.com/samples/vanilla-js/column/data.js"></script>

    <!-- RE Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.js"></script>
    <script src="{{asset('css/select2/js/select2.full.min.js')}}"></script>

    <!-- CDNJS DE TIPPY Y POPPER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/esm/popper.min.js" integrity="sha512-aSCUnIf5arudGto225/QqbEgN6cN22eXky/XUnXgkxsuLfdxzr/zirkr25psrCK24Q8UItMSwAhxTQpTHO24hQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy-bundle.umd.min.js"></script>

    <!--LINK QUE MANDA A TRAER LAS DEPENCIAS DE SWEET ALERT QUE SE UTILIZAN PARA TODOS LOS ALERT BOX-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/customSelect2.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <script>
        function showLoader(){
            $('.loader').css('display', 'flex')
        }
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

            $(document).ready(function() {
                setTimeout(() => {
                    $('.loader').css('display', 'none')
                }, 700)
            })
        /*------------------------------------------------------------------------------*/

        if ($(window).width() < 1370){
            var urlImg = '{{asset('logos/NewlogoUPVblanco.png')}}'
            $('.side-nav').addClass('side-nav--simple')
            $('.sissu-title').css('display','none')
            $('.side-menu__icon').css('font-size','24px')
            $('.dr-mode-content').css('display','none')
            $('.logoUPV').removeAttr('src')
            $('.logoUPV').attr('src',urlImg)
            $('.logoUPV').css('width','170px')
            $('.logoUPV').css('height','40px')


        }else if($(window).width()> 1370){
            var imgLogo = '{{asset('logos/logoUPVblanco.png')}}'
            $('.side-nav').removeClass('side-nav--simple')
            $('.sissu-title').css('display','block')
            $('.dr-mode-content').css('display','flex')

            $('.logoUPV').attr('src',imgLogo)
            $('.logoUPV').css('width','170px')
            $('.logoUPV').css('height', '68px')
            $('.side-nav').removeClass('side-nav--simple')
        }
        if ($(window).width() < 900) {
            $('.titulo_Modulo').removeClass('text-xl')
            $('.titulo_Modulo').addClass('text-m')

            $('.header_info').addClass('flex-div-row')
            $('.form-group').addClass('mb-3')
            $('.cont_referencias').addClass('mb-2')


            $('.btn_editRef').removeClass('w-15')
            $('.btn_editRef').addClass('w-90')


        } else if ($(window).width() > 900) {
            $('.titulo_Modulo').removeClass('text-m')
            $('.titulo_Modulo').addClass('text-xl')

            $('.header_info_mat').addClass('flex-div-row')

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

                $('.logoUPV').attr('src','{{asset('logos/logoUPVblanco.png')}}')
                $('.logoUPV').css('width','170px')
                $('.logoUPV').css('height', '68px')
                $('.side-nav').removeClass('side-nav--simple')

            } else if (ancho < 1370) {
                $('.cont_datos').css('flex-direction', 'column')

                $('.datos_perfil').removeClass('col-lg-8')
                $('.datos_perfil').addClass('w-100')

                $('.foto_perfil').removeClass('col-lg-4')
                $('.foto_perfil').addClass('w-100')

                $('.side-nav').addClass('side-nav--simple')

                $('.logoUPV').attr('src','{{asset('logos/NewlogoUPVblanco.png')}}')
                $('.logoUPV').css('width','170px')
                $('.logoUPV').css('height','40px')
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

            if(ancho < 800){
                $('.ruta-mobile').css('display', 'flex')
                $('.ruta-pc').css('display', 'none')
            }else if(ancho > 800){
                $('.ruta-mobile').css('display', 'none')
                $('.ruta-pc').css('display', 'flex')
            }
        })
    </script>

    @yield('aditional_js')


    {{--@if ($esReinscripciones == 0 && $esAsignarMat == 0 && $esExpedienteAlumno == 0)
    @elseif ($esReinscripciones == 1 || $esAsignarMat == 1)
        <script>
            $('.logoUPV').removeAttr('src')
            $('.logoUPV').attr('src','{{asset('logos/NewlogoUPVblanco.png')}}')
            $('.logoUPV').css('width','170px')
            $('.logoUPV').css('height','40px')
        </script>

    @endif--}}

    <!--FUNCION PARA HABILITAR Y DESHABILITAR EL MODO OSCURO-->
    <script>

        $('#check-darkMode').on('change', function() {
            let _token = $('#token').val();
            if($('#check-darkMode').is(':checked')){
                $.ajax({
                        type: "PUT",
                        url: "{{ route('darkmode') }}",
                        data: {
                            _token: _token,
                            modo:'on'
                        },
                        success: function(response) {
                            console.log(response)
                            Swal.fire({
                                icon: 'success',
                                confirmButtonColor: '#640d64',
                                html: 'MODO OSCURO ACTIVADO',
                                showConfirmButton: true,
                                timer: 3000
                            })
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                confirmButtonColor: '#640d64',
                                html: 'ERROR AL ACTIVAR EL MODO OSCURO',
                                showConfirmButton: true,
                                timer: 3000
                            })
                        },
                    });

                if($('html').hasClass('light')){
                    $('html').removeClass('light')
                    $('html').addClass('dark')
                }else{
                    $('html').addClass('dark')
                }
            }else{
                $.ajax({
                        type: "PUT",
                        url: "{{ route('darkmode') }}",
                        data: {
                            _token: _token,
                            modo:'off'
                        },
                        success: function(response) {
                            console.log(response)
                            Swal.fire({
                                icon: 'success',
                                confirmButtonColor: '#640d64',
                                html: 'MODO OSCURO DESACTIVADO',
                                showConfirmButton: true,
                                timer: 3000
                            })
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                confirmButtonColor: '#640d64',
                                html: 'ERROR AL DESACTIVAR EL MODO OSCURO',
                                showConfirmButton: true,
                                timer: 3000
                            })
                        },
                    });
                $('html').removeClass('dark')
                $('html').addClass('light')
            }
        });
    </script>

</body>

</html>
