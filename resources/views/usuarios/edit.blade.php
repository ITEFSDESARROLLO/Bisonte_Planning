@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar > Usuario</div>

                    <div class="card-body">
                        <form class="" method="POST" action="{{ url('usuarios/'.$data->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="position-relative form-group">
                                <label for="identificacionOrganizations" class="">Numero de Identificación</label>
                                <input name="name" id="nameOrganizations"
                                       value="{{ $data->name ?: '' }}"
                                       placeholder=""
                                       type="number"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="nameOrganizations" class="">Nombre</label>
                                <input name="contact" id="contactOrganizations"
                                       value="{{ $data->contact ?: '' }}"
                                       placeholder=""
                                       type="text"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="urlOrganizations" class="">Rol</label>
                                <input name="url" id="urlOrganizations"
                                       placeholder=""
                                       value="{{ $data->url ?: '' }}"
                                       type="text"
                                       class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label for="emailOrganizations" class="">Email</label>
                                <input name="email" id="emailOrganizations"
                                       placeholder=""
                                       type="email"
                                       value="{{ $data->email ?: '' }}"
                                       class="form-control">
                            </div>
                            <button class="mt-1 btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
