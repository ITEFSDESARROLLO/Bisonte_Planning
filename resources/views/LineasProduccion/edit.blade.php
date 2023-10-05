@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit > Linea de producción</div>

                    <div class="card-body">
                        <form class="" method="POST" action="{{ url('LineasProduccion/'.$data->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="position-relative form-group">
                                <label for="codigoLineas" class="">Planta</label>
                                <input name="planta" id="nameFeatures"
                                       placeholder=""
                                       value="{{ $data->planta ?: '' }}"
                                       type="integer"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="titleProjects" class="">Nombre Linea Produccion</label>
                                <input name="title" id="titleProjects"
                                       placeholder=""
                                       value="{{ $data->title ?: '' }}"
                                       type="text"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="organizationsProjects" class="">Organizacion</label>
                                <select name="organizations_id" id="organizationsProjects" class="form-control">
                                    @foreach($usuarios as $organization)
                                        <option
                                            {{ ($data->organizations_id === $organization->id) ? 'selected': '' }}
                                            value="{{$organization->id}}">{{$organization->contact}}</option>
                                    @endforeach
                                </select>
                            </div>
                           <!-- <div class="position-relative form-group">
                                <label for="urlProjects" class="">Url</label>
                                <input name="url" id="urlProjects"
                                       placeholder=""
                                       value="{{ $data->url ?: '' }}"
                                       type="url"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="descriptionProjects" class="">Descripcion</label>
                                <textarea name="description" id="descriptionProjects"
                                          placeholder=""
                                          class="form-control">
                                       {{ $data->description ?: '' }}
                                </textarea>
                            </div>-->
                            <button class="mt-1 btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
