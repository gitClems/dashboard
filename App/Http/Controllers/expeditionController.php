<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class expeditionController extends Controller {
    function display () {
        return view( 'dashboard' );
    }
}
