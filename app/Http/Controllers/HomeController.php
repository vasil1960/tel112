<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\WriteLogos;

class HomeController extends Controller
{
    
     use WriteLogos;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $data = [
            'title' => 'Тел. 112 - Начало',
            'jumbotron_title' => 'Начална страница',
            'jumbotrontext'=> '',
            'sid' => Session::get('sid')
        ];

        $this->write_log($request, 'Отваряне на начална страница');
        
        return view('signali.home', $data);
    }
}
