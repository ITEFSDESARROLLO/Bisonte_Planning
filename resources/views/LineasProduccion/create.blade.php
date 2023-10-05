@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nuevo > Linea de Producción</div>
                    <div class="card-body">
                        <form class="" method="POST" action="{{ url('LineasProduccion') }}">
                            {{ csrf_field() }}
                            <div class="position-relative form-group">
                                <label for="lineas" class="">Planta</label>
                                <input name="planta" id="nameFeatures"
                                       placeholder=""
                                       type="integer"
                                       class="form-control">
                            </div>

                            <div class="position-relative form-group">
                                <label for="titleProjects" class="">Nombre de Linea</label>
                                <input name="title" id="titleProjects"
                                       placeholder=""
                                       type="text"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="organizationsProjects" class="">Responsable</label>
                                <select name="organizations_id" id="organizationsProjects" class="form-control">
                                    @foreach($usuarios as $organization)
                                        <option value="{{$organization->id}}">{{$organization->contact}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="mt-1 btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
