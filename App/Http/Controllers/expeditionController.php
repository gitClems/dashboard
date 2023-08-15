<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class expeditionController extends Controller {
    function display ( Request $request ) {

        $result = DB::select(
            "SELECT *
                from kpi_test "
        );
        $typeExpedition = DB::select(
            'SELECT SUM(NB_EXPEDITIONS_C2C) as C2C, SUM(NB_AIO_EXPEDITIONS) as AIO, SUM(NB_EXPEDITIONS) as TOTAL_SUM from kpi_test '
        );

        if ( $request->ajax() ) {
            $start = $request->start;
            $end = $request->end;
            $result = DB::select(
                "SELECT *
                    from kpi_test 
                    where DATE_REPORT between ? and ? 
                ",
                [ $start, $end ]
            );
            return  response()->json( $result );
        }

        $monMin = DB::select(
            "SELECT MIN(DATE_REPORT) as myMin
                from kpi_test"
        );
        $monMax = DB::select(
            "SELECT MAX(DATE_REPORT) as myMax
                from kpi_test"
        );
        $min = $monMin[ 0 ]->myMin;
        $max = $monMax[ 0 ]->myMax;
        // dd( $result->NB_EXPEDITIONS_C2C );
        return view( 'dashboard', compact( [ 'result', 'min', 'max','typeExpedition'] ) );
    }
}
