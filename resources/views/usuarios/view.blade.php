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
                                    <img src="images/usuarios.png" />
                                </div>
                                <div>Usuarios
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <a href="usuarios/create" type="button" data-toggle="tooltip" title=""
                                   data-placement="bottom"
                                   class="btn-primary mr-3 btn " data-original-title="Example Tooltip">
                                    Nuevo
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="mb-0 table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Numero de Identificación</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{$d->id}}</th>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->contact}}</td>
                                    <td>{{$d->url}}</td>
                                    <td>{{$d->email}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="usuarios/{{$d->id}}/edit" class="btn btn-sm"
                                               data-toggle="tooltip" title=""
                                               data-original-title="Editar">
                                               <img src="images/editar.png"/>
                                            </a>
                                            <form method="POST" action="usuarios/{{$d->id}}" data-toggle="tooltip" title=""
                                               data-original-title="Eliminar">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn-sm btn">
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
