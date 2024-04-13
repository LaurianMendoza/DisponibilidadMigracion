@extends('ServiciosEscolares.layouts.main')

@section('aditional_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection

@section('location')
    <li class="breadcrumb-item"><b>PERFIL</b></li>
@endsection


@section('content')

<title>SIISU - PERFIL</title>

    <div style="display: flex; justify-content: space-between; width: 100%; align-items: center; margin-top: 3%;">

        <span class="text-xl text-primary titulo_Modulo" style="font-weight: 700; margin-left: 1%; line-height: 25pt">
            PERFIL
        </span>

        <div style="float: left;">

            <a href="" class="ml-auto flex items-center text-primary zoomin_smooth_sm">
                <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i>
                RECARGAR DATOS
            </a>
        </div>
    </div>









    <div class="cont_datos" style="display: flex; margin-top: 3%; overflow-x: auto;">



        <div class="col-lg-4 order-lg-1 foto_perfil">
            <div class="card shadow mb-4" style="padding: 3%;">
                <div class="card-profile-image mb-2" style="display: flex; align-items: center; justify-content: center;">

                    {{-- Si la foto existe la manda a llamar --}}
                  {{--  @if(session('foto') != '0') --}}
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
                        <button class="btn pestaña w-90 btn_animNone zoomin_smooth_smX" id="btnInfoCuenta">INFORMACIÓN DE LA
                            CUENTA</button>

                    </div>
                    <br>


                    {{-- CONTENEDOR DE DATOS DE LA CUENTA --}}
                    <div class="w-100 mb-5 cont_datosCuenta">
                        <form method="POST" action="" autocomplete="off">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" name="_method" value="PUT">
                            <div class="flex-div-row">
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

                            <div class="flex-div-row mt-2">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name"><b>CORREO ELECTRÓNICO PERSONAL</b>
                                        </label>
                                        <input disabled type="email" id="correoPersonal" class="form-control"
                                            name="correoPersonal" placeholder="Nombre"
                                            value="{{ session('user') }}@upv.edu.mx">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name"><b>TELÉFONO CELULAR</b>
                                        </label>
                                        <input disabled type="tel" id="telPersonal" class="form-control"
                                            name="telPersonal" placeholder="Nombre" value="">
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="pl-lg-4 mt-2" style=" margin-top: 2%;">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="button" onclick="editInfoCuenta()" id="btn_editInfo"
                                            class="btn btn-success btn_edit btn_animNone zoomin_smooth">EDITAR INFORMACIÓN</button>
                                        <button type="button" onclick="guardarCambiosInfo({{ session('idPersona') }})"
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





@section('aditional_js')
    <script>
        $(document).ready(function() {
            $('.loader').css('display', 'none')
            $('#addMateria').css('display', 'flex')
            $('#editMateria').css('display', 'flex')
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#datatable').DataTable({

            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron coincidencias en tu busqueda",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(Se encontraron _MAX_ registros)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
    <!--LINK QUE MANDA A TRAER LAS DEPENCIAS DE SWEET ALERT QUE SE UTILIZAN PARA TODOS LOS ALERT BOX-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if (session('LoginCheck') == 'ok')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1470,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: 'BIENVENIDO {{ session('user') }}',
            })
        </script>
    @endif



    <!-- MODAL CAMBIAR CONTRASEÑA -->
    <div class="ourModal "  id="CambiarPassword" data-animation="slideInOutLeft" >
        <div class="ourModal-dialog">
            <header class="ourModal-header">
                <h3 class="modal-title" id="exampleModalLabel"><b>CAMBIAR CONTRASEÑA</b></h3>
                <button onclick="limpiarModal('addPlanContent')" type="button" class="btn btn-danger close-ourModal btn_anim"
                    aria-label="close ourModal" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </header>
            <section class="ourModal-content addPlanContent">
                <form class="form_add_carrera" action="{{ route('Alumno.ActualizarPassword') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <input type="hidden" id="idPersona" name="idPersona" value="{{ session('idPersona') }}">

                    <span class="invalid-feedback" role="alert">
                        <strong style="color: #dc3d3d; font-size: 11pt">NOTA: AL MOMENTO DE CAMBIAR TU CONTRASEÑA TAMBIÉN SERÁ ACTUALIZADA EN TU CUENTA DE CORREO GMAIL.</strong>
                    </span>


                            <div class="form-group" style="margin-top: 13px">
                                <label class="form-control-label" for="PassActual"><b>CONTRASEÑA ACTUAL</b> </label>
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


                            <div class="form-group" style="margin-top: 13px">
                                <div class="form-group ">
                                    <label class="form-control-label" for="PassNuevo"><b>NUEVA CONTRASEÑA</b> </label>
                                    <input required type="password" id="PassNuevo" class="form-control"
                                        name="PassNuevo" placeholder="NUEVA CONTRASEÑA">

                                        @error('PassNuevo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if (session('passNoIgualAnterior'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red">La nueva contraseña no puede ser igual a la anterior</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 13px">
                                <div class="form-group ">
                                    <label class="form-control-label" for="PassNuevo_confirmation"><b>CONFIRMAR CONTRASEÑA</b> </label>
                                    <input required type="password" id="PassNuevo_confirmation" class="form-control"
                                        name="PassNuevo_confirmation" placeholder="CONFIRMAR CONTRASEÑA">
                                </div>
                            </div>


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

                    @if (session('foto') != '0')
                        <div class="w-100" style="color: white;display: flex; justify-content: center; align-items: center;">
                            <img alt="FOTO ALUMNO" width="360" height="500" class="" src="{{ asset('storage/'.session('foto')) }}">
                        </div>
                        <?php $cadena = session('user')." - ".session('Nombre')."".session('Apellidos')?>
                        <div class="mt-2">{!! DNS2D::getBarcodeHTML($cadena, 'QRCODE', 4, 4) !!}</div>

                    @else
                        <div class="w-100 bg-menu-light" style="color: white; font-size: 130px; height: 500px; display: flex; justify-content: center; align-items: center;">
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

@endsection

@endsection
