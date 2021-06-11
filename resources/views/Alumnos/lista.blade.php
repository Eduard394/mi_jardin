@section('content')
@extends('adminlte::page')
<br>
<body>
  <div class="col-sm-12">

  <div class="col-md-12" style="text-align: end;">
      <a href="/alumno" class="btn btn-success text-white btn-md">Crear nuevo alumno</a>
  </div>
  <div id="app">
    <all-alumnos></all-alumnos>
  </div>
  </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
@endsection
