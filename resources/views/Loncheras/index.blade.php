<select-simple ref="convocatoria_id" titulo="Convocatoria" url="/convocatoria/selector"></select-simple>
@section('content')
@extends('adminlte::page')
<br>
<body>
    <div class="col-12" id="alumnos">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Lonchera</h3>
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <form id="crearAlumno">
                            <div class="col-md-12">
                                <div class="row"> 
                                    <div class="col-12">
                                        <label for="grado">Grado:</label>
                                        <select v-model="jornada" id="grado" class="form-control" name="jornada">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align: end;">
                                <a onclick="clearForm()" class="btn btn-secondary text-white"> Cancelar </a>
                                <a onclick="saveData()" class="btn btn-success text-white"> Guardar </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/loncheras.js') }}"></script>
@endsection
