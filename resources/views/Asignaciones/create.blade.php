@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Nuevo > Asignación</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('Asignaciones') }}">
                        @csrf
                        <div class="position-relative form-group">
                            <label for="dateBeginReports">Desde</label>
                            <input name="date_begin" id="dateBeginReports" type="date" class="form-control">
                        </div>
                        <div class="position-relative form-group">
                            <label for="dateFinishReports">Hasta</label>
                            <input name="date_finish" id="dateFinishReports" type="date" class="form-control">
                        </div>
                        <div class="position-relative form-group">
                            <label for="reportsProject">Línea de Producción</label>
                            <select name="project_with_organization" id="reportsProject" class="form-control">
                                <option value="">Seleccione linea de Producción</option>
                                @foreach($LineasProduccion as $project)
                                <option value="{{$project->organization->id}}_{{$project->id}}">
                                    [{{$project->organization->name}}] {{$project->title}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Agregar el formulario que se desplegará al seleccionar una opción del menú desplegable -->
                        <div id="formularioAsignacion" style="display: none;">
                         <div class="card-header">Nuevo formulario de Asignación</div>
                        <!-- Agrega aquí los campos y elementos del formulario -->
                        </div>
                        <button class="mt-1 btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Escucha los cambios en el menú desplegable
    document.getElementById("reportsProject").addEventListener("change", function() {
        var selectedOption = this.value;
        var formularioAsignacion = document.getElementById("formularioAsignacion");

        if (selectedOption) {
            // Si se selecciona una opción, muestra el formulario
            formularioAsignacion.style.display = "block";
        } else {
            // Si no se selecciona ninguna opción, oculta el formulario
            formularioAsignacion.style.display = "none";
        }
    });
</script>
@endsection
