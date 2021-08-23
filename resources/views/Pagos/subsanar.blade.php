
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
        .col-md-4{
            margin-bottom: 1%;
        }
    </style>
    <div class="col-12">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Subsanación de pagos</h3>
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <form id="subsanar">
                            <div class="col-md-12">
                                <div class="row" >
                                    <div class="col-md-3">
                                        <label for="alumno">Alumnos:</label>
                                        <select name="alumnos" id="alumnos" class="custom-select chosen-select form-control">
                                            <option value="NULL" > Seleccione el alumno</option>
                                            @foreach($alumnos as $alum)
                                                <option  value="{{ $alum->id }}" >{{ $alum->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="item">Item:</label>
                                        <select name="item" id="item" class="custom-select form-control">
                                            <option value="NULL" > Seleccione el item</option>
                                            <option value="pension" >Pensión</option>
                                            <option value="lonchera" >Lonchera</option>
                                            <option value="matricula" >Matrícula</option>
                                            <option value="materiales" >Materiales</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="valor">Valor a subsanar:</label>
                                        <input type="number" v-model="valor" id="valor" class="form-control" name="valor" placeholder="Valor a subsanar">
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <input type="radio" id="borrar_pago" name="tipo_subsanacion" value="1" checked>
                                        <label for="borrar_pago">Borrar pago</label><br>
                                        <input type="radio" id="agregar_pago" name="tipo_subsanacion" value="2">
                                        <label for="agregar_pago">Añadir pago</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3" style="text-align: end;">
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

    var formvalid 	= true;

    function saveData() {

        $( '#esperaguardar' ).addClass( 'spinner-border spinner-border-sm mr-2' );
        $( '#guardar' ).css( 'pointer-events', 'none' );

        formvalid = true;
        formvalid = validarDatos();
        
        if( formvalid )
            enviarDatos();
        else {
            $( '#esperaguardar' ).removeClass( 'spinner-border spinner-border-sm mr-2' );
            $( '#guardar' ).css( 'pointer-events', '' );
        }
        
    } 

    function enviarDatos( datos ) {

        event.preventDefault();

        const myObject = new Vue({

            created () {
                this.save()
            },

            methods : {
                async save(){

                    let data = {

                        alumno_id: $( '#alumnos' ).val(),
                        item_id: $( '#item' ).val(),
                        valor: $( '#valor' ).val(),
                        tipo_subsanacion: $('input[name=tipo_subsanacion]:checked').val()

                    };
                    
                    const resp = await  axios.post( '/pagos/subsanar', data );
                    
                    if( resp.status == 200 ){

                        $( '#esperaguardar' ).removeClass( 'spinner-border spinner-border-sm mr-2' );
                        $( '#guardar' ).css( 'pointer-events', '' );

                        if ( resp.data.error ) {
                            toastr.error( resp.data.error );
                        } else {
                            toastr.success( 'Se ha subsanado correctamente' );
                            location.reload();
                        }

                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })
    }

    function validarDatos() {

        if ( $( '#alumnos' ).val() == "NULL" ) {
            formvalid = false;
            toastr.error( 'El campo alumno es obligatorio' );
        }

        if ( $( '#item' ).val() == "NULL" ) {
            formvalid = false;
            toastr.error( 'El campo item es obligatorio' );
        }

        if ( $( '#valor' ).val() <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo valor a subsanar debe ser mayor a 0' );
        }

        return formvalid;
    }

</script>
@endsection
