@extends('Administrador.layout.main')

@section('aditional_css')
@endsection

@section('content')
<div class="grid grid-cols-6 gap-3">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">

            <!-- BEGIN: General Report -->
            <div class="col-span-12">
                <div class="intro-y flex items-center h-10">
                    <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> RECARGAR DATOS </a>
                </div>
                <br>
                <h2 class="text-lg font-medium truncate mr-5 ml-2">
                    <b>MÓDULOS</b>
                </h2>
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <a href="" class="col-span-12 sm:col-span-2 xl:col-span-4 intro-y">
                        <div class="report-box zoom-in-cards">
                            <div class="box p-5">
                                <div class="flex">
                                </div>
                                <div class="text-l font-medium leading-8" style="display:flex; justify-content:space-between; align-items:center;">
                                    <label class="cursor-pointer text-green-upv">PERFILES</label>
                                    <i class="cursor-pointer fa fa-list-alt text-5xl text-green-upv"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- END: General Report -->
        </div>
    </div>
</div>

@endsection



@section('aditional_js')

<script>
    $( document ).ready(function() {
        $('.loader').css('display','none')
    });
</script>

@endsection
