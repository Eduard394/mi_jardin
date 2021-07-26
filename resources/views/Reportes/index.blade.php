@extends('adminlte::page')
@section('content')
<head>
    <link rel="stylesheet" href="/css/chosen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src='https://cdn.plot.ly/plotly-2.2.0.min.js'></script>
</head>
<body>
    <div class="col-md-12" id="contenedor" style="display: none;">
        <div class="box">
            <div class="box-body col-md-12"> 
                <div class="col-md-12" style="display: flex;">  
                    <div class="col-md-6"> 
                        <div id="discriminado-chart"></div>
                    </div>  
                    <div class="col-md-6"> 
                        <div id="bar-chart"></div>
                    </div>
                </div>
                <div class="col-md-12" style="display: flex;">  
                    <div class="col-md-6"> 
                        <div id="burbble-chart"></div>
                    </div>  
                    <div class="col-md-6"> 
                        <div id="bar-chart"></div>
                    </div>
                </div>
                <div class="col-md-12" style="display: flex;">  
                    <div class="col-md-6"> 
                        <div id="donut-chart"></div>
                    </div>
                    <div class="col-md-6"> 
                        <div id="barh-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="/js/chosen.jquery.js"></script>
<script>

    $( document ).ready( function() {

        //event.preventDefault();

        const myObject = new Vue({

            created () {
                this.getData()
            },

            methods : {

                async getData(){
                    
                    const resp = await  axios.get( '/reporte/getInfo' );
                    
                    if( resp.status == 200 ){

                        graficar( resp.data );
                        
                    } else
                        toastr.error( 'Error en la busqueda' );
                    
                }
            }
        
        })
    });

    function graficar ( data ) {

        $( '#contenedor').show();
        
        let dataX = [];
        let dataY = [];

        let xBar = [];
        let yBar = [];

        let xDon = [];
        let yDon = [];

        let xBarh = [];
        let yBarh = [];

        $.each( data.saldo_grado, function( key, value ){
            dataX.push( value.grado );
            dataY.push( value.pagos );
        });

        $.each( data.saldo[0], function( key1, value1 ){
            yBar.push( value1 );
            xBar.push( key1 );
        });

        $.each( data.cantidad_grado, function( key2, value2 ){
            xDon.push( value2.cantidad );
            yDon.push( value2.grado );
        });

        $.each( data.cantidad_jornada, function( key3, value3 ){
            xBarh.push( value3.cantidad );
            yBarh.push( value3.jornada );
        });

        var data = [{
            values: dataY,
            labels: dataX,
            type: 'pie'
        }];

        var layout = {
            title: {
                text:'Saldos por grado'
            },
            height: 400,
            width: 450
        };

        var trace1 = {
            x: xBar,
            y: yBar,
            marker:{
                color: ['rgba(204,204,204,1)', 'rgba(222,45,38,0.8)']
            },
            type: 'bar'
        };

        var dataBar = [trace1];

        var layoutBar = {
            height: 400,
            width: 450,
            title: 'Saldos'
        };

        var dataDon = [{
            values: xDon,
            labels: yDon,
            type: 'pie'
        }];

        var layoutDon = {
            title: {
                text:'Usuarios por grado'
            },
            height: 400,
            width: 450
        };

        var trace2 = {
            x: xBarh,
            y: yBarh,
            marker:{
                color: ['rgba(204,204,204,1)', 'rgba(222,45,38,0.8)']
            },
            type: 'bar',
            orientation: 'h'
        };

        var dataBarh = [trace2];

        var layoutBarh = {
            height: 400,
            width: 450,
            title: 'Usuarios por jornada'
        };

        Plotly.newPlot( 'burbble-chart', data, layout );
        Plotly.newPlot( 'bar-chart', dataBar, layoutBar );
        Plotly.newPlot( 'donut-chart', dataDon, layoutDon );
        Plotly.newPlot( 'barh-chart', dataBarh, layoutBarh );

    }

</script>

@endsection
