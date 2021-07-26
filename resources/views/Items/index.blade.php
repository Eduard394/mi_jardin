
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
    <div class="col-12" id="alumnos">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Configuración de items</h3>
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <input type="text" id="item_id" style="display: none;" value="{{$items[0]->id}}">
                        <form id="editarItems">
                            <div class="col-md-12">
                                <div class="row" >
                                    <div class="col-md-4">
                                        <label for="matricula">Matrícula:</label>
                                        <input type="number" v-model="matricula" id="matricula" class="form-control" name="matricula" value="{{$items[0]->matricula}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="lonchera">Lonchera:</label>
                                        <input type="number" v-model="lonchera" id="lonchera" class="form-control" name="lonchera" value="{{$items[0]->lonchera}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="pension">Pensión:</label>
                                        <input type="number" v-model="pension" id="pension" class="form-control" name="pension" value="{{$items[0]->pension}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="seguro">Seguro:</label>
                                        <input type="number" v-model="seguro" id="seguro" class="form-control" name="seguro" value="{{$items[0]->seguro}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="materiales">Materiales:</label>
                                        <input type="number" v-model="materiales" id="materiales" class="form-control" name="materiales" value="{{$items[0]->materiales}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="culminacion">Culminacion de año</label>
                                        <input type="date" v-model="culminacion" id="culminacion" class="form-control" name="culminacion" value="{{$items[0]->culminacion}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="desc_matricula">Descuento de matrícula</label>
                                        <input type="number" v-model="desc_matricula" id="desc_matricula" class="form-control" name="desc_matricula" value="{{$items[0]->desc_matricula}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="desc_pension">Descuento de pensión:</label>
                                        <input type="number" v-model="desc_pension" id="desc_pension" class="form-control" name="desc_pension" value="{{$items[0]->desc_pension}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="desc_hermano">Descuento de hermano:</label>
                                        <input type="number" v-model="desc_hermano" id="desc_hermano" class="form-control" name="desc_hermano" value="{{$items[0]->desc_hermano}}">
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

    $(".chosen-select").chosen();

    var formvalid 	= true;

    function saveData() {

        formvalid = true;
        formvalid = validarDatos();
        
        if( formvalid )
            enviarDatos();
        else 
            validarDatos();
        
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

                        id: $( '#item_id' ).val(),
                        matricula: $( '#matricula' ).val(),
                        lonchera: $( '#lonchera' ).val(),
                        pension: $( '#pension' ).val(),
                        seguro: $( '#seguro' ).val(),
                        materiales: $( '#materiales' ).val(),
                        culminacion: $( '#culminacion' ).val(),
                        desc_matricula: $( '#desc_matricula' ).val(),
                        desc_pension: $( '#desc_pension' ).val(),
                        desc_hermano: $( '#desc_hermano' ).val()

                    };
                    
                    const resp = await  axios.post( '/item/actualizar', data );
                    
                    if( resp.status == 200 ){
                        
                        toastr.success( 'Items actualizado exitosamente' );

                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })
    }

    function validarDatos() {

        if ( $( '#matricula' ).val() <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo matrícula debe ser mayor a cero' );
        }

        if ( $( '#lonchera' ).val() <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo lonchera debe ser mayor a cero' );
        }

        if ( $( '#pension' ).val() <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo pensión debe ser mayor a cero' );
        }

        if ( $( '#seguro' ).val() <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo seguro debe ser mayor a cero' );
        }

        if ( $( '#materiales' ).val() <= 0 ) { 
            formvalid = false;
            toastr.error( 'El campo materiales debe ser mayor a cero' );
        }

        if ( $( '#culminacion' ).val().length <= 0 ) {
            formvalid = false;
            toastr.error( 'El campo culminación año es obligatorio' );
        }

        if ( $( '#desc_matricula' ).val() < 0 ) {
            formvalid = false;
            toastr.error( 'El campo descuento de matrícula no puede ser negativo' );
        }

        if ( $( '#desc_pension' ).val() < 0 ) {
            formvalid = false;
            toastr.error( 'El campo descuento de pensión no puede ser negativo' );
        }

        if ( $( '#desc_hermano' ).val() < 0 ) {
            formvalid = false;
            toastr.error( 'El campo descuento de hermano no puede ser negativo' );
        }

        return formvalid;
    }

</script>
@endsection
