
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
                                    <div id="divRadio" class="col-md-3">
                                        <label for="item">Tipo de subsanación:</label><br>
                                        <input type="radio" id="borrar_deuda" name="tipo_subsanacion" value="1" disabled>
                                        <label for="borrar_deuda">Borrar deuda</label><br>
                                        <input type="radio" id="agregar_deuda" name="tipo_subsanacion" value="2" disabled>
                                        <label for="agregar_deuda">Añadir deuda</label><br>
                                        <input type="radio" id="reversar_pago" name="tipo_subsanacion" value="3" style="margin-left: 3.5%;" disabled>
                                        <label for="reversar_pago">Reversar pago</label>
                                    </div>
                                    <div id="divValor" class="col-md-3">
                                        <label for="valor">Valor a subsanar:</label>
                                        <input type="number" v-model="valor" id="valor" class="form-control" name="valor" placeholder="Valor a subsanar" disabled>
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

    var formvalid 	 = true;
    var ultimoPagoId = 0;

    function saveData() {

        $( '#esperaguardar' ).addClass( 'spinner-border spinner-border-sm mr-2' );
        $( '#guardar' ).css( 'pointer-events', 'none' );

        formvalid = true;
        formvalid = validarDatos();
        
        if( formvalid ) {
            enviarDatos();
        }
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
                        tipo_subsanacion: $('input[name=tipo_subsanacion]:checked').val(),
                        ultimo_pago: ultimoPagoId

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

        if ( $('input[name=tipo_subsanacion]:checked').val() == undefined ) {
            formvalid = false;
            toastr.error( 'Debe seleccionar un tipo de subsanación' );
        }

        return formvalid;
    }

    $( document ).on( 'change', '#item, #alumnos', function() {

        $( '#valor' ).val( '' );
        $( '#borrar_deuda' ).prop("checked", false);
        $( '#agregar_deuda' ).prop("checked", false);
        $( '#reversar_pago' ).prop("checked", false);
        ultimoPagoId = 0;

        if ( $( '#item' ).val() != 'NULL' && $( '#alumnos' ).val() != 'NULL' ){
            $( '#borrar_deuda' ).prop("disabled", false);
            $( '#agregar_deuda' ).prop("disabled", false);
            $( '#reversar_pago' ).prop("disabled", false);
        } else {
            $( '#borrar_deuda' ).prop("disabled", true);
            $( '#agregar_deuda' ).prop("disabled", true);
            $( '#reversar_pago' ).prop("disabled", true);
            $( '#valor' ).prop("disabled", true);
        }

    });

    $('input[type=radio][name=tipo_subsanacion]').change(function() {
        
        if ( $('input[name=tipo_subsanacion]:checked').val() == 1 || $('input[name=tipo_subsanacion]:checked').val() == 2 ){

            $( '#valor' ).prop("disabled", false);
            $( '#valor' ).val( '' );
            ultimoPagoId = 0;

        } else if ( $('input[name=tipo_subsanacion]:checked').val() == 3 ) {

            $( '#valor' ).prop("disabled", true);

            const myObject = new Vue({

                created () {
                    this.save()
                },

                methods : {
                    async save(){

                        let data = {

                            alumno_id: $( '#alumnos' ).val(),
                            item_id: $( '#item' ).val()

                        };
                        
                        const resp = await  axios.post( '/pagos/getUltimoPago', data );
                        
                        if( resp.status == 200 ){

                            let data = resp.data;
                            $( '#valor' ).val(data[0]['pago_'+$( '#item' ).val()]);
                            ultimoPagoId = data[0]['id'];

                        } else
                            toastr.error( 'Error en la busqueda' );
                        
                    }
                }
        
            })
            
        }

    });

</script>
@endsection
