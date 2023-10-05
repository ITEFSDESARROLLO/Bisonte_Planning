

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nuevo > Asignacion de Producto > {{$report->project->title}}</div>

                    <div class="card-body">
                        <form class="" method="POST" action="{{ url('ProdLineasAgregar') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="projects_id" value="{{$report->project->id}}">
                            <input type="hidden" name="report_id" value="{{$report->id}}">

                            <div class="position-relative form-group">
                                <label for="titleProjects" class="">Numero de Orden</label>
                                <select name="title" id="titleProjects" class="form-control">
                                @foreach($ProcesosProduccion as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="position-relative form-group">
                                <label for="tagIssues" class="">Asignar Orden De Fabricacíon</label>
                                <select name="tag_id" id="tagIssues" class="form-control">
                                    @foreach($ProcesosProduccion as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="position-relative form-group">
                                    @foreach($Producto as $feature)
                                    @endforeach
                            <div class="position-relative form-group">
                                @foreach($ProcesosProduccion as $feature)
                                                <input id="check_{{$feature->id}}" name="Producto[{{$feature->id}}]"
                                                 value="{{$feature->id}}" >
                                                <label for="check_{{$feature->id}}">{{$feature->featured_id}}</label>
                                                @endforeach
                                </select>
                            </div>
                                          <!--  <td>
                                                <input name="hours_list[{{$feature->id}}]" id="nameFeatures"
                                                       placeholder=""
                                                       type="number"
                                                       class="form-control">
                                            </td>-->
                            </div>
                            <div class="position-relative form-group">
                                <label for="developerIssues" class="">Developer</label>
                                <select name="users_id" id="developerIssues" class="form-control">
                                    @foreach($developers as $developer)
                                        <option value="{{$developer->id}}">{{$developer->name}}</option>
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
