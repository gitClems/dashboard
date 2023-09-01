<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class expeditionController1 extends Controller {
    function display ( Request $request ) {

        $result = DB::select(
            "SELECT *
                from kpi_test "
        );

        if ( $request->ajax() ) {
            try {
                $start = $request->start;
                $end = $request->end;
                $result = DB::select(
                    "SELECT *
                    from kpi_test
                    where DATE_REPORT between ? and ? 
                ", [ $start, $end ]
                );
                return  response()->json( $result );
            } catch ( \Throwable $th ) {
            }
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
        return view( 'dashboard', compact( [ 'result', 'min', 'max' ] ) );
    }
}