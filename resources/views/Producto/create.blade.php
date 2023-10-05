@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nuevo > Producto</div>

                    <div class="card-body">
                        <form class="" method="POST" action="{{ url('Producto') }}">
                            {{ csrf_field() }}
                            <div class="position-relative form-group">
                                <label for="codigoProducto" class="">Codigo</label>
                                <input name="codigo" id="codigoProducto"
                                       placeholder=""
                                       type="integer"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="nameFeatures" class="">Nombre</label>
                                <input name="name" id="nameFeatures"
                                       placeholder=""
                                       type="text"
                                       class="form-control">
                            </div>

                           <!-- <div class="position-relative form-group">
                                <label for="descriptionFeatures" class="">DescripcionN</label>
                                <textarea name="description" id="descriptionFeatures"
                                          placeholder=""
                                          class="form-control">
                                </textarea>
                            </div>
                            -->
                             <div class="position-relative form-group">
                                <label for="unidxhoraFeatures" class="">Unidad X Horas</label>
                                <input name="unid_x_hora" id="unidxhoraFeatures"
                                       placeholder=""
                                       type="integer"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="default_valueFeatures" class="">Pre seleccionado</label>
                                <select name="default_value" id="default_valueFeatures" class="form-control">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
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
