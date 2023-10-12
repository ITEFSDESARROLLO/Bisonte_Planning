@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">Nuevo > Ordenes de Producción</div>
                    <div class="card-body">
                        <form class="" method="POST" action="{{ url('ProcesosProduccion') }}">
                            {{ csrf_field() }}
                            <div class="position-relative form-group">
                                <label for="nameTags" class="">Lote</label>
                                <input name="name" id="nameTags"
                                       placeholder=""
                                       type="text"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="cantidadTags" class="">Cantidad</label>
                                <input name="cantidad" id="cantidadTags"
                                       placeholder=""
                                       type="integer"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="startAtTags" class="">Inicio</label>
                                <input name="start_at" id="startAtTags"
                                       placeholder=""
                                       type="date"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="deadLineAtTags" class="">Final</label>
                                <input name="deadline_at" id="deadLineAtTags"
                                       placeholder=""
                                       type="date"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="colorTags" class="">Color</label>
                                <input name="color" id="colorTags"
                                       placeholder=""
                                       type="color"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="horas" class="">Hora</label>
                                <input name="horas" id="hora"
                                       placeholder=""
                                       type="integer"
                                       class="form-control">
                            </div>

                            <div class="position-relative form-group">
                                <label for="projectTags" class="">Linea de Producción</label>
                                <select name="projects_id" id="projectTags" class="form-control">
                                    @foreach($LineasProduccion as $project)
                                        <option value="{{$project->id}}">{{$project->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="position-relative form-group">
                                <label for="productSelect" class="">Seleccionar Producto</label>
                                <select name="featured_id" id="productSelect" class="form-control">
                                    @foreach($Producto as $feature)
                                        <option value="{{$feature->id}}">{{$feature->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!--@trix(\App\Tags::class, 'content')-->
                            <button class="mt-1 btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
