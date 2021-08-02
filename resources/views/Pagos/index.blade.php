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

        .alert-mensaje {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        .alert-mensaje {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        .alert-descuento {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

    </style>
    <div class="col-12" id="lonchera">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Pagos</h3>
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <form id="crearLonchera">
                            <div class="col-md-12">
                                <div class="row"> 
                                    <div class="col-4">
                                        <label for="alumno">Alumnos:</label>
                                        <select name="alumnos" id="alumnos" class="custom-select chosen-select form-control">
                                            <option value="NULL" > Seleccione el alumno</option>
                                            @foreach($alumnos as $alum)
                                                <option  value="{{ $alum->id }}" >{{ $alum->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="mes">Mes:</label>
                                        <select name="mes" id="mes" class="custom-select chosen-select form-control">
                                            <option value="NULL" > Seleccione el mes a pagar</option>
                                            @foreach($meses as $mes)
                                                <option  value="{{ $mes->id }}" >{{ $mes->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="year">Año:</label>
                                        <select name="year" id="year" class="custom-select form-control">
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="fecha_pago">Fecha de pago:</label>
                                        <input type="date" v-model="fecha_pago" id="fecha_pago" class="form-control" name="fecha_pago" placeholder="Fecha de pago">
                                    </div>
                                    <div class="col-md-4" style="margin-top: 3.3%;">
                                        <a onclick="mesAlumno()" class="btn btn-primary text-white" id="btCalcular"><span id="espera"></span>Calcular pago</a>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-md-12 alert alert-descuento" role="alert" style="text-align: end; display: none; margin-top:1%; margin-bottom:1%;"></div>
                                    <div class="col-md-12 alert alert-mensaje" role="alert" style="text-align: end; display: none; margin-top:1%; margin-bottom:1%;"></div>
                                    <div id="div_matricula" class="col-12" style="display: none;">
                                        <div style="display: flex;">
                                            <div class="col-4">
                                                <label for="d_matricula">Deuda matricula:</label>
                                                <input type="number" v-model="d_matricula" id="d_matricula" class="form-control" name="d_matricula" placeholder="Deuda" value="0" disabled>
                                            </div>  
                                            <div class="col-4">
                                                <label for="p_matricula">Pago:</label>
                                                <input type="number" v-model="p_matricula" id="p_matricula" class="form-control" name="p_matricula" placeholder="Valor a pagar" value="0">
                                            </div>
                                            <div class="col-4"></div>
                                        </div>
                                    </div>
                                    <div id="div_pension" class="col-12" style="display: none;">
                                        <div style="display: flex;">
                                            <div class="col-4">
                                                <label for="d_pension">Deuda pensión:</label>
                                                <input type="number" v-model="d_pension" id="d_pension" class="form-control" name="d_pension" placeholder="Deuda" value="0" disabled>
                                            </div>  
                                            <div class="col-4">
                                                <label for="p_pension">Pago:</label>
                                                <input type="number" v-model="p_pension" id="p_pension" class="form-control" name="p_pension" placeholder="Valor a pagar" value="0">
                                            </div>  
                                            <div class="col-4"></div>
                                        </div>
                                    </div>
                                    <div  id="div_lonchera" class="col-12" style="display: none;">
                                        <div style="display: flex;">
                                            <div class="col-4">
                                                <label for="d_lonchera">Deuda lonchera:</label>
                                                <input type="number" v-model="d_lonchera" id="d_lonchera" class="form-control" name="d_lonchera" placeholder="Deuda" value="0" disabled>
                                            </div>  
                                            <div class="col-4">
                                                <label for="p_lonchera">Pago:</label>
                                                <input type="number" v-model="p_lonchera" id="p_lonchera" class="form-control" name="p_lonchera" placeholder="Valor a pagar" value="0">
                                            </div>  
                                            <div class="col-4"></div>
                                        </div>
                                    </div>
                                    <div id="div_seguro" class="col-12" style="display: none;">
                                        <div style="display: flex;">
                                            <div class="col-4">
                                                <label for="d_seguro">Deuda seguro:</label>
                                                <input type="number" v-model="d_seguro" id="d_seguro" class="form-control" name="d_seguro" placeholder="Deuda" value="0" disabled>
                                            </div>  
                                            <div class="col-4">
                                                <label for="p_seguro">Pago:</label>
                                                <input type="number" v-model="p_seguro" id="p_seguro" class="form-control" name="p_seguro" placeholder="Valor a pagar" value="0">
                                            </div>  
                                            <div class="col-4"></div>
                                        </div>
                                    </div>
                                    <div id="div_materiales" class="col-12" style="display: none;">
                                        <div style="display: flex;">
                                            <div class="col-4">
                                                <label for="d_materiales">Deuda materiales:</label>
                                                <input type="number" v-model="d_materiales" id="d_materiales" class="form-control" name="d_materiales" placeholder="Deuda" value="0" disabled>
                                            </div>  
                                            <div class="col-4">
                                                <label for="p_materiales">Pago:</label>
                                                <input type="number" v-model="p_materiales" id="p_materiales" class="form-control" name="p_materiales" placeholder="Valor a pagar" value="0">
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 alert alert-danger" role="alert" style="text-align: end; display: none; margin-top:1%; margin-bottom:1%;">
                            </div>
                            <div class="col-md-12 div_btns" style="text-align: end; display: none;">
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

    var formvalid 	= true;
    var existUsu    = false;
    var today       = new Date();
    var year        = today.getFullYear();
    var day         = today.getDate();
    var month       = today.getMonth();
    var fMat        = false;
    var fPen        = false;
    var fHer        = false;
    var fechaActual;

    $(".chosen-select").chosen();

    $( document ).ready( function() {

        var ano = parseInt(year);

        let anoAnt = ano - 1;
        let anoSig = ano + 1;
        let html =  '<option  value="'+anoAnt+'" >'+anoAnt+'</option>'
                    +'<option  value="'+ano+'" selected>'+ano+'</option>'
                    +'<option  value="'+anoSig+'" >'+anoSig+'</option>'
        
        $( '#year' ).append(html);

        month = getMes( month );

        if ( day <= 9 ) {
            day = '0' + day;
        }

        fechaActual = year + '-' + 0 + parseInt( month ) + '-' + day;

        $( '#fecha_pago' ).val( fechaActual );

    });



    function mesAlumno() {

        formvalid = true;
        formvalid = validarDatos();
        
        if ( formvalid )   {

            $( '#espera' ).addClass( 'spinner-border spinner-border-sm mr-2' );
            $( '#btCalcular' ).css( 'pointer-events', 'none' );
            

            event.preventDefault();

            const myObject = new Vue({

                created () {
                    this.getData()
                },

                methods : {

                    async getData(){

                        let data = {

                            alumno_id: $( '#alumnos' ).val(),
                            mes_id: $( '#mes' ).val(),
                            year_id: $( '#year' ).val(),
                            fecha_pago: $( '#fecha_pago' ).val(),

                        };
                        
                        const resp = await  axios.post( '/pagos/validarMes', data );
                        
                        if( resp.status == 200 ){

                            $( '#espera' ).removeClass( 'spinner-border spinner-border-sm mr-2' );
                            $( '#btCalcular' ).prop( 'disabled', false );
                            $( '#btCalcular' ).css( 'pointer-events', '' );


                            callbackValidate(resp.data);
                            
                        } else
                            toastr.error( 'Error en la busqueda' );
                        
                    }
                }
            
            })
        }
            
    }

    function callbackValidate( data ) {

        $( '.alert-descuento' ).hide();
        $( '.alert-mensaje' ).hide();

        fMat      = false;
        fPen      = false;
        fHer      = false;

        if ( data[ 'return' ] ) {
            
            $( '.alert-danger' ).show();
            $( '.alert-danger' ).text( data[ 'return' ] );
            ocultarDiv();

        } else {
            
            datos  = data.deudas[0];
            datosI = data.items[0];
            $( '.alert-danger' ).hide();
            $( '.alert-danger' ).text( '' );

            if ( datos.deuda > 0 ) {

                let fecha           = new Date( $( '#fecha_pago' ).val() );
                let manana          = new Date( fecha );
                manana.setDate( fecha.getDate() + 1 );
                let diaPago         = manana.getDate();
                let mesPago         = manana.getMonth() + 1;
                let desctPension    = false;
                let descHermano     = false;
                let valorDesc       = 0;
                let valorDescMat    = 0;
                let mensaje         = '';
                mensaje             += 'Se aplicó descuento a ';
                let mensaje2        = '';

                $( '.div_btns' ).show();

                if ( mesPago == $( '#mes' ).val() && diaPago < 6 && datos.descuento ){

                    mensaje += 'pensión ';
                    mensaje2 += 'pensión ';

                    if ( datos.hermano ) {
                        valorDesc = datosI.desc_hermano;
                        fHer = true;
                    }
                    else {
                        valorDesc = datosI.desc_pension;
                        fPen = true;
                    }

                }

                if ( mesPago < $( '#mes' ).val() && datos.descuento  ){

                    mensaje += 'pensión ';
                    mensaje2 += 'pensión ';

                    if ( datos.hermano ){
                        valorDesc = datosI.desc_hermano;
                        fHer = true;
                    }
                    else {
                        valorDesc = datosI.desc_pension;
                        fPen = true;
                    }

                }

                if ( $( '#fecha_pago' ).val() < '2021-07-10' ) {

                    valorDescMat = datosI.desc_matricula;
                    mensaje += ( valorDesc > 0 ) ? 'y matrícula ' : 'matrícula ';
                    mensaje2 += ( valorDesc > 0 ) ? 'y matrícula ' : 'matrícula ';
                    fMat = true;

                }

                if ( ( valorDesc > 0 || valorDescMat > 0 ) && ( datos.deuda_matricula > 0 || datos.deuda_pension > 0 ) ){
                    
                    mensaje += 'por pronto pago.';

                    $( '.alert-descuento' ).show();
                    $( '.alert-descuento' ).text( mensaje );
                    $( '.alert-mensaje' ).show();
                    $( '.alert-mensaje' ).text( '¡Importante! el descuento se aplicará solo si se realiza la totalidad del pago de ' + mensaje2 );

                }
                
                if ( datos.deuda_matricula > 0 ) {

                    $( '#div_matricula' ).show();
                    $( '#d_matricula' ).val( ( datos.deuda_matricula - valorDescMat ) );

                } else {

                    $( '#div_matricula' ).hide();

                }

                if ( datos.deuda_pension > 0 ) {

                    $( '#d_pension' ).val( datos.deuda_pension - valorDesc );
                    $( '#div_pension' ).show();
                    

                } else {

                    $( '#div_pension' ).hide();

                }

                if ( datos.deuda_lonchera > 0 ) {

                    $( '#div_lonchera' ).show();
                    $( '#d_lonchera' ).val( datos.deuda_lonchera );

                } else {

                    $( '#div_lonchera' ).hide();

                }

                if ( datos.deuda_seguro > 0 ) {

                    $( '#div_seguro' ).show();
                    $( '#d_seguro' ).val( datos.deuda_seguro );

                } else {

                    $( '#div_seguro' ).hide();

                }

                if ( datos.deuda_materiales > 0 ) {

                    $( '#div_materiales' ).show();
                    $( '#d_materiales' ).val( datos.deuda_materiales );

                } else {

                    $( '#div_materiales' ).hide();

                }

            } else {

                $( '.alert-danger' ).show();
                $( '.alert-danger' ).text( 'El pago de este mes ya ha sido realizado' );
                ocultarDiv();

            }

        }


    }

    function saveData() {

        $( '#esperaguardar' ).addClass( 'spinner-border spinner-border-sm mr-2' );
        $( '#guardar' ).css( 'pointer-events', 'none' );

        formvalid = true;
        formvalid = validarDatosPago();
        
        if ( formvalid )
            enviarDatos();
        else {
            $( '#esperaguardar' ).removeClass( 'spinner-border spinner-border-sm mr-2' );
            $( '#btCalcular' ).css( 'pointer-events', '' );
        }
        
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
                        mes_id: $( '#mes' ).val(),
                        year: $( '#year' ).val(),
                        fecha_pago: $( '#fecha_pago' ).val(),
                        p_matricula: $( '#p_matricula' ).val(),
                        p_pension: $( '#p_pension' ).val(),
                        p_lonchera: $( '#p_lonchera' ).val(),
                        p_seguro: $( '#p_seguro' ).val(),
                        p_materiales: $( '#p_materiales' ).val(),
                        v_matricula: $( '#d_matricula' ).val(),
                        v_pension: $( '#d_pension' ).val(),
                        fMat: fMat,
                        fPen: fPen,
                        fHer: fHer

                    };
                    
                    const resp = await  axios.post( '/pagos/createPago', data );
                    
                    if( resp.status == 200 ){
                        
                        toastr.success( 'Pago exitoso' );
                        $( '#esperaguardar' ).removeClass( 'spinner-border spinner-border-sm mr-2' );
                        $( '#btCalcular' ).css( 'pointer-events', '' );
                        location.reload();
                        
                    } else
                        toastr.error( 'Error en el pago' );
                    
                }
            }
        
        })

    }

    function validarDatos(){

        if ( $( '#mes' ).val() == "NULL" ) {
            formvalid = false;
            toastr.error( 'El campo mes es obligatorio' );
        }

        if ( $( '#alumnos' ).val() == "NULL" ) {
            formvalid = false;
            toastr.error( 'El campo alumno es obligatorio' );
        }

        if ( $( '#pago' ).val() == '' || $( '#pago' ).val() <= 0  ) {
            formvalid = false;
            toastr.error( 'El campo pago es obligatorio y debe ser mayor a 0' );
        }

        if ( $( '#fecha_pago' ).val().length <= 0 ) { 
            formvalid = false;
            toastr.error( 'El campo fecha de pago es obligatorio' );
        }

        return formvalid;

    }

    function validarDatosPago(){

        if ( parseInt( $( '#d_matricula' ).val() ) < parseInt( $( '#p_matricula' ).val() ) ) {
            formvalid = false;
            toastr.error( 'El pago de matrícula no debe se mayor a la deuda' );
        }

        if ( parseInt( $( '#d_pension' ).val() ) < parseInt( $( '#p_pension' ).val() ) ) {
            formvalid = false;
            toastr.error( 'El pago de pensión no debe se mayor a la deuda' );
        }

        if ( parseInt( $( '#d_lonchera' ).val() ) < parseInt( $( '#p_lonchera' ).val() ) ) {
            formvalid = false;
            toastr.error( 'El pago de lonchera no debe se mayor a la deuda' );
        }

        if ( parseInt( $( '#d_seguro' ).val() ) < parseInt( $( '#p_seguro' ).val() ) ) {
            formvalid = false;
            toastr.error( 'El pago del seguro no debe se mayor a la deuda' );
        }

        if ( parseInt( $( '#d_materiales' ).val() ) < parseInt( $( '#p_materiales' ).val() ) ) {
            formvalid = false;
            toastr.error( 'El pago de materiales no debe se mayor a la deuda' );
        }

        return formvalid;

    }

    function clearForm() {

        $( '#pago' ).val( '' );
        $('#alumnos').children('option').first().prop('selected', true)
        $('#alumnos').trigger("chosen:updated");
        $( '#mes' ).val("NULL").trigger("chosen:updated");

    }

    function getMes( mes ) {

        if ( mes < 9 ) 
            return 0 + ( parseInt( mes ) + 1 );
        else 
            return ( parseInt( mes ) + 1 );
        
    }

    function ocultarDiv() {

        $( '#div_matricula' ).hide();
        $( '#div_pension' ).hide();
        $( '#div_lonchera' ).hide();
        $( '#div_seguro' ).hide();
        $( '#div_materiales' ).hide();
        $( '.div_btns' ).hide();

    }

    $( document ).on( 'change', '#mes', function() {
        ocultarDiv();
        $( '.alert-descuento' ).hide();
        $( '.alert-mensaje' ).hide();
    });

    $( document ).on( 'change', '#alumnos', function() {
        ocultarDiv();
        $( '.alert-descuento' ).hide();
        $( '.alert-mensaje' ).hide();
    });

    $( document ).on( 'change', '#year', function() {
        ocultarDiv();
        $( '.alert-descuento' ).hide();
        $( '.alert-mensaje' ).hide();
    });

    $( document ).on( 'change', '#fecha_pago', function() {
        ocultarDiv();
        $( '.alert-descuento' ).hide();
        $( '.alert-mensaje' ).hide();
    });

    

</script>

@endsection
