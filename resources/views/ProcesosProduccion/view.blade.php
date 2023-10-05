@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="app-page-title m-0">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <img src="images/procesoproduccion.png" alt="Orden de Producción" />
                            </div>
                            <div>Ordenes de producción</div>
                        </div>
                        <div class="page-title-actions">
                            <a href="ProcesosProduccion/create" type="button" data-toggle="tooltip" title=""
                                data-placement="bottom" class="btn-primary mr-3 btn " data-original-title="Crear Orden">
                                Nueva Orden
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('upload.excel.controller') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="excel_file" accept=".xls,.xlsx">
                        </div>
                        <button type="submit" class="btn btn-primary">Subir archivo</button>
                    </form>

                    <form action="{{ route('filtrar.produccion') }}" method="GET" class="mt-3">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="fecha_inicio">Inicio:</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_fin">Fin:</label>
                                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="submit" formaction="{{ route('quitar.filtro') }}" class="btn btn-danger">Quitar
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Lote</th>
                                    <th>Cantidad</th>
                                    <th>Color</th>
                                    <th>Linea de Produccion</th>
                                    <th>Inicio Fecha</th>
                                    <th>Final Fecha</th>
                                    <th>Indentificador</th>
                                    <th>Producto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr class="{{($d->is_range === 'current') ? 'row-danger-border': (($d->is_range === 'next_week') ? 'row-warning-border': '')}}">
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->cantidad}}</td>
                                    <td>
                                        <span class="badge badge-info" style="background-color: {{$d->color}}">{{$d->color}}</span>
                                    </td>
                                    <td>{{($d->LineasProduccion) ? $d->LineasProduccion->title : 'N/A'}}</td>
                                    <td>{{$d->start_at}}</td>
                                    <td>{{$d->deadline_at}}</td>
                                    <td>{{($d->Producto) ? $d->Producto->codigo : 'N/A'}}</td>
                                    <td>{{($d->Producto) ? $d->Producto->name : 'N/A'}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="ProcesosProduccion/{{$d->id}}/edit" class="btn btn-sm" data-toggle="tooltip" title=""
                                                data-original-title="Editar">
                                                <img src="images/editar.png" alt="Editar" />
                                            </a>
                                            <a href="ProcesosProduccion/{{$d->id}}" class="btn btn-sm" data-toggle="tooltip" title=""
                                                data-original-title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form method="POST" action="ProcesosProduccion/{{$d->id}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn-sm btn">
                                                    <img src="images/eliminar.png" alt="Eliminar" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
