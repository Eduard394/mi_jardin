
@section('content')
@extends('adminlte::page')
<br>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <div class="col-12" id="alumnos">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Nuevo alumno</h3>
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <form id="crearAlumno">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" v-model="nombre" id="nombre" class="form-control" name="nombre"  placeholder="Nombre" >
                                    </div>
                                    <div class="col-4">
                                        <label for="codigo">Código:</label>
                                        <input type="text" v-model="codigo" id="codigo" class="form-control" name="codigo" placeholder="Código">
                                    </div>
                                    <div class="col-4">
                                        <label for="periodo_entrada">Periodo de entrada:</label>
                                        <input type="number" v-model="periodo_entrada" id="periodo_entrada" class="form-control" name="periodo_entrada"  placeholder="Periodo de entrada" >
                                    </div>
                                    <div class="col-4">
                                        <label for="periodo_salida">Periodo de salida:</label>
                                        <input type="number" v-model="periodo_salida" id="periodo_salida" class="form-control" name="periodo_salida" placeholder="Periodo de salida">
                                    </div>
                                    <div class="col-4">
                                        <label for="matricula">Matrícula:</label>
                                        <input type="number" v-model="matricula" id="matricula" class="form-control" name="matricula"  placeholder="Matrícula" >
                                    </div>
                                    <div class="col-4">
                                        <label for="materiales">Materiales:</label>
                                        <input type="number" v-model="materiales" id="materiales" class="form-control" name="materiales" placeholder="Materiales">
                                    </div>    
                                    <div class="col-4">
                                        <label for="jornada">Jornada:</label>
                                        <select v-model="jornada" id="jornada" class="form-control" name="jornada">
                                            <option value="NULL">Ninguno</option>
                                            <option value="manana">Mañana</option>
                                            <option value="tarde">Tarde</option>
                                            <option value="ambas">Ambas</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="fecha_ingreso">Fecha de ingreso:</label>
                                        <input type="date" v-model="fecha_ingreso" id="fecha_ingreso" class="form-control" name="fecha_ingreso" placeholder="fecha_ingreso">
                                    </div>
                                    <div class="col-4">
                                        <label for="fecha_retiro">Fecha de retiro:</label>
                                        <input type="date" v-model="fecha_retiro" id="fecha_retiro" class="form-control" name="fecha_retiro" placeholder="Fecha de retiro">
                                    </div>      
                                    <div class="col-4">
                                        <label for="pension">Pensión:</label>
                                        <input type="number" v-model="pension" id="pension" class="form-control" name="pension" placeholder="Pensión">
                                    </div>   
                                    <div class="col-4">
                                        <label for="seguro">Seguro:</label>
                                        <input type="number" v-model="seguro" id="seguro" class="form-control" name="seguro" placeholder="Seguro">
                                    </div>   
                                    <div class="col-4">
                                        <label for="grado">Grado:</label>
                                        <select v-model="jornada" id="grado" class="form-control" name="jornada">
                                            <option value="NULL">Ninguno</option>
                                            <option value="adaptacion">Adaptación</option>
                                            <option value="materno">Materno</option>
                                            <option value="pre_jardin">Pre-jardín</option>
                                            <option value="jardin">Jardín</option>
                                            <option value="transicion">Transición</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="acudiente">Nombre acudiente:</label>
                                        <input type="text" v-model="acudiente" id="acudiente" class="form-control" name="acudiente"  placeholder="Nombre acudiente" >
                                    </div>
                                    <div class="col-4">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="text" v-model="telefono" id="telefono" class="form-control" name="telefono"  placeholder="Teléfono" >
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
<script src="{{ asset('js/alumno.js') }}"></script>
</script>
@endsection
