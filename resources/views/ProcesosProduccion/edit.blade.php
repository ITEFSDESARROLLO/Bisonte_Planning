@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nuevo > Ordenes de Producción</div>
                    <!--<script>window.alert("Algunas Funciones se estan Actualizando")</script>-->

                    <div class="card-body">
                        <form class="" method="POST" action="{{ url('ProcesosProduccion/'.$data->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="position-relative form-group">
                                <label for="nameTags" class="">Nombre</label>
                                <input name="name" id="nameTags"
                                       placeholder=""
                                       value="{{ $data->name ?: '' }}"
                                       type="text"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="cantidadTags" class="">Cantidad</label>
                                <input name="cantidad" id="cantidadTags"
                                       placeholder=""
                                       value="{{ $data->cantidad ?: '' }}"
                                       type="integer"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="startAtTags" class="">Inicio</label>
                                <input name="start_at" id="startAtTags"
                                       placeholder=""
                                       type="date"
                                       value="{{ $data->start_at ? Carbon\Carbon::parse($data->start_at)->format('Y-m-d'): '' }}"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="deadLineAtTags" class="">Final</label>
                                <input name="deadline_at" id="deadLineAtTags"
                                       placeholder=""
                                       type="date"
                                       value="{{ $data->deadline_at ? Carbon\Carbon::parse($data->deadline_at)->format('Y-m-d'): '' }}"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="colorTags" class="">Color</label>
                                <input name="color" id="colorTags"
                                       placeholder=""
                                       type="color"
                                       value="{{ $data->color ?: '' }}"
                                       class="form-control">
                            </div>
                             <div class="position-relative form-group">
                                <label for="horas" class="">Horas</label>
                                <input name="horas" id="hora"
                                       placeholder=""
                                       value="{{ $data->horas ?: '' }}"
                                       type="integer"
                                       class="form-control">
                            </div>

                            <div class="position-relative form-group">
                                <label for="projectTags" class="">Proyectos</label>
                                <select name="projects_id" id="projectTags" class="form-control">
                                    @foreach($LineasProduccion as $project)
                                        <option
                                            {{(($data->LineasProduccion) && ($data->LineasProduccion->id === $project->id)) ? 'selected' : ''}}
                                            value="{{$project->id}}">{{$project->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="position-relative form-group">
                                 <label for="productSelect" class="">Seleccionar Producto</label>
                                <select name="featured_id" id="productSelect" class="form-control">
                                    @foreach($Producto as $feature)
                                <option
                                     {{(($data->Producto) && ($data->Producto->id === $feature->id)) ? 'selected' : ''}}
                                        value="{{$feature->id}}">{{$feature->name}}</option>
                                         @endforeach
                                                 </select>
                                </div>


                            <!--{!! $data->trix('content') !!}-->

                            <button class="mt-1 btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        function setValue(text = '') {
            const trixEditor = document.querySelector("trix-editor")
            trixEditor.editor.insertHTML(text);
        }

        document.addEventListener("DOMContentLoaded", function (event) {
            setValue(`{!! $data->content !!}`)
        });

    </script>

@endsection
