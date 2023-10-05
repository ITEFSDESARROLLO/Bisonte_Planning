@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Menu Principal</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="usuarios">
                                    <img src="images/usuarioagregar.png" class="mb-2" alt="Usuarios" />
                                    <div class="nombre_modulos">Usuarios</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="Producto">
                                    <img src="images/agregar.png" class="mb-2" alt="Productos" />
                                    <div class="nombre_modulos">Productos</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="LineasProduccion">
                                    <img src="images/configuracionmas.png" class="mb-2" alt="Lineas de producción" />
                                    <div class="nombre_modulos">Lineas de producción</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="ProcesosProduccion">
                                    <img src="images/playlist.png" class="mb-2" alt="Ordenes de Producción" />
                                    <div class="nombre_modulos">Ordenes de Producción</div>
                                </a>
                            </div>
                        </div>
                        <!-- Descomenta este bloque si decides usarlo -->
                        <!--
                        <div class="col-md-4 mb-4">
                            <div class="over-block-card card p-3 text-center">
                                <a class="btn btn-default text-center" href="Asignaciones">
                                    <img src="images/amas.png" class="mb-2" alt="Asignación de Productos a Linea" />
                                    <div class="nombre_modulos">Asignación de Productos a Linea</div>
                                </a>
                            </div>
                        </div>
                        -->
                        <div class="col-md-4 mb-4">
                            <div class="over-block-card card p-3 text-center">
                                <a class="btn btn-default" href="chart">
                                    <img src="images/planing.png" class="mb-2" alt="Planning Lineas de Producción" />
                                    <div class="nombre_modulos">Planning Lineas de Producción</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
