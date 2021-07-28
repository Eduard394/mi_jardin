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
        
        $items = $this->getItems();

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

                    $this->mesCobrado->crear( $data[ 'alumno_id' ], $data[ 'mes_id' ], $data[ 'year_id' ] );
                    
                    $deuda[0]->deuda = $deuda[0]->deuda + $deuda[0]->lonchera_valor + $deuda[0]->pension;
                    $this->alumno->actualizarDeuda( $deuda, $data[ 'alumno_id' ] );

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

                    $this->mesCobrado->crear( $data[ 'alumno_id' ], $data[ 'mes_id' ], $data[ 'year_id' ] );
                    $deuda[0]->deuda = $deuda[0]->deuda + $deuda[0]->lonchera_valor + $deuda[0]->pension;
                    $this->alumno->actualizarDeuda( $deuda, $data[ 'alumno_id' ] );

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

    public function getDeudas( $alumnoId ) {

        $deuda = DB::table( 'alumnos as a' )
                    ->select( '*' )
                    ->where( 'a.id', $alumnoId)
                    ->get();
        
        return $deuda;

    }

    public function getItems() {

        $items = DB::table( 'items as i' )
                    ->select( '*' )
                    ->get();

        return $items;

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

    public function createPago ( Request $request ) {

        $data = $request->all();
        $items = $this->getItems();
        $total = 0;

        $result = $this->pagos->crear( $data );

        if ( $result ) {

            $deuda = DB::table( 'alumnos as a' )
                    ->select( '*' )
                    ->where( 'a.id', $data[ 'alumno_id' ] )
                    ->get();

            if ( $data[ 'fPen' ] &&  ( $data[ 'v_pension' ] == $data[ 'p_pension' ] ) ) {
                $data[ 'p_pension' ] = $deuda[0]->deuda_pension - $deuda[0]->pension;
                $total += $deuda[0]->pension;
            } else if ( $data[ 'fHer' ] &&  ( $data[ 'v_pension' ] == $data[ 'p_pension' ] ) ) {
                $data[ 'p_pension' ] = $deuda[0]->deuda_pension - $deuda[0]->pension;
                $total += $deuda[0]->pension;
            } else {
                $total += $data[ 'p_pension' ];
                $data[ 'p_pension' ] = $deuda[0]->deuda_pension - $data[ 'p_pension' ];                
            }

            if ( $data[ 'fMat' ] &&  ( $data[ 'v_matricula' ] == $data[ 'p_matricula' ] ) ) {
                $data[ 'p_matricula' ] = $deuda[0]->deuda_matricula - $deuda[0]->matricula;
                $total += $deuda[0]->matricula;
            } else {
                $total += $data[ 'p_matricula' ];
                $data[ 'p_matricula' ] = $deuda[0]->deuda_matricula - $data[ 'p_matricula' ];
            }

            $data[ 'deuda' ]        = $deuda[0]->deuda - $total - $data[ 'p_lonchera' ] - $data[ 'p_seguro' ] - $data[ 'p_materiales' ];
            $data[ 'p_lonchera' ]   = $deuda[0]->deuda_lonchera - $data[ 'p_lonchera' ];
            $data[ 'p_seguro' ]     = $deuda[0]->deuda_seguro - $data[ 'p_seguro' ];
            $data[ 'p_materiales' ] = $deuda[0]->deuda_materiales - $data[ 'p_materiales' ];
            
            return $this->alumno->editarDeuda( $data, $data[ 'alumno_id' ] );

        }

    }

}
