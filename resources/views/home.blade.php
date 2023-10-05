@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Menu Principal</div>

                    <div class="card-body">
                        <div class="col-md-12 row m-0">
                            <div class="col-4 mb-4 over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="usuarios">
                                    <img src="images/usuarioagregar.png" />
                                    <div class="nombre_modulos">Usuarios</div>
                                </a>
                            </div>

                            <div class="col-4 mb-4 over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="Producto">
                                    <img src="images/agregar.png" />
                                    <div class="nombre_modulos">Productos</div>
                                </a>
                            </div>
                            <div class="col-4 mb-4 over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="LineasProduccion">
                                    <img src="images/configuracionmas.png" />
                                    <div class="nombre_modulos">Lineas de producción</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12 row m-0">
                            <div class="col-4 mb-4 over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="ProcesosProduccion">
                                    <img src="images/playlist.png" />
                                    <div class="nombre_modulos">Ordenes de Producción</div>
                                </a>
                            </div>

                            <div class="col-4 mb-4 over-block-card card p-3 text-center">
                                <a class="btn btn-default text-center" href="Asignaciones">
                                    <img src="images/amas.png" />
                                    <div class="nombre_modulos">Asignacion de Productos a Linea</div>
                                </a>
                            </div>

                            <div class="col-4 mb-4 over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="chart">
                                    <img src="images/planing.png" />
                                    <div class="nombre_modulos">Planning Lineas de Producción</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
