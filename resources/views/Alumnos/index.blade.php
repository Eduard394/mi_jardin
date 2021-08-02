
@section('content')
@extends('adminlte::page')
<br>
<head>
    <link rel="stylesheet" href="/css/chosen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <style>
        .col-4{
            margin-bottom: 1%;
        }
    </style>
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
                                @if(!empty($al))
                                    <input hidden id="idAlumno" value="{{$al->id}}">
                                @endif
                                    
                                    <div class="col-4">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" v-model="nombre" id="nombre" class="form-control" name="nombre"  placeholder="Nombre" value="">
                                    </div>
                                    <div class="col-4">
                                        <label for="matricula">Matrícula:</label>
                                        <input type="number" v-model="matricula" id="matricula" class="form-control" name="matricula"  placeholder="Matrícula" value="{{$items[0]->matricula}}">
                                    </div>
                                    <div class="col-4">
                                        <label for="materiales">Materiales:</label>
                                        <input type="number" v-model="materiales" id="materiales" class="form-control" name="materiales" placeholder="Materiales" value="{{$items[0]->materiales}}">
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
                                        <input type="date" v-model="fecha_ingreso" id="fecha_ingreso" class="form-control" name="fecha_ingreso" placeholder="fecha_ingreso" value="{{$items[0]->inicio}}">
                                    </div>
                                    <div class="col-4">
                                        <label for="fecha_retiro">Fecha de retiro:</label>
                                        <input type="date" v-model="fecha_retiro" id="fecha_retiro" class="form-control" name="fecha_retiro" placeholder="Fecha de retiro" value="{{$items[0]->culminacion}}">
                                    </div>      
                                    <div class="col-4">
                                        <label for="pension">Pensión:</label>
                                        <input type="number" v-model="pension" id="pension" class="form-control" name="pension" placeholder="Pensión" value="{{$items[0]->pension}}">
                                    </div>   
                                    <div class="col-4">
                                        <label for="seguro">Seguro:</label>
                                        <input type="number" v-model="seguro" id="seguro" class="form-control" name="seguro" placeholder="Seguro" value="{{$items[0]->seguro}}">
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
                                        <label for="lonchera">Lonchera</label><br>
                                        <input type="checkbox" id="lonchera" name="lonchera">
                                    </div>
                                    <div id="div_valor_lonchera" class="col-4" style="display: none;">
                                        <label for="valor_lonchera">Valor lonchera</label>
                                        <input type="number" v-model="valor_lonchera" id="valor_lonchera" class="form-control" name="valor_lonchera"  placeholder="Valor de la lonchera" value="{{$items[0]->lonchera}}">
                                    </div>
                                    <div class="col-4">
                                        <label for="hermano">Hermano</label><br>
                                        <input type="checkbox" id="hermano" name="hermano">
                                    </div>
                                    <div id="div_hermano" class="col-4">
                                        <label for="hermano_de">Hermano de:</label>
                                        <select name="hermano_de" id="hermano_de" class="custom-select chosen-select form-control">
                                            <option value="NULL" > Seleccione el hermano</option>
                                            @foreach($alumnos as $alum)
                                                <option  value="{{ $alum->id }}" >{{ $alum->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="descuento">Aplicar descuentos</label><br>
                                        <input type="checkbox" id="descuento" name="descuento" checked>
                                    </div>
                                    <div class="col-4">
                                        <label for="acudiente">Nombre acudiente:</label>
                                        <input type="text" v-model="acudiente" id="acudiente" class="form-control" name="acudiente"  placeholder="Nombre acudiente" >
                                    </div>
                                    <div class="col-4">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="text" v-model="telefono" id="telefono" class="form-control" name="telefono"  placeholder="Teléfono" >
                                    </div>
                                    <div class="col-4">
                                        <label for="correo">Correo electrónico:</label>
                                        <input type="text" v-model="correo" id="correo" class="form-control" name="correo"  placeholder="correo" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" style="text-align: end;">
                                <a onclick="clearForm()" class="btn btn-secondary text-white"> Cancelar </a>
                                <a onclick="saveData()" class="btn btn-success text-white" id="guardar"><span id="esperaguardar"></span>Guardar </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="/js/chosen.jquery.js"></script>
<script>

    $(".chosen-select").chosen();
    var datos;

    var formvalid 	= true;

    $(document).ready(function(){
        
        setTimeout(function(){
            $( '#div_hermano' ).css( 'display', 'none' );
        }, 1000);

        if ( $('#idAlumno').val() != undefined ) {
            getAlumno($('#idAlumno').val());
        }

    });

    function getAlumno( idAlumno ) {

        const myObject = new Vue({

            created () {
                this.getData()
            },

            methods : {

                async getData(){
                    
                    const resp = await  axios.get( '/alumno/getAlumno', {
                        params: { 
                            alumno_id: idAlumno
                        }
                    } );
                    
                    if( resp.status == 200 ){

                        let data = resp.data;

                        $( '#nombre' ).val( data.nombre );
                        $( '#matricula' ).val( data.matricula );
                        $( '#materiales' ).val( data.materiales );
                        $( '#jornada' ).val( data.jornada );
                        $( '#fecha_ingreso' ).val( data.fecha_ingreso );
                        $( '#fecha_retiro' ).val( data.fecha_retiro );
                        $( '#pension' ).val( data.pension );
                        $( '#seguro' ).val( data.seguro )
                        $( '#grado' ).val( data.grado );
                        if ( data.lonchera ) {
                            $( '#lonchera' ).prop( 'checked', true );
                            $( '#div_valor_lonchera' ).show();
                        }
                        $( '#valor_lonchera' ).val( data.lonchera_valor );
                        if ( data.hermano ){
                            $( '#hermano' ).prop( 'checked', true );
                            $( '#div_hermano' ).show();
                            $( '#hermano_de' ).val( data.hermano_id );
                            $( '#hermano_de' ).trigger( 'chosen:updated' );
                        }
                        if ( !data.descuento ) {
                            $( '#descuento' ).prop( 'checked', false ); 
                        }
                        $( '#acudiente' ).val( data.acudiente );
                        $( '#telefono' ).val( data.telefono );
                        $( '#correo' ).val( data.correo );

                        $( '#fecha_ingreso' ).prop( 'disabled', true );
                        $( '#matricula' ).prop( 'disabled', true );
                        $( '#materiales' ).prop( 'disabled', true );
                        $( '#seguro' ).prop( 'disabled', true );
                        
                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })

    }

    function saveData() {

        $( '#esperaguardar' ).addClass( 'spinner-border spinner-border-sm mr-2' );
        $( '#guardar' ).css( 'pointer-events', 'none' );

        formvalid = true;
        formvalid = validarDatos();
        
        if( formvalid ) {
            if ( $('#idAlumno').val() != undefined ) {
                update();
            } else {
                save();
            }
        }
        else {
            $( '#esperaguardar' ).removeClass( 'spinner-border spinner-border-sm mr-2' );
            $( '#guardar' ).css( 'pointer-events', '' );
        }
        
    } 

    function save() {

        let fecha           = new Date( $( '#fecha_ingreso' ).val() );
        let manana = new Date( fecha );
        manana.setDate( fecha.getDate() + 1 );
        let anoInicio         = manana.getFullYear();
        let mesInicio         = manana.getMonth() + 1;

        event.preventDefault();

        const myObject = new Vue({

            created () {
                this.save()
            },

            methods : {
                async save(){

                    let data = {

                        nombre: $( '#nombre' ).val(),
                        matricula: $( '#matricula' ).val(),
                        materiales: $( '#materiales' ).val(),
                        jornada: $( '#jornada' ).val(),
                        fecha_ingreso: $( '#fecha_ingreso' ).val(),
                        fecha_retiro: $( '#fecha_retiro' ).val(),
                        pension: $( '#pension' ).val(),
                        seguro: $( '#seguro' ).val(),
                        grado: $( '#grado' ).val(),
                        lonchera: $( '#lonchera' ).is( ':checked' ),
                        lonchera_valor: $( '#valor_lonchera' ).val(),
                        hermano: $( '#hermano' ).is( ':checked' ),
                        hermano_id: $( '#hermano_de' ).val(),
                        descuento: $( '#descuento' ).is( ':checked' ),
                        acudiente: $( '#acudiente' ).val(),
                        telefono: $( '#telefono' ).val(),
                        correo: $( '#correo' ).val(),
                        mesInicio: mesInicio,
                        anoInicio: anoInicio

                    };
                    
                    const resp = await  axios.post( '/alumno/crear', data );
                    
                    if( resp.status == 200 ){
                        
                        toastr.success( 'Alumno creado exitosamente' );
                        $( '#esperaguardar' ).removeClass( 'spinner-border spinner-border-sm mr-2' );
                        $( '#guardar' ).css( 'pointer-events', '' );
                        location.reload();

                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })
    }

    function update() {

        event.preventDefault();

        const myObject = new Vue({

            created () {
                this.save()
            },

            methods : {
                async save(){

                    let data = {

                        alumno_id: $( '#idAlumno' ).val(),
                        nombre: $( '#nombre' ).val(),
                        matricula: $( '#matricula' ).val(),
                        materiales: $( '#materiales' ).val(),
                        jornada: $( '#jornada' ).val(),
                        fecha_ingreso: $( '#fecha_ingreso' ).val(),
                        fecha_retiro: $( '#fecha_retiro' ).val(),
                        pension: $( '#pension' ).val(),
                        seguro: $( '#seguro' ).val(),
                        grado: $( '#grado' ).val(),
                        lonchera: $( '#lonchera' ).is( ':checked' ),
                        lonchera_valor: $( '#valor_lonchera' ).val(),
                        hermano: $( '#hermano' ).is( ':checked' ),
                        hermano_id: $( '#hermano_de' ).val(),
                        descuento: $( '#descuento' ).is( ':checked' ),
                        acudiente: $( '#acudiente' ).val(),
                        telefono: $( '#telefono' ).val(),
                        correo: $( '#correo' ).val(),

                    };
                    
                    const resp = await  axios.post( '/alumno/update', data );
                    
                    if( resp.status == 200 ){
                        
                        toastr.success( 'Alumno actualizado exitosamente' );
                        $( '#esperaguardar' ).removeClass( 'spinner-border spinner-border-sm mr-2' );
                        $( '#guardar' ).css( 'pointer-events', '' );
                        window.location.href = "/alumno/lista";

                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })
    }

    function validarDatos() {

        if ( $( '#nombre' ).val().length <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo nombre es obligatorio' );
        }

        if ( $( '#matricula' ).val() <= 0 || $( '#matricula' ).val() == '' ) {
            formvalid = false;
            toastr.error( 'El campo matricula es obligatorio' );
        }

        if ( $( '#jornada' ).val() == "NULL" ) {
            formvalid = false;
            toastr.error( 'El campo jornada es obligatorio' );
        }

        if ( $( '#fecha_ingreso' ).val().length <= 0 ) { 
            formvalid = false;
            toastr.error( 'El campo fecha de ingreso es obligatorio' );
        }

        if ( $( '#fecha_retiro' ).val().length <= 0 ) { 
            formvalid = false;
            toastr.error( 'El campo fecha de retiro es obligatorio' );
        }

        if ( $( '#pension' ).val() < 0 || $( '#pension' ).val() == ''  ) {
            formvalid = false;
            toastr.error( 'El campo pensión es obligatorio y mayor o igual a 0' );
        }

        if ( $( '#seguro' ).val() <= 0 || $( '#seguro' ).val() <= '' ) {
            formvalid = false;
            toastr.error( 'El campo seguro es obligatorio' );
        }

        if ( $( '#grado' ).val() == "NULL" ) {
            formvalid = false;
            toastr.error( 'El campo grado es obligatorio' );
        }

        if ( $( '#acudiente' ).val().length <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo nombre acudiente es obligatorio' );
        }

        if ( $( '#telefono' ).val().length < 7 ) {
            formvalid = false;
            toastr.error( 'El campo teléfono es inválido' );
        }

        if ( $( '#lonchera' ).is( ':checked' ) && $( '#valor_lonchera' ).val() < 0 ) {
            formvalid = false;
            toastr.error( 'El campo valor de la lonchera es obligatorio' );
        }

        if ( $( '#hermano' ).is( ':checked' ) && $( '#hermano_de' ).val().length == "NULL" ) {
            formvalid = false;
            toastr.error( 'El campo hermano de es obligatorio' );
        }

        return formvalid;
    }

    $( document ).on( 'change', '#lonchera', function() {

        if ( $( '#lonchera' ).is( ':checked' ) )
            $( '#div_valor_lonchera' ).show();
        else 
            $( '#div_valor_lonchera' ).hide()

    });

    $( document ).on( 'change', '#hermano', function() {

        if ( $( '#hermano' ).is( ':checked' ) ){
            $( '#div_hermano' ).show();
            $( '#hermano_de' ).trigger( 'chosen:updated' );
        }
        else 
            $( '#div_hermano' ).hide()

    });

    function getMes( mes ) {

        if ( mes < 9 ) 
            return 0 + ( parseInt( mes ) + 1 );
        else 
            return ( parseInt( mes ) + 1 );

    }
</script>
@endsection
