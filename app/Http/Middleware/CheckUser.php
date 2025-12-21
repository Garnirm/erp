<?php

namespace App\Http\Middleware;

use App\Domains\Account\Models\Account;
use App\Domains\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    public function handle(Request $request, \Closure $next): mixed
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json([ 'success' => false, 'errors' => [ 'Not authenticated.' ] ], 403);
            }

            return redirect('/login');
        }

        /** @var User $user */
        $user = Auth::user();

        $user_id = $user->id;
        $account_id = $user->account_id;

        /** @var null|Account */
        $account = Account::find($account_id);

        if (is_null($account)) {
            Auth::logout();

            if ($request->ajax()) {
                return response()->json([ 'success' => false, 'errors' => [ 'Not authenticated.' ] ], 403);
            }

            return redirect('/login');
        }

        /*if (UserSession::where('user_id', $user_id)->where('session_id', $datas['session_id'])->count() === 0) {
            if ($request->ajax()) {
                return response()->json([ 'success' => false, 'errors' => [ 'Not authenticated.' ] ], 403);
            }

            return redirect('/auth');
        }*/

        App::setLocale($user->lang->code);

        //Cache::put('auth_'.$datas['session_id'].'_last_activity', now());

        //AccountSingle::load($account);

        return $next($request);
    }
}
