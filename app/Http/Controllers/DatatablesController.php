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

use Yajra\Datatables\Datatables;

use App\Traits\WriteLogos;

// use DB;

class DatatablesController extends Controller
{

    use WriteLogos;

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

        $this->write_log($request, 'Отваряне на страница с всички сигнали');

        return view('signali.allsignals', $data);
    }


   
    public function anyData( Request $request){

//       INNER JOIN nug.podelenia AS dgs ON dgs.Pod_Id = s.pod_id
//		 INNER JOIN nug.podelenia AS rdg ON rdg.Pod_Id = dgs.Glav_Pod
//		 INNER JOIN nug.podelenia AS dp ON dp.Pod_Id = dgs.DP_ID

        $signals = Signal::join('nug.podelenia as dgs','dgs.Pod_Id','=','signali.pod_id')
                            ->leftJoin('nug.podelenia AS rdg','rdg.Pod_Id','=','dgs.Glav_Pod')
                            ->leftJoin('nug.podelenia AS dp','dp.Pod_Id','=','dgs.DP_ID')
                            ->select(['signali.id','signali.pod_id','signali.glav_pod',
                                'signali.name','signali.phone','signali.signaldate as signaldate','signali.opisanie',
                                'dgs.Pod_NameBg as PodName', 'rdg.Pod_NameBg as RdgName', 'dp.Pod_NameBg as DpName']);


        return Datatables::of($signals)


                ->editColumn('pod_id', function($signal){
                    return  $signal->PodName . ' (' . $signal->RdgName. ', ' .$signal->DpName . ')';
                })
                ->editColumn('signaldate', function($signal){
                    return  date('d.m.Y H:i:s', strtotime($signal->signaldate)) ;
                })
                ->editColumn('glav_pod', function($signal){
                    return  $signal->RdgName ;
                })
                ->editColumn('name', function($signal){
                    return  (string) $signal->name !=='' ? $signal->name : 'Анонимен'  . ' (тел. ' . $signal->phone. ')' ;
                })
                ->addColumn('action', function ($signal) {
                    return '<a href="signal/' . $signal->id . '/?sid=' . Session::get('sid') . '" class="btn btn-outline-info btn-xs">Още..</a> 
                            <a href="signal/' . $signal->id . '/?sid=' . Session::get('sid') . '" class="btn btn-outline-danger btn-xs">Ред..</a>';
                })
                ->removeColumn('glav_pod')
                ->removeColumn('phone')
                ->make(true);
	}
}