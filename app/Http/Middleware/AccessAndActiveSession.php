
<?php
namespace App\Http\Middleware;
use Closure;
use App\IagSession;
use Session;

// use App\IagUser;
class AccessAndActiveSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request,  Closure $next)
    {
        $result = IagSession::where('ID', $request->sid)->first();
        
        if($result->ActiveSession !== 0 && $result->Access112 !== 0){
            
            $request->session()->put([
                        'sid'             => $result->ID,
                        'username'        => $result->username,
                        'SelYear'         => $result->SelYear,
                        'AccessPodelenia' => $result->AccessPodelenia,
                        'Access112'       => $result->Access112,
                        'Access'          => $result->Access,
                        'ActiveSession'   => $result->ActiveSession,
                        'FullName'        => $result->iaguser->Name .' '. $result->iaguser->Familia,
                        'Podelenie'       => $result->iaguser->Podelenie,
                        'userId'          => $result->userId
                    ]);

            
            // view()->composer('*', function($view){
            //     $view->with('iagses', $result);
            // });

            // view()->composer('*', function($view){
            //     $view->with('vasil', Session::all());
            // });
            
            //dd(Session::all());
            
            return $next($request);
        }
    return redirect()->route('redirect', ['sid'=>$result->ID]);
    // abort(404);
        
    } 
}