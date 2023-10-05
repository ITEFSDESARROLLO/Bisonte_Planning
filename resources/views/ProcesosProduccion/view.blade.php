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
                                <img src="images/procesoproduccion.png"/>
                                </div>
                                <div>Ordenes de producción
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <a href="ProcesosProduccion/create" type="button" data-toggle="tooltip" title=""
                                   data-placement="bottom"
                                   class="btn-primary mr-3 btn " data-original-title="Crear Orden">
                                    Nueva Orden
                                </a>
                            </div>
                          <form action="{{ route('upload.excel.controller') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="excel_file" accept=".xls,.xlsx">
                        <button type="submit">Subir archivo</button>
                        </form>
                          <form action="{{ route('filtrar.produccion') }}" method="GET">
                         <div class="form-group">
                           <label for="fecha_inicio">Inicio:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio">
                            <label for="fecha_fin">Fin:</label>
                            <input type="date" id="fecha_fin" name="fecha_fin">
                             <button type="submit">Filtrar</button>
                            </form>
                            <form action="{{ route('quitar.filtro') }}" method="GET">
                             <button type="submit">Quitar</button>
                            </form>
                            </div>
                            </div>
                    <div class="card-body">
                        <table class="mb-0 table">
                            <thead>
                            <tr>
                           <!---<th>#</th>-->
                                <th>Lote</th>
                                <th>Cantidad</th>
                                <th>Color</th>
                                <th>Linea de Produccion</th>
                                <th>Inicio Fecha</th>
                                <th>Final Fecha</th>
                                <th>Indentificador</th>
                                <th>Producto</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr class="{{($d->is_range === 'current') ?
                                    'row-danger-border':
                                       (($d->is_range === 'next_week') ? 'row-warning-border': '')
                                    }}">
                                  <!--  <th scope="row">{{$d->id}}</th>-->
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->cantidad}}</td>
                                    <td>
                                        <span class="badge badge-info"
                                              style="background-color: {{$d->color}}">{{$d->color}}</span>
                                    </td>
                                    <!-- Esta linea llama la tabla de LienasProduccion  por medio del ID y las muestra en la vista
                                    Si se quiere mostrar por id se pone el campo de la DB  en: INT-->
                                    <td>{{($d->LineasProduccion) ? $d->LineasProduccion->title : 'N/A'}}</td>
                                   <!-- <td>{{$d->projects_id}}</td>Esta Linea  muesta lo propio de la tabla en ese campo
                                    Si se quiere mostrar el campo propio del la Tabla se pone en : VARCHAR-->
                                    <td>{{$d->start_at}}</td>
                                    <td>{{$d->deadline_at}}</td>
                                    <td>{{($d->Producto) ? $d->Producto->codigo : 'N/A'}}</td>
                                    <td>{{($d->Producto) ? $d->Producto->name : 'N/A'}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="ProcesosProduccion/{{$d->id}}/edit" class="btn btn-sm"
                                               data-toggle="tooltip" title=""
                                               data-original-title="Editar">
                                               <img src="images/editar.png" />
                                            </a>
                                            <div class="d-flex">
                                        <a href="ProcesosProduccion/{{$d->id}}" class="btn btn-sm"
                                           data-toggle="tooltip" title=""
                                           data-original-title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                            <form method="POST" action="ProcesosProduccion/{{$d->id}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn-sm btn">
                                                <img src="images/eliminar.png" />
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
@endsection


