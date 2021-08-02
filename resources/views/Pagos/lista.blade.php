@section('content')
@extends('adminlte::page')
<br>
<body>
  <div class="col-sm-12">

  <div class="col-md-12" style="text-align: end;">
      <a href="/pagos" class="btn btn-success text-white btn-md">Realizar pago</a>
  </div>
  <div id="app">
    <all-pagos></all-pagos>
  </div>
  </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
@endsection
