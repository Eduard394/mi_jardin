@section('content')
@extends('adminlte::page')
<br>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
    <style>
        .col-md-12{
            margin-bottom: 5%;
        }
    </style>
    <div class="col-12" id="lonchera">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Valor lonchera</h3>
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <input type="text" id="valorlonchera_id" style="display: none;" value="{{$valor[0]->id}}">
                        <form id="crearValorLonchera">
                            <div class="col-md-12">
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <label for="grado">Valor de la lonchera:</label>
                                        <input type="number" v-model="valor" id="valor" class="form-control" name="valor"  placeholder="Valor" value="{{$valor[0]->valor_lonchera}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
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
<script>

    
    var formvalid 	= true;

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

                        valor_id: $( '#valorlonchera_id' ).val(),
                        valor: $( '#valor' ).val()

                    };
                    
                    const resp = await  axios.post( '/valor/updateValor', data );
                    
                    if( resp.status == 200 ){
                        
                        toastr.success( 'Actualización exitosa' );
                        
                    } else
                        toastr.error( 'Error actualizando' );
                    
                }
            }
        
        })

    }

    function validarDatos(){

        if ( $( '#valor' ).val() <= 0 || $( '#valor' ).val() == '' ) {
            formvalid = false;
            toastr.error( 'El campo valor lonchera es obligatorio' );
        }

        return formvalid;

    }

    function clearForm () {
        $( '#valor' ).val('');
    }

</script>

@endsection
