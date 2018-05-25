<?php
namespace App\Http\Controllers;
use App\IagSession;
use App\Traits\WriteLogos;
use Illuminate\Http\Request;

class LogoutController extends Controller {

	use WriteLogos;

	public function logout(Request $request) {
		// $as = $request->session()->get('ActiveSession');
		$sid = $request->session()->get('sid');

		if ($sid) {
			$iagsession = IagSession::where('ID', $sid)->first();
			$iagsession->update(['ActiveSession' => 0]);
			$iagsession->save();
			$this->write_log($request, 'Изход от модула');
			return redirect()->route('redirect', ['sid' => $sid]);
			$request->session()->flush();
		}

		// return redirect('https://system.iag.bg');
		// abort('404');
	}
}