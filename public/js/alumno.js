// var formvalid 	= true;

// function saveData() {

//     formvalid = true;
//     formvalid = validarDatos();
    
//     if( formvalid ){

//         enviarDatos();

//     } else {
//         validarDatos();
//     }
// } 

// function enviarDatos( datos ) {

//     event.preventDefault();

//     const myObject = new Vue({

//         created () {
//             this.save()
//         },

//         methods : {
//             async save(){

//                 let data = {

//                     nombre: $( '#nombre' ).val(),
//                     codigo: $( '#codigo' ).val(),
//                     periodo_entrada: $( '#periodo_entrada' ).val(),
//                     periodo_salida: $( '#periodo_salida' ).val(),
//                     matricula: $( '#matricula' ).val(),
//                     materiales: $( '#materiales' ).val(),
//                     jornada: $( '#jornada' ).val(),
//                     fecha_ingreso: $( '#fecha_ingreso' ).val(),
//                     fecha_retiro: $( '#fecha_retiro' ).val(),
//                     pension: $( '#pension' ).val(),
//                     seguro: $( '#seguro' ).val(),
//                     grado: $( '#grado' ).val(),
//                     acudiente: $( '#acudiente' ).val(),
//                     telefono: $( '#telefono' ).val()

//                 };
                
//                 const resp = await  axios.post( '/alumno/crear', data );
                
//                 if( resp.status == 200 ){
                    
//                     toastr.success( 'Alumno creado exitosamente' );
//                     $( "#crearAlumno" )[0].reset();

//                 } else
//                     toastr.error( 'Error en la busqueda' );
                
//             }
//         }
    
//     })
// }

// function validarDatos() {

//     if ( $( '#nombre' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo nombre es obligatorio' );
//     }

//     if ( $( '#codigo' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo código es obligatorio' );
//     }

//     if ( $( '#periodo_entrada' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo periodo de entrada es obligatorio' );
//     }

//     if ( $( '#periodo_salida' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo periodo de salida es obligatorio' );
//     }

//     if ( $( '#matricula' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo matricula es obligatorio' );
//     }

//     if ( $( '#jornada' ).val().length == "NULL" ) {
//         formvalid = false;
//         toastr.error( 'El campo jornada es obligatorio' );
//     }

//     if ( $( '#fecha_ingreso' ).val().length <= 0 ) { 
//         formvalid = false;
//         toastr.error( 'El campo fecha de ingreso es obligatorio' );
//     }

//     if ( $( '#pension' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo pensión es obligatorio' );
//     }

//     if ( $( '#seguro' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo seguro es obligatorio' );
//     }

//     if ( $( '#grado' ).val().length == "NULL" ) {
//         formvalid = false;
//         toastr.error( 'El campo grado es obligatorio' );
//     }

//     if ( $( '#acudiente' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo nombre acudiente es obligatorio' );
//     }

//     if ( $( '#telefono' ).val().length <= 0 ) {
//         formvalid = false;
//         toastr.error( 'El campo teléfono es obligatorio' );
//     }

//     return formvalid;
// }