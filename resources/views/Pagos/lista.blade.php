@section('content')
@extends('adminlte::page')
<head>
    <link rel="stylesheet" href="/css/chosen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<br>
<body>
    <style>

        .col-4{
            margin-bottom: 1%;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #353a3f;
            color: white;
        }

    </style>
    <div class="col-12">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Reportes de pagos</h3>
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <form id="crearAlumno">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="alumno">Alumnos:</label>
                                        <select name="alumnos" id="alumnos" class="custom-select chosen-select form-control">
                                            <option value="NULL" >Todos</option>
                                            @foreach($alumnos as $alum)
                                                <option  value="{{ $alum->id }}" >{{ $alum->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="fecha_inicio">Fecha inicio:</label>
                                        <input type="date" v-model="fecha_inicio" id="fecha_inicio" class="form-control" name="fecha_inicio" placeholder="Fecha inicio">
                                    </div>
                                    <div class="col-4">
                                        <label for="fecha_fin">Fecha fin:</label>
                                        <input type="date" v-model="fecha_fin" id="fecha_fin" class="form-control" name="fecha_fin" placeholder="Fecha fin">
                                    </div>
                                    <div class="col-6">
                                        <br>
                                        <a onclick="getPagos()" class="btn btn-success text-white" id="consultar"><span id="esperaguardar"></span>Consultar</a>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="div_tabla" style="display: none; clear:both; margin-top:2%;">
                    <label>Total recaudado para <span id="nombre_al"></span>: $<span id="total"></span></label>
                    <div id="tabla" class="table table-condensed display">
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

    $( document ).ready(function() {

        $("#fecha_inicio").val( moment().format('YYYY-MM-DD') );
        $("#fecha_fin").val( moment().format('YYYY-MM-DD') );
                
    });

    function getPagos() {

        $( '#div_tabla' ).hide();

        const myObject = new Vue({

            created () {
                this.getData()
            },

            methods : {

                async getData(){
                    let data = {

                        alumno: $( '#alumnos' ).val(),
                        fecha_inicio: $( '#fecha_inicio' ).val(),
                        fecha_fin: $( '#fecha_fin' ).val(),

                    };
                    
                    const resp = await  axios.post( '/pagos/getPagos', data );
                    
                    if( resp.status == 200 ){

                        let data = resp.data;
                        crearTabla(data);

                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })

    }

    function crearTabla( data ){

        if ( data.total[0].sum ) {

            $( '#div_tabla' ).show();
            var html = $( '#tabla' ).html();
            html     = " ";
            $( '#nombre_al' ).text( $( '#alumnos option:selected' ).text() )
            $( '#total' ).text( commaSeparateNumber( data.total[0].sum ) )

            html    += '<table class="default" id="customers">'
                    +		'<tr>'
                    +			'<th scope="col">Alumno</th>'
                    +			'<th scope="col">Mes</th>'
                    +			'<th scope="col">Pensión</th>'
                    +			'<th scope="col">Lonchera</th>'
                    +			'<th scope="col">Matrícula</th>'
                    +			'<th scope="col">Materiales</th>'
                    +			'<th scope="col">Seguro</th>'
                    +		'</tr>';
        
            $.each( data.data, function( index, value ) {
                html 	+=	'<tr><td>'+value.nombre+'</td><td>'+value.mes_id+'</td><td>'+value.pago_pension+'</td><td>'+value.pago_lonchera+'</td><td>'+value.pago_matricula+'</td><td>'+value.pago_materiales+'</td><td>'+value.pago_seguro+'</td></tr>'
            });

            $( '#tabla' ).html( html );

        } else
            toastr.error( 'No hay datos para estas fechas' );
    }

    function commaSeparateNumber(val){
        while (/(\d+)(\d{3})/.test(val.toString())){ 
            val = val.toString().replace(/(\d+)(\d{3})/, '$1'+'.'+'$2'); 
        } return val; 
    }

</script>
@endsection
