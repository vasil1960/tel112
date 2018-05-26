<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\WriteLogos;
use Session;

class RedirectController extends Controller {

    use WriteLogos;
    
    public function redirect(Request $request){

        $data = [
            'title' => 'Тел. 112 - Съобщение',
            'jumbotron_title' => 'Съобщение',
            'jumbotrontext'=> 'относно работата с модула',
            'sid' => Session::get('sid')
        ];
        
        $this->write_log($request, 'Пренасочване към изход поради изтичане на сесията');

        return view( 'signali.restrict', $data );
    }

}
