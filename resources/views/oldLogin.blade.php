<!DOCTYPE html>
<html lang="es" class="light">
<!-- BEGIN: Head -->

<head>
    <meta property="og:image" content="{{ asset('logos/aspirantes/backgroundLogin.jpg') }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIISU - LOGIN</title>
    @laravelPWA
    <link href="{{ asset('favicons/favicon.ico') }}" rel="icon" type="image/ico">
    <!-- BEGIN: CSS Assets-->
    @yield('aditional_css')
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <link href="{{ asset('css/snow.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/adicionales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ourModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tippy6.3.7/tippy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/spinner-loading.css') }}">

    <noscript>
        <META HTTP-EQUIV="Refresh" CONTENT="0;URL={{ route('noJavascript') }}">
    </noscript>

    <style>

    </style>

    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->


<body style="margin: 0; padding: 0;">

    <div class="login_pc_bg"
        style="background-color: rgb(255, 255, 255) !important; width: 100%; height: 100vh; background-position:center;
        display: flex; justify-content: center; align-items: center; background-repeat:no-repeat; -webkit-background-size:cover;
        -moz-background-size:cover; -o-background-size:cover; background-size: cover; background-image: url('{{ asset('logos/upv2BG.png') }}');">

        <div class="p-2 login_pc_container"
            style="display: flex; justify-content: center; align-items: center; flex-direction: column; gap: 3%; width: 35%; position: absolute; left: 0; bottom: 0; top: 0; z-index: 100;">

            <!-- div que contiene el login-->
            <div class="p-3 login_div">
                <div class="p-1"
                    style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <div class="p-1 mb-2">
                        <img style="" class="cursor-pointer logoMusic2"
                            src="{{ asset('logos/UPV-BIS-OFICIAL.png') }}" alt="LOGO UPV BIS">
                    </div>
                </div>
                <form class="p-1" id="form_login" method="POST" action="{{ route('login') }}">
                    @csrf
                    @method('post')
                    <div class="p-3">
                        <div class="p-1">
                            <label class="lblInputUser text-primary " style="font-weight: 600; font-size: 23px;" for="userInput">{{$arrayPalabras['input_login_user_text']}}:</label>
                            <input type="text" name="username" id="userInput" pattern="^(?:(?!DROP|drop|DELETE|delete|UPDATE|update|INSERT|insert).)*$"
                                class="form-control zoomin_smooth_sm username" placeholder="{{$arrayPalabras['input_login_user_PlaceHolder_text']}}" autofocus required>
                         </div>
                        <div class="p-1 mt-3">
                            <label class=" text-primary " style="font-weight: 600; font-size: 23px;"
                                for="">{{$arrayPalabras['input_login_password_text']}}:</label>
                            <input type="password" id="passwordaPc" required name="password"
                                class="form-control zoomin_smooth_sm"
                                pattern="^(?:(?!DROP|drop|DELETE|delete|UPDATE|update|INSERT|insert).)*$"
                                placeholder="{{$arrayPalabras['input_login_password_PlaceHolder_text']}}" autofocus>
                        </div>
                    </div>
                    <div class="p-1" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                        <button type="submit" class="bg-menu-light btn btn_animNone btn-primary py-3 px-4 w-full xl:w-100 xl:mr-3 align-top zoomin_smooth_sm">INICIAR SESIÓN</button>
                        <a class="cursor-pointer link-item mt-2" style="font-size: 13px !important;"
                            onclick="showMSG()">{{$arrayPalabras['login_href_help_for_account_access']}}</a>
                    </div>
                </form>
            </div>
            <!-- div que contiene el login-->

            <div class="text_div w-100" style="font-style:italic;">
                <span class="text-white mt-2 w-100 text_div_txt" style="font-style:italic; text-align: center; vertical-align: middle;"> Construyendo <label style="color:#00ee8b;">Con</label><label style="color:#ee8f00;">ciencia</label></span>
            </div>


        </div>


    </div>



    <div class="login_mobile_bg" style="background-image: url('{{ asset('logos/backgroundMantenimiento.jpg') }}');">
        <div class="p-2 login_pc_container"
            style="display: flex; justify-content: center; align-items: center; flex-direction: column; gap: 3%;">

            <!-- div que contiene el login-->
            <div class="p-3 login_div" style="z-index: 9; position: fixed;  background-color: rgba(255, 255, 255, 0.750) !important;">
                <div class="p-1"
                    style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <div class="p-1 mb-2">
                        <img style="" class="cursor-pointer logoMusic2"
                            src="{{ asset('logos/UPV-BIS-OFICIAL.png') }}" alt="LOGO UPV BIS">
                    </div>
                </div>
                <form  class="p-1 " id="form_login_mobile" method="POST" action="{{ route('login') }}">
                    @csrf
                    @method('post')
                    <div class="p-3">
                        <div class="p-1">
                            <label class=" text-primary " style="font-weight: 600; font-size: 23px;"
                                for="">{{$arrayPalabras['input_login_user_text']}}:</label>
                            <input type="text" name="username" id="userInputMobile"
                                class="form-control zoomin_smooth_sm username"
                                pattern="^(?:(?!DROP|drop|DELETE|delete|UPDATE|update|INSERT|insert).)*$"
                                placeholder="{{$arrayPalabras['input_login_user_PlaceHolder_text']}}" autofocus>
                        </div>
                        <div class="p-1 mt-3">
                            <label class=" text-primary " style="font-weight: 600; font-size: 23px;"
                                for="">{{$arrayPalabras['input_login_password_text']}}:</label>
                            <input id="passwordMobile" type="password" name="password"
                                class="form-control zoomin_smooth_sm"
                                pattern="^(?:(?!DROP|drop|DELETE|delete|UPDATE|update|INSERT|insert).)*$"
                                placeholder="{{$arrayPalabras['input_login_password_PlaceHolder_text']}}" autofocus>
                        </div>
                    </div>
                    <div class="p-1"
                        style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                        <button type="submit" class="bg-menu-light btn btn_animNone btn-primary py-3 px-4 w-full xl:w-100 xl:mr-3 align-top zoomin_smooth_sm">INICIAR SESIÓN</button>
                        <a class="cursor-pointer link-item mt-2" style="font-size: 13px !important;"
                            onclick="showMSG()">{{$arrayPalabras['login_href_help_for_account_access']}}</a>
                    </div>
                </form>
            </div>
            <!-- div que contiene el login-->

            <div class="text_div">
                <span class="text-white mt-2 text_div_txt"
                    style="font-style:italic; text-align: center; vertical-align: middle;">
                    <label style="color:rgb(100, 13, 100);">Construyendo</label>
                    <label style="color:rgb(0, 238, 139);">Con</label><label
                        style="color:rgb(238, 143, 0);">ciencia</label><label
                        style="color:rgb(100, 13, 100);"></label></span>
            </div>

        </div>


        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">


    </div>


    <canvas class="w-100" id='snow'></canvas>


    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('js/ourModal.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.js"></script>

    <!-- CDNJS DE TIPPY Y POPPER -->
    <script src="{{ asset('js/popper2.10.1/popper.min.js') }}"></script>
    <script src="{{ asset('js/tippy6.3.7/tippy-bundle.umd.min.js') }}"></script>

    @if (session('LoginCheck') == 'error')
        <script>
            Swal.fire({
                icon: 'error',
                html: 'DATOS INCORRECTOS.',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
                allowEscapeKey: false,
                allowOutsideClick: false,
            })
        </script>
    @endif

    @if (session('strikes') == 3)
    <script>
            Swal.fire({
                icon: 'error',
                html: 'ESTIMADO USUARIO, SU ACCESO AL SISTEMA HA SIDO BLOQUEADO DEBIDO A MÚLTIPLES INTENTOS DE ACCEDER A CONTENIDO SENSIBLE. FAVOR DE COMUNICARSE AL CORREO servicios.informaticos@upv.edu.mx PARA DAR SEGUIMIENTO A SU SITUACIÓN.',
                showConfirmButton: true,
                confirmButtonColor: '#640d64',
                allowEscapeKey: false,
                allowOutsideClick: false,
                width:"900px",
            })
        </script>
    @endif
    <script>

    </script>

    <?php if(date('m') == 12){ ?>
    <script>
        let flag = 0
        $('.logoMusic1').attr('onclick', 'playMusic()')
        $('.logoMusic2').attr('onclick', 'playMusic()')

        function playMusic() {
            if (flag == 0) {
                var sound = new Howl({
                    src: ['{{ asset('songs/christmas.mp3') }}'],
                    loop: true,
                    volume: 0.5,
                })
                console.log("reproduciendo musica")
                sound.play()
            }
            flag = 1

        }
        tippy('.logoMusic1', {
            content: 'HAZ CLICK EN MI, FELIZ NAVIDAD!.',
        });
        tippy('.logoMusic2', {
            content: 'HAZ CLICK EN MI, FELIZ NAVIDAD!.',
        });
    </script>
    <!-- ANIMACION DE NIEVE PARA NAVIDAD -->
    <script>
        var canvas = document.getElementById('snow');
        var ctx = canvas.getContext('2d');

        var w = canvas.width = window.innerWidth;
        var h = canvas.height = document.documentElement.clientHeight

        var num = 30;
        var tamaño = 40;
        var elementos = [];

        inicio();
        nevada();

        window.addEventListener("resize", function() {
            w = canvas.width = window.innerWidth;
            h = canvas.height = document.documentElement.clientHeight
        });

        function inicio() {
            for (var i = 0; i < num; i++) {
                elementos[i] = {
                    x: Math.ceil(Math.random() * w),
                    y: Math.ceil(Math.random() * h),
                    toX: Math.random() * 10 - 5,
                    toY: Math.random() * 5 + 1,
                    tamaño: Math.random() * tamaño
                }
            }
        }

        function nevada() {
            ctx.clearRect(0, 0, w, h);
            for (var i = 0; i < num; i++) {
                var e = elementos[i];
                ctx.beginPath();
                cristal(e.x, e.y, e.tamaño);
                ctx.fill();
                ctx.stroke();
                e.x = e.x + e.toX;
                e.y = e.y + e.toY;
                if (e.x > w) {
                    e.x = 0;
                }
                if (e.x < 0) {
                    e.x = w;
                }
                if (e.y > h) {
                    e.y = 0;
                }
            }
            timer = setTimeout(nevada, 16);
        }

        function cristal(cx, cy, long) {
            ctx.fillStyle = "white";
            ctx.lineWidth = long / 20;
            ctx.arc(cx, cy, long / 15, 0, 2 * Math.PI);
            for (i = 0; i < 6; i++) {
                ctx.strokeStyle = "white";
                ctx.moveTo(cx, cy);
                ctx.lineTo(cx + long / 2 * Math.sin(i * 60 / 180 * Math.PI),
                    cy + long / 2 * Math.cos(i * 60 / 180 * Math.PI));
            }
        }
    </script>
    <!-- ANIMACION DE NIEVE PARA NAVIDAD -->
    <?php } ?>

    <!-- ANIMACION ANIVERSARIO DE LA UNIVERSIDAD -->
    <?php if((date('m') == 11 && date('d') == 23) || (date('m') == 8 && date('d') == 27)){ ?>
    <script src="{{ asset('js/confetti.js') }}"></script>
    <script>
        maxParticleCount = 10;
        startConfetti()
    </script>
    <?php } ?>
    <!-- ANIMACION ANIVERSARIO DE LA UNIVERSIDAD -->
</body>

</html>
