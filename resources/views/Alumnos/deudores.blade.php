
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
            background-color: #04AA6D;
            color: white;
        }
        
    </style>
    <div class="col-12" id="alumnos">
        <div class="flex">
            <div class="box col-12">
                <div class="box-header with-border">
                    <h3 class="box-title text-black">Deudores</h3>
                </div>
                <div class="alert" role="alert" style="color: #004085; background-color: #cce5ff; border-color: #b8daff;">
                    En el listado se encuentran los alumnos con deudas hasta el mes actual.
                </div>
                <div class="box-body col-md-12">
                    <div class="row">
                        <form id="crearAlumno">
                        <button type="submit" onclick="window.print();return false;" class="btn bg-green" style="margin-bottom: 2%;">Imprimir</button>
                            <div class="col-md-12">
                                <table class="default" id="customers">
                                <tr>
                                    <th>Alumno</th>
                                    <th>Pension</th>
                                    <th>Lonchera</th>
                                    <th>Matrícula</th>
                                    <th>Materiales</th>
                                    <th>Seguro</th>
                                    <th>Total</th>
                                </tr>
                                @foreach($alumnos as $alumno)
                                    <tr>
                                        <td>{{ $alumno->nombre }}</td>
                                        <td>{{ $alumno->deuda_pension }}</td>
                                        <td>{{ $alumno->deuda_lonchera }}</td>
                                        <td>{{ $alumno->deuda_matricula }}</td>
                                        <td>{{ $alumno->deuda_materiales }}</td>
                                        <td>{{ $alumno->deuda_seguro }}</td>
                                        <td>{{ $alumno->deuda }}</td>
                                    </tr>
                                @endforeach
                                </table><br><br>
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

    $( document ).ready(function(){
        
        //getDeudores();

    });

    function getDeudores() {

        const myObject = new Vue({

            created () {
                this.getData()
            },

            methods : {

                async getData(){
                    
                    const resp = await  axios.get( '/alumno/getDeudores' );
                    
                    if( resp.status == 200 ){

                        let data = resp.data;
                        console.log(resp)
                        
                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })

    }




</script>
@endsection
