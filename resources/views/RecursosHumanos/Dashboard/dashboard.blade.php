@extends('RecursosHumanos.layouts.main')

@section('aditional_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection

@section('content')

<title>SIISU - DASHBOARD</title>

<div class="grid grid-cols-6 gap-3">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">

            <!-- BEGIN: General Report -->
            <div class="col-span-12">
                <div class="intro-y flex items-center h-10">
                    <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> RECARGAR DATOS </a>
                </div>
                <br>
                <span class="text-primary" style="font-size: 30px !important; font-weight: 700; margin-left: 1%;">
                    DASHBOARD
                </span>


                <div class="grid grid-cols-2 gap-6 mt-5" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">

                    {{-- COLUMNA 1 --}}
                    <div style="max-height: 800px; width: 700px; display: flex; justify-content: center; align-items: center; gap: 6%; flex-direction: row; flex-wrap: wrap;">
                        <div class="card p-1 w-100 mt-2" style="display: flex; justify-content: center; align-items: center; height: 300px;">
                            <div class="w-100 p-2" style="display: flex; justify-content: center; align-items: center;">
                                <span class="text-primary" style="font-size: 20px !important; font-weight: 700; margin-left: 1%; height: 100%;">
                                    TOTAL DE EMPLEADOS ACTIVOS
                                </span>
                            </div>
                            <div class="w-100 p-2" style="font-weight: 700; display: flex; justify-content: center; align-items: center; font-size: 160px; height: 100%;">
                                {{count($totalEmpleadosActivos)}}
                            </div>
                        </div>
                    </div>


                    {{-- COLUMNA 2 --}}
                    <div style="max-height: 800px;  width: 700px; display: flex; justify-content: center; align-items: center; flex-direction: row; flex-wrap: wrap;">
                        <div class="card p-1 w-100 mt-2" style="display: flex; justify-content: center; align-items: center; height: 300px;">
                            <div class="w-100 p-3" style="display: flex; justify-content: center; align-items: center;">
                                <span class="text-primary" style="font-size: 20px !important; font-weight: 700; margin-left: 1%; height: 100%;">
                                    TOTAL DE EMPLEADOS ACTIVOS POR GENERO
                                </span>
                            </div>
                            <div class="w-100 p-2" style="font-weight: 500; display: flex; justify-content: center; align-items: center; font-size: 50px; height: 80%;">
                                <div id="graf_Practicas" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="grid grid-cols-2 gap-6 mt-5 p-3" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">

                    {{-- COLUMNA 3 --}}
                    <div style="max-height: 800px; max-width: 100%; width: 700px; display: flex; justify-content: center; align-items: center; gap: 6%; flex-direction: column;">
                        <div class="card p-3 w-100">
                            <div class="w-100" style="display: flex; justify-content: center; align-items: center;">
                                <span class="text-primary w-100" style="font-size: 20px !important; font-weight: 700; margin-left: 1%; height: 100%; text-align: center;">
                                    EMPLEADOS ACTIVOS POR DEPARTAMENTO
                                </span>
                            </div>
                            <div class="w-100" style="font-weight: 500; display: flex; justify-content: center; align-items: center; font-size: 50px; height: 100%;">
                                <div id="graf_ActivosXDepto" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- COLUMNA 4 --}}
                    <div style="max-height: 800px; max-width: 100%; width: 700px; display: flex; justify-content: center; align-items: center; gap: 6%; flex-direction: column;">
                        <div class="card p-3 w-100">
                            <div class="w-100" style="display: flex; justify-content: center; align-items: center;">
                                <span class="text-primary w-100" style="font-size: 20px !important; font-weight: 700; margin-left: 1%; height: 100%; text-align: center;">
                                    EMPLEADOS ACTIVOS POR PUESTO
                                </span>
                            </div>
                            <div class="w-100" style="font-weight: 500; display: flex; justify-content: center; align-items: center; font-size: 50px; height: 100%;">
                                <div id="graf_TotalXPuestos" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <br>
                {{--<hr class="mt-5 mb-5" style="height:1px;border-width:0;color:gray;background-color:rgb(205, 205, 205);">--}}


            </div>
            <!-- END: General Report -->
        </div>
    </div>
</div>



@endsection

@section('aditional_js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script>

        $(document).ready(function() {
            empleadosActivosXDepto()
            empleadosActivosXPuesto()
            setTimeout(() => {
                $('.preloaderRH').css('display', 'none')
            }, 1200)

        })



        function empleadosActivosXDepto() {
            let colors = ["#640d64", "#ff6f00", "#69f0ae"]

            var options = {
                chart: {
                    type: 'bar',
                    width: '100%',
                    height: '500px'
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '300px',
                        distributed: true,
                        horizontal: true,
                    }
                },
                series: [
                    {
                        name:"",
                        data: [
                            @foreach ($empleadosXDepto as $depto)
                                {{$depto->TotalXDepto}},
                            @endforeach
                        ]
                    },
                ],
                xaxis: {
                    categories: [
                        @foreach ($empleadosXDepto as $depto)
                            '{{$depto->nombre}}',
                        @endforeach
                    ]
                },
                legend: {
                    show: false
                },
            }
            var chart3 = new ApexCharts(document.querySelector("#graf_ActivosXDepto"), options);
            chart3.render();
        }


        function empleadosActivosXPuesto() {
            let colors = ["#640d64", "#ff6f00", "#69f0ae"]

            var options = {
                chart: {
                    type: 'bar',
                    width: '100%',
                    height: '500px'
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '300px',
                        distributed: true,
                        horizontal: true,
                    }
                },
                series: [
                    {
                        name:"",
                        data: [
                            @foreach ($empleadosXPuesto as $puesto)
                                {{$puesto->TotalXPuesto}},
                            @endforeach
                        ]
                    },
                ],
                xaxis: {
                    labels: {
                        show: false,
                    },
                    categories: [
                        @foreach ($empleadosXPuesto as $puesto)
                            '{{$puesto->Puesto}}',
                        @endforeach
                    ]
                },
                legend: {
                    show: false
                },
            }


            var chart3 = new ApexCharts(document.querySelector("#graf_TotalXPuestos"), options);
            chart3.render();
        }

    </script>
@endsection
