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
                                <img src="images/lineasproduccion.png" />
                                </div>
                                <div>Lineas de Producción
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <a href="LineasProduccion/create" type="button" data-toggle="tooltip" title=""
                                   data-placement="bottom"
                                   class="btn-primary mr-3 btn " data-original-title="Linea de produccion">
                                    Nueva Linea
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="mb-0 table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Planta</th>
                                <th>Nombre de Linea</th>
                                <th>Responsable</th>
                               <!-- <th>Url</th>
                                <th>Descripcion</th> -->
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <th scope="row">{{$d->id}}</th>
                                    <td>{{$d->planta}}</td>
                                    <td>{{$d->title}}</td>
                                    <td>{{$d->organization->contact}}</td>
                                    <!--<td>{{$d->url}}</td>
                                    <td>{{$d->description}}</td>-->
                                    <td>
                                        <div class="d-flex">
                                            <a href="LineasProduccion/{{$d->id}}/edit" class="btn btn-sm"
                                               data-toggle="tooltip" title=""
                                               data-original-title="Editar">
                                               <img src="images/editar.png"/>
                                            </a>
                                            <form method="POST" action="LineasProduccion/{{$d->id}}">
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
