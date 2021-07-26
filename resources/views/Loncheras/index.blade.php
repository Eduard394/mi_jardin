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
    <div class="col-12" id="lonchera">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Lonchera</h3>
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <input type="text" id="lonchera_id" style="display: none;">
                        <form id="crearLonchera">
                            <div class="col-md-12">
                                <div class="row"> 
                                    <div class="col-4">
                                        <label for="grado">Alumnos:</label>
                                        <select name="alumnos" id="alumnos" class="custom-select chosen-select form-control">
                                            <option value="NULL" > Seleccione el alumno</option>
                                            @foreach($alumnos as $alum)
                                                <option  value="{{ $alum->id }}" >{{ $alum->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="valor">Valor:</label>
                                        <input type="number" v-model="valor" id="valor" class="form-control" name="valor" placeholder="Valor de la lonchera">
                                    </div>   
                                    <div class="col-4">
                                        <label for="fecha_ingreso">Fecha de ingreso:</label>
                                        <input type="date" v-model="fecha_ingreso" id="fecha_ingreso" class="form-control" name="fecha_ingreso" placeholder="fecha_ingreso" disabled>
                                    </div>
                                    <div class="col-4">
                                        <label for="fecha_retiro">Fecha de retiro:</label>
                                        <input type="date" v-model="fecha_retiro" id="fecha_retiro" class="form-control" name="fecha_retiro" placeholder="Fecha de retiro" disabled>
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
<script src="/js/chosen.jquery.js"></script>
<script>

    var formvalid 	= true;
    var existUsu    = false;
    $(".chosen-select").chosen();

    $( document ).on( 'change', '#alumnos', function() {
        
        if ( $( '#alumnos' ).val() != "NULL" ) {

            event.preventDefault();

            const myObject = new Vue({

                created () {
                    this.getData()
                },

                methods : {

                    async getData(){

                        let data = {

                            alumno_id: $( '#alumnos' ).val(),

                        };
                        
                        const resp = await  axios.post( '/lonchera/getLonchera', data );
                        
                        if( resp.status == 200 ){
                            
                            if ( resp.data != '' ) {
                                
                                $( '#fecha_ingreso' ).prop( 'disabled', true );
                                $( '#lonchera_id' ).val( resp.data[0].id );
                                $( '#fecha_ingreso' ).val( resp.data[0].fecha_ingreso );
                                
                                if ( resp.data[0].fecha_retiro ) {
                                    $( '#fecha_retiro' ).val( resp.data[0].fecha_retiro );
                                    $( '#fecha_retiro' ).prop( 'disabled', true );
                                } else {
                                    $( '#fecha_retiro' ).val( '' );
                                    $( '#fecha_retiro' ).prop( 'disabled', false );
                                }
 
                                existUsu = true;

                            } else {

                                $( '#fecha_ingreso' ).val( '' );
                                $( '#fecha_retiro' ).val( '' );
                                $( '#lonchera_id' ).val( '' );
                                $( '#fecha_ingreso' ).prop( 'disabled', false ) ;
                                $( '#fecha_retiro' ).prop( 'disabled', true ) ;
                                existUsu = false;
                            
                            }
                            
                            
                        } else
                            toastr.error( 'Error en la busqueda' );
                        
                    }
                }
            
            })
        } else {

            $( '#fecha_ingreso' ).prop( 'disabled', true );
            $( '#fecha_retiro' ).prop( 'disabled', true );
            $( '#fecha_ingreso' ).val( '' );
            $( '#fecha_retiro' ).prop( '' );

        }
            
    })

    function saveData() {

        formvalid = true;
        formvalid = validarDatos();
        
        if ( formvalid )
            enviarDatos();
        
    } 

    function enviarDatos() {

        event.preventDefault();

        const myObject = new Vue({

            created () {
                this.getData()
            },

            methods : {

                async getData(){

                    let data = {

                        alumno_id: $( '#alumnos' ).val(),
                        valor: $( '#valor' ).val(),
                        fecha_ingreso: $( '#fecha_ingreso' ).val(),
                        fecha_retiro: $( '#fecha_retiro' ).val(),
                        lonchera_id: $( '#lonchera_id' ).val()

                    };
                    
                    const resp = await  axios.post( '/lonchera/createLonchera', data );
                    
                    if( resp.status == 200 ){
                        
                        toastr.success( 'Registro exitoso' );

                        $( '#fecha_ingreso' ).prop( 'disabled', true );
                        $( '#fecha_retiro' ).prop( 'disabled', true );
                        clearForm();
                        
                        
                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })

    }

    function validarDatos(){

        if ( $( '#alumnos' ).val() == "NULL" ) {
            formvalid = false;
            toastr.error( 'El campo alumno es obligatorio' );
        }

        if ( $( '#valor' ).val() == '' || $( '#valor' ).val() <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo valor es obligatorio y debe ser mayor a 0' );
        }

        if ( !existUsu && $( '#fecha_ingreso' ).val() == '' ) {
            formvalid = false;
            toastr.error( 'El campo fecha de ingreso es obligatorio' );
        }

        if ( existUsu && $( '#fecha_retiro' ).val() == '' ) {
            formvalid = false;
            toastr.error( 'El campo fecha de ingreso es obligatorio' );
        }

        return formvalid;

    }

    function clearForm() {

        $( '#fecha_ingreso' ).val( '' );
        $( '#fecha_retiro' ).val( '' );
        $( '#valor' ).val( '' );
        $( '#alumnos' ).val("NULL");
        $( '#alumnos' ).trigger("chosen:updated");

    }

</script>

@endsection
