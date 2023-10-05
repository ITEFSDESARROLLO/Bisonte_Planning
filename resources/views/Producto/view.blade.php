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
                                <img src="images/productos.png"/>
                                </div>
                                <div>Productos
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <a href="Producto/create" type="button" data-toggle="tooltip" title=""
                                   data-placement="bottom"
                                   class="btn-primary mr-3 btn " data-original-title="Example Tooltip">
                                    Nuevo
                                </a>
                            </div>
                            <form action="{{ route('upload.excel.controller') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="excel_file" accept=".xls,.xlsx">
                            <button type="submit">Subir archivo</button>
                            </form>

                        </div>
                    </div>

                    <div class="card-body">
                        <table class="mb-0 table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Unid X Horas</th>
                                <th>Pre</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{$d->id}}</th>
                                    <td>{{$d->codigo}}</td>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->unid_x_hora}}</td>
                                    <td>
                                        <span class="{{($d->default_value) ? 'text-success' : 'text-muted'}}">
                                            {{($d->default_value) ? 'Si' : 'No'}}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="Producto/{{$d->id}}/edit" class="btn btn-sm"
                                               data-toggle="tooltip" title=""
                                               data-original-title="Editar">
                                               <img src="images/editar.png"/>
                                            </a>
                                            <form method="POST" action="Producto/{{$d->id}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn-sm btn"
                                                data-original-title="Editar">
                                                <img src="images/eliminar.png"/>
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
