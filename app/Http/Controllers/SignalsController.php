<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSignaliRequest;
use App\Podelenia;
use App\Signal;
use App\Traits\WriteLogos;
use Illuminate\Http\Request;
use Session;

class SignalsController extends Controller {

	use WriteLogos;

	public function __construct() {

		// $this->sid = Session::get('sid');
		// $this->userId = Session::get('userId');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		$data = [
			'title' => 'Тел. 112 - Нов сигнал',
			'jumbotron_title' => 'Нов сигнал',
			'jumbotrontext' => 'Въвеждане на нов сигнал',
			// 'sid' => $request->session()->get('sid'),
		];

		$this->write_log($request, 'Отваряне на форма за добавяне на нов сигнал');

		return view('signali.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(AddSignaliRequest $request) {

		dump($request->all());

		$podelenia = Podelenia::where('Pod_Id', $request->pod_id)->first();

		if ($request->isMethod('post')) {

			$signal = new Signal;

			$signal->signalfrom = $request->signalfrom;
			$signal->signaldate = $request->signaldate;
			$signal->identnumber = $request->identnumber;
			$signal->pod_id = $request->pod_id;
			$signal->glav_pod = $podelenia->Glav_Pod;
			$signal->name = $request->name;
			$signal->phone = $request->phone;
			$signal->narushenia = $request->narushenia;
			$signal->adress = $request->adress;
			$signal->opisanie = $request->opisanie;
			$signal->send_to = $request->send_to;
			$signal->send_to_extra = $request->send_to_extra;
			$signal->deistvie = $request->deistvie;
			$signal->deistvie_date = $request->deistvie_date;
			$signal->notes = $request->notes;
			$signal->policia = $request->policia;
			$signal->InsertUserID = $this->userId;
			$signal->InsertDate = date('Y m d H:i:s');

			$signal->save();

			$insertedId = $signal->id;

			$this->write_log($request, 'Записване на нов сигнал №: ' . $insertedId . ' в базата с данни');
		}
		$data = [
			'title' => 'Тел. 112 - Нов сигнал',
			'jumbotron_title' => 'Нов сигнал',
			'jumbotrontext' => 'Въвеждане на нов сигнал',
			// 'sid' => $this->sid,
		];

		return view('signali.create', $data);
		// return view( 'signali.create');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request ,$id) {

		$signal = Signal::whereId($id)->first();

        $data = [
            'title' => 'Сигнал №: '. $id,
            'jumbotron_title' => 'Сигнал №: ' .$id,
            'signal' => $signal,
            'jumbotrontext'=> 'Подробно описание на конкретен сигнал №: '. $id. ' (за '. Session::get('Podelenie') .')',
            // 'sid' => $this->sid
        ];
        
        $this->write_log($request, 'Разглеждане на сигнал №:'.$id);

        return view('signali.signal', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
