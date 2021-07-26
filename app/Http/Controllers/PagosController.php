<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MesCobrado;

class PagosController extends Controller
{

    private $pagos;
    private $mesCobrado;
    private $alumno;

    public function __construct(Pagos $pagos)
    {
        $this->pagos     = new Pagos();
        $this->mesCobrado  = new MesCobrado();
        $this->alumno       = new Alumnos();
        //$this->middleware('auth');
    }
    
    public function index(){

        $hoy = date("Y-m-d");  

        $alumnos = DB::table( 'alumnos as a' )
                    ->select( 'a.id', 'a.nombre' )->orderBy( 'a.nombre', 'ASC' )
                    ->where( 'fecha_retiro', '>', $hoy )
                    ->get();

        $meses = DB::table( 'mes as m')
                    ->select( 'm.id', 'm.nombre' )
                    ->get();

    	return view( 'Pagos.index', compact('alumnos', 'meses') );

    }

    public function validarMes ( Request $request ) {

        $data = $request->all();

        $ultimoMes = DB::table( 'mes_cobrados as m' )
                    ->select( 'm.id', 'm.mes_id', 'm.year' )
                    ->where( 'm.alumno_id', $data[ 'alumno_id'] )
                    ->orderBy( 'm.id', 'desc' )
                    ->limit( 1 )
                    ->get();
        
        $items = DB::table( 'items as i' )
                    ->select( '*' )
                    ->get();

        if ( $data[ 'year_id' ] == $ultimoMes[0]->year ) {

            if ( $data[ 'mes_id' ] == $ultimoMes[0]->mes_id ) {

                $datos['deudas'] = $this->getDeudas( $data[ 'alumno_id' ] );
                $datos['items']  = $items;
                return $datos;

            } else if ( ( $data[ 'mes_id' ] - $ultimoMes[0]->mes_id ) == 1 ) {

                $deuda = $this->getDeudas( $data[ 'alumno_id' ] );

                if ( $deuda[0]->deuda_pension > 0 || $deuda[0]->deuda_lonchera > 0 ) {

                    $retorno['return'] = 'Para realizar el pago de este mes debe cancelar el mes de ' . $this->getMes( $ultimoMes[0]->mes_id );
                    return $retorno;

                } else {

                    $this->mesCobrado->crear( $data[ 'alumno_id' ], $data[ 'mes_id' ], $data[ 'year' ] );
                    $deuda[0]->deuda = $deuda[0]->deuda + $deuda[0]->lonchera_valor + $deuda[0]->pension;
                    $this->alumno->editarDeuda( $deuda );

                    $datos['deudas'] = $this->getDeudas( $data[ 'alumno_id' ] );
                    $datos['items']  = $items;
                    return $datos;

                }

            } else if ( ( $data[ 'mes_id' ] - $ultimoMes[0]->mes_id ) > 1 ) {

                $retorno['return'] = 'No puede realizar el pago de este mes ya que tiene pagos pendientes del mes de ' . $this->getMes( $ultimoMes[0]->mes_id + 1 );
                return $retorno;

            } else if ( ( $data[ 'mes_id' ] - $ultimoMes[0]->mes_id ) < 0 ) {

                $retorno['return'] = 'El pago de este mes ya ha sido realizado';
                return $retorno;

            }
            
        } else if ( $data[ 'year_id' ] > $ultimoMes[0]->year ) {

            $mes = ( $data[ 'mes_id' ] + 12 );

            if ( ( $mes - $ultimoMes[0]->mes_id ) == 1 ) {

                $deuda = $this->getDeudas( $data[ 'alumno_id' ] );

                if ( $deuda[0]->deuda_pension > 0 || $deuda[0]->deuda_lonchera > 0 ) {

                    $retorno['return'] = 'Para realizar el pago de este mes debe cancelar el mes de ' . $this->getMes( $ultimoMes[0]->mes_id ) . ' del ' . $ultimoMes[0]->year;
                    return $retorno;

                } else {

                    $this->mesCobrado->crear( $data[ 'alumno_id' ], $data[ 'mes_id' ], $data[ 'year' ] );
                    $deuda[0]->deuda = $deuda[0]->deuda + $deuda[0]->lonchera_valor + $deuda[0]->pension;
                    $this->alumno->editarDeuda( $deuda );

                    $datos['deudas'] = $this->getDeudas( $data[ 'alumno_id' ] );
                    $datos['items']  = $items;
                    return $datos;

                }

            } else if ( ( $mes - $ultimoMes[0]->mes_id ) > 1 ) {

                $retorno['return'] = 'No puede realizar el pago de este mes ya que tiene pagos pendientes del mes de ' . $this->getMes( $ultimoMes[0]->mes_id + 1 ) . ' del ' . $ultimoMes[0]->year;
                return $retorno;

            }

        } else if ( $data[ 'year_id' ] < $ultimoMes[0]->year ) {

            $retorno['return'] = 'El pago de este mes ya ha sido realizado';
            return $retorno;

        }

    }

    public function createPago ( Request $request ) {

        $data = $request->all();

        $result = $this->pagos->crear( $data );

        if ( $result ) {

            $deuda = DB::table( 'alumnos as a' )
                    ->select( 'a.deuda' )
                    ->where( 'a.id', $data[ 'alumno_id' ] )
                    ->get();

            $data['deuda'] = $deuda[0]->deuda - $data[ 'pago' ];
            
            return $this->alumno->editarDeuda( $data );

        }

    }

    public function getDeudas( $alumnoId ) {

        $deuda = DB::table( 'alumnos as a' )
                    ->select( '*' )
                    ->where( 'a.id', $alumnoId)
                    ->get();

        return $deuda;

    }

    public function getMes( $mesId ) {

        switch( $mesId ) {

            case 1: return 'enero'; break;
            case 2: return 'febrero'; break;
            case 3: return 'marzo'; break;
            case 4: return 'abril'; break;
            case 5: return 'mayo'; break;
            case 6: return 'junio'; break;
            case 7: return 'julio'; break;
            case 8: return 'agosto'; break;
            case 9: return 'septiembre'; break;
            case 10: return 'octubre'; break;
            case 11: return 'noviembre'; break;
            case 12: return 'diciembre'; break;

        }

    }

}
