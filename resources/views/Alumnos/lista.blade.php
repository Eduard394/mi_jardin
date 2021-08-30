@section('content')
@extends('adminlte::page')
<head>
    <link rel="stylesheet" href="/css/chosen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
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
