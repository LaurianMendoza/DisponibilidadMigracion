@extends('Docentes.layouts.main')

@section('aditional_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection

@section('location')
    <li class="breadcrumb-item"><b>PERFIL DOCENTE</b></li>
@endsection


@section('content')
<title>SIISU - PERFIL</title>

    <div style="display: flex; justify-content: space-between; width: 100%; align-items: center; margin-top: 3%; flex-wrap: wrap;">

        <span class="text-xl text-primary titulo_Modulo" style="font-weight: 700; margin-left: 1%; line-height: 25pt">
            PERFIL DOCENTE
        </span>

        <div style="float: left;">

            <a onclick="location.reload()" class="ml-auto flex items-center text-primary zoomin_smooth_sm cursor-pointer">
                <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i>
                RECARGAR DATOS
            </a>
        </div>
    </div>



@error('PassNuevo')
<?php
$passcheck = 1;

?>
@enderror


@if (session('passNoCoincide'))
<?php
$passcheck = 1;

?>
@endif

@if (session('passNoIgualAnterior'))
<?php
$passcheck = 1;

?>
@endif


    <div class="cont_datos" style="display: flex; margin-top: 3%; overflow-x: auto;">



        <div class="col-lg-4 order-lg-1 foto_perfil">
            <div class="card shadow mb-4" style="padding: 3%;">
                <div class="card-profile-image mb-2" style="display: flex; align-items: center; justify-content: center;">

                    {{-- Si la foto existe la manda a llamar --}}
                    {{-- @if (session('foto') != '0') --}}
                    @if(isset($foto))
                    <figure data-open="viewPictureProfile" class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in cursor-pointer"
                        style="font-size: 60px; height: 180px; width: 180px; display: flex; align-items: center; justify-content: center; color:white;">

                            <img alt="FOTO ALUMNO" class="rounded-full" src="{{ asset('storage/'.session('foto')) }}">

                    </figure>

                    {{-- Si la foto no existe muestra la inicial del nombre del alumno --}}
                    @else

                    <figure data-open="viewPictureProfile" class="rounded-circle avatar avatar font-weight-bold zoomin_smooth  cursor-pointer"
                        style="font-size: 60px; height: 180px; width: 180px; display: flex; align-items: center; justify-content: center; color:white;">
                        {{ session('Nombre')[0] }}
                    </figure>
                    @endif
                </div>

                <div class="card-body">
                    <div style="display: flex;">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold" style="font-size: 12pt; margin-top: 7px;"><b>{{ session('Nombre') }} {{ session('Apellidos') }}</b>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pl-lg-4 mt-2" style=" margin-top: 6%;">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary ml-4 btn_animNone zoomin_smooth" data-open="CambiarPassword">CAMBIAR CONTRASEÑA</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-lg-8 order-lg-2 datos_perfil">
            <div class="card shadow mb-4" style="padding: 3%;">

                <div class="card-body">

                    <div class="w-100" style="display: flex; justify-content: center;, align-items: clear;">
                        <button class="btn pestaña w-90 btn_animNone zoomin_smooth_smX" id="btnInfoCuenta">INFORMACIÓN DE LA CUENTA</button>
                    </div>
                    <br>


                    {{-- CONTENEDOR DE DATOS DE LA CUENTA --}}
                    <div class="w-100 mb-5 cont_datosCuenta">
                            <form class="form_add_carrera" action="{{route('Docente.ActualizarPersonales')}}" id="form_edit_informacion" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')


                            <div class="flex-div-row" style="flex-wrap: wrap;">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name"><b>NOMBRE</b> </label>
                                        <input disabled type="text" id="nombre" class="form-control" name="nombre"
                                            placeholder="Nombre" value="{{ session('Nombre') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name"><b>APELLIDOS</b></label>
                                        <input disabled type="text" id="last_name" class="form-control" name="last_name"
                                            placeholder="Apellidos" value="{{ session('Apellidos') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="flex-div-row mt-2" style="flex-wrap: wrap;">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name"><b>CORREO ELECTRÓNICO PERSONAL</b>
                                        </label>
                                        <input disabled type="email" id="correoPersonal" class="form-control"
                                            name="correoPersonal" placeholder="CORREO ELECTRÓNICO PERSONAL"
                                            value="{{$datosPersona[0]->email}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name"><b>TELÉFONO CELULAR</b>
                                        </label>
                                        <input disabled type="tel" id="telPersonal" class="form-control"
                                            name="telPersonal" placeholder="TELÉFONO CELULAR" value="{{$datosPersona[0]->tel_cel}}">
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="pl-lg-4 mt-2" style=" margin-top: 2%;">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="button" onclick="editInfoCuenta()" id="btn_editInfo"
                                            class="btn btn-success btn_edit btn_animNone zoomin_smooth">EDITAR INFORMACIÓN</button>
                                        <button type="submit"
                                            id="btn_saveInfo" class="btn btn-primary btn_update hidden btn_animNone zoomin_smooth">GUARDAR
                                            CAMBIOS</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>





    <!-- MODAL CAMBIAR CONTRASEÑA -->
    <div class="ourModal @if($passcheck == 1) is-visible @endif"  id="CambiarPassword" data-animation="slideInOutLeft" >
        <div class="ourModal-dialog">
            <header class="ourModal-header">
                <h3 class="modal-title" id="exampleModalLabel"><b>CAMBIAR CONTRASEÑA</b></h3>
                <button onclick="limpiarModal('addPlanContent')" type="button" class="btn btn-danger close-ourModal btn_anim"
                    aria-label="close ourModal" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </header>
            <section class="ourModal-content addPlanContent">
                <form class="form_add_carrera" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <input type="hidden" id="idPersona" name="idPersona" value="{{ session('idPersona') }}">

                    <span class="invalid-feedback" role="alert">
                        <strong style="color: #dc3d3d; font-size: 11pt">Nota: Recuerda que al cambiar tu contraseña se actualizará de igual manera en tu cuenta de correo ({{session('user')}}@upv.edu.mx).</strong>
                    </span>

                    <div class="form-group" style="margin-top: 13px">
                        <label class="form-control-label" for="PassActual"><b>CONTRASEÑA ACTUAL <strong style="color: red">*</strong></b> </label>
                        <input required type="password" id="PassActual" class="form-control"
                            name="PassActual" placeholder="CONTRASEÑA ACTUAL">

                            @if (session('passNoCoincide'))
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red">Tu contraseña actual no coincide con la que ingresaste</strong>
                                </span>
                            @endif

                            @error('PassActual')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group flex-div-row" style="margin-top: 13px; flex-wrap: wrap;">
                        <div class="form-group w-100">
                            <label class="form-control-label" for="PassNuevo"><b>NUEVA CONTRASEÑA <strong style="color: red">*</strong></b> </label>
                            <input required type="password" id="PassNuevo" class="form-control w-100"
                                name="PassNuevo" placeholder="NUEVA CONTRASEÑA">

                                @error('PassNuevo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                @enderror

                            @if (session('passNoIgualAnterior'))
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red">LA NUEVA CONTRASEÑA NO PUEDE SER IGUAL A LA ANTERIOR</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group w-100 mt-4">
                            <label class="form-control-label" for="PassNuevo_confirmation"><b>CONFIRMAR CONTRASEÑA <strong style="color: red">*</strong></b> </label>
                            <input required type="password" id="PassNuevo_confirmation" class="form-control w-100"
                                name="PassNuevo_confirmation" placeholder="CONFIRMAR CONTRASEÑA">
                        </div>
                    </div>

                    <span class="invalid-feedback" role="alert">
                        <strong style="color: #727272; font-size: 11pt">Por seguridad la contraseña debe contener al menos 8 caracteres, estar compuesta por letras mayúsculas, letras minúsculas, números y símbolos.</strong>
                    </span>

                    <div class="row mt-4 px-4 float-right mb-3">
                        <button type="submit" class="btn btn-primary ml-4 btn_animNone zoomin_smooth">CONFIRMAR</button>
                    </div>

                </form>
            </section>
            <footer>
            </footer>
        </div>
    </div>



    <!-- MODAL ver foto de perfil -->
    <div class="ourModal" id="viewPictureProfile" data-animation="slideInOutLeft" >
        <div class="ourModal-dialog" style="width: 600px !important;">
            <header class="ourModal-header">
                <h3 class="modal-title" id="exampleModalLabel"><b>FOTO DE PERFIL</b></h3>
                <button onclick="limpiarModal('addPlanContent')" type="button" class="btn btn-danger close-ourModal btn_anim mx-3"
                    aria-label="close ourModal" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </header>
            <section class="ourModal-content addPlanContent">
                <div class="w-100" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">

                   {{-- @if (session('foto') != '0') --}}
                    @if(isset($foto))
                        <div class="w-100" style="color: white;display: flex; justify-content: center; align-items: center;">
                            <img alt="FOTO DOCENTE" width="230" height="360" class="" src="{{ asset('storage/'.session('foto')) }}">
                        </div>
                        <?php $cadena = session('user')." - ".session('Nombre')."".session('Apellidos')?>
                        <div class="mt-2">{!! DNS2D::getBarcodeHTML($cadena, 'QRCODE', 4, 4) !!}</div>

                    @else
                        <div class="w-100 bg-menu-light" style="color: white; font-size: 130px; height: 300px; display: flex; justify-content: center; align-items: center;">
                            {{ session('Nombre')[0] }}
                        </div>
                        <?php $cadena = session('user')." - ".session('Nombre')."".session('Apellidos')?>
                        <div class="mt-2">{!! DNS2D::getBarcodeHTML($cadena, 'QRCODE', 4, 4) !!}</div>
                    @endif
                </div>
            </section>
            <footer>
            </footer>
        </div>
    </div>


@section('aditional_js')

<script>
    $(document).ready(function() {
            $('.preloaderDocente').css('display', 'none')
    });
</script>

    <script>


        function mostrarDatosCuenta() {
            $('.cont_datosCuenta').css('display', 'block')
            $('.cont_datosReferencia').css('display', 'none')

            $('#btnInfoCuenta').addClass('pestaña')
            $('#btnInfoCuenta').removeClass('pestaña-out')

            $('#btnReferencias').removeClass('pestaña')
            $('#btnReferencias').addClass('pestaña-out')
        }



        function editInfoCuenta() {
            $('#correoPersonal').removeAttr('disabled')
            $('#telPersonal').removeAttr('disabled')
            $('#correoPersonal').css('box-shadow', '10px 5px 5px rgb(214, 214, 214)')
            $('#telPersonal').css('box-shadow', '10px 5px 5px rgb(214, 214, 214)')

            $('#btn_editInfo').addClass('hidden')
            $('#btn_editInfo').removeClass('show')

            $('#btn_saveInfo').removeClass('hidden')
            $('#btn_saveInfo').addClass('show')
        }


    </script>


<script>
    $('#form_edit_informacion').submit(function(e){
        e.preventDefault();
        Swal.fire({
        html: 'SU INFORMACIÓN DE LA CUENTA SE ACTUALIZARÁ ¿DESEA CONTINUAR?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#640d64',
        cancelButtonColor: '#d33',
        cancelButtonText:'NO',
        confirmButtonText: 'SI'
      }).then((result) => {
        if (result.value) {
          this.submit();
        }
      })
  });
</script>



    <!--LINK QUE MANDA A TRAER LAS DEPENCIAS DE SWEET ALERT QUE SE UTILIZAN PARA TODOS LOS ALERT BOX-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    @if (session('PassActualizado') == 'ok')
    <script>
        Swal.fire({
            icon: 'success',
            html: 'CONTRASEÑA ACTUALIZADA CON ÉXITO',
            showConfirmButton: true,
            confirmButtonColor: '#640d64',
            allowEscapeKey: false,
            allowOutsideClick: false,
        })
    </script>
@endif

@if (session('InfoActualizada') == 'ok')
    <script>
        Swal.fire({
            icon: 'success',
            html: 'TU INFORMACIÓN HA SIDO ACTUALIZADADA CON ÉXITO',
            showConfirmButton: true,
            confirmButtonColor: '#640d64',
            allowEscapeKey: false,
            allowOutsideClick: false,
        })
    </script>
@endif

@if (session('errorGoogle') == 'ok')
    <script>
        Swal.fire({
            icon: 'error',
            html: 'HA OCURRIDO UN ERROR AL ACTUALIZAR LA CONTRASEÑA <br> PORFAVOR INTENTE MAS TARDE',
            showConfirmButton: true,
            confirmButtonColor: '#640d64',
            allowEscapeKey: false,
            allowOutsideClick: false,
        })
    </script>
@endif

@endsection

@endsection
