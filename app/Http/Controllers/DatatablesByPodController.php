<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\IagSession;

use Session;

use App\Signal;

// use DB;

class DatatablesByPodController extends Controller
{
    //
    public function __construct(){
        $this->sid = Session::get('sid');
        $this->ap = Session::get('AccessPodelenia');       
    }
    


    public function getIndex_by_pod(Request $request){

        $data = [
            'title' => 'Тел. 112 - Всички сигнали',
            'jumbotron_title' => Session::get('Podelenie'),
            'jumbotrontext'=> 'Всички сигнали получени чрез тел. 112',
            // 'sid' => $this->sid,
            // 'ap' => $this->ap
        ];

        return view('signali.allsignals_by_pod', $data);
    }

   
   
    public function anyData_by_pod( Request $request){

        $ap = $request->ap;
         
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
		$totalData = Signal::podid($ap)->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$posts = Signal::podid($ap)->offset($start)
					->limit($limit)
					->orderBy($order,$dir)
					->get();
			$totalFiltered = Signal::podid($ap)->count();
		}else{
            $search = $request->input('search.value');
            
			$posts = Signal::podid($ap)->filter()
                                    ->offset($start)
                                    ->limit($limit)
                                    ->orderBy($order, $dir)
                                    ->get();
                            
			$totalFiltered = Signal::podid($ap)->filter()->count();
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