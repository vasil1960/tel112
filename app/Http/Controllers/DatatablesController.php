<?php
/*
    https://gitlab.com/maballo/laravel5-datatable-server-side-processing
*/


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\IagSession;

use Session;

use App\Signal;

// use DB;

class DatatablesController extends Controller
{
    //
    public function __construct(){
        // $this->sid = Session::get('sid');;
        // $this->ap = Session::get('AccessPodelenia');       
    }
    
    public function getIndex(Request $request){

        $data = [
            'title' => 'Тел. 112 - Всички сигнали',
            'jumbotron_title' => 'Всички сигнали',
            'jumbotrontext'=> 'Всички сигнали получени чрез тел. 112',
            'sid' => Session::get('sid'),
        ];

        return view('signali.allsignals', $data);
    }

   

    /*
     https://gitlab.com/maballo/laravel5-datatable-server-side-processing
    */
   
    public function anyData( Request $request){

        // $ap = $this->ap;
         
        $columns = array(
			0 => 'id',
			1 => 'pod_id',
			2 => 'glav_pod',
            3 => 'name',
            4 => 'phone',
            5 => 'signaldate',
            6 => 'opisanie',
		);
        
        // podid() - scope signal model to global filter datatables by pod_id. (Signal model)
		$totalData = Signal::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$posts = Signal::offset($start)
					->limit($limit)
					->orderBy($order,$dir)
					->get();
			$totalFiltered = Signal::count();
		}else{
            $search = $request->input('search.value');
            
			$posts = Signal::filter()
                                    ->offset($start)
                                    ->limit($limit)
                                    ->orderBy($order, $dir)
                                    ->get();
                            
			$totalFiltered = Signal::filter()->count();
		}		
						
		$data = array();
		
		if($posts){
			foreach($posts as $r){
				$nestedData['id'] = '
                    <a href="signals/'.$r->id.'/?sid=' . Session::get('sid') . '" class="btn btn-outline-info btn-xs">'.$r->id .'</a>
				';
                $nestedData['pod_id'] = $r->podelenie->Pod_NameBg;
                $nestedData['glav_pod'] = $r->rdg->Pod_NameBg;
                $nestedData['name'] = $r->name;
                $nestedData['phone'] = $r->phone;
                $nestedData['signaldate'] = date('d.m.Y H:i:s',strtotime($r->signaldate));
                $nestedData['opisanie'] = $r->opisanie;
                $nestedData['action'] = '
                    <a href="signals/'.$r->id.'/?sid=' . Session::get('sid') . '" class="btn btn-outline-info btn-xs">Още..</a>
				';
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			  => intval($request->input('draw')),
			"recordsTotal"    => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			  => $data
		);
		
		echo json_encode($json_data);
	}
}