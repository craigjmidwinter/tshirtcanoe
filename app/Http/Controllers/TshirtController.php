<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TshirtController extends Controller
{
    //

	protected function admin($userCode){

		try {
			$user = User::where('user_code', strtolower($userCode))->firstOrFail();
			$pendingUsers = $user->status =='moderator' ? User::all()->where('status','unapproved') : [];
		} catch (ModelNotFoundException $e){
			return redirect('/register');
		}

		return view('home', ['user' => $user,'pendingUsers' => $pendingUsers]);

	}

	protected function index(){
		$leaderboard = User::all()->whereIn('status',['active','moderator'])->sortBy('tshirt_count', SORT_DESC, true);

		$counts = DB::table('users')->select(DB::raw('sum(tshirt_count) as total'))->whereIn('status',['active','moderator'])->get(['total']);
		return view('welcome',['leaderboard' => $leaderboard, 'total' => $counts[0]->total]);
	}

	protected function updateAvatar(Request $request){

		$data = $request->all();

		if(! isset($data['avatar']) || ! isset($data['user_code'])){
			return redirect('/register');
		}

		try {
			$user = User::where('user_code', strtolower($data['user_code']))->firstOrFail();
		} catch (ModelNotFoundException $e){
			return redirect('/register');
		}

		$user->avatar_url = $data['avatar'];
		$user->save();

		return redirect()->route('useradmin', ['user_code' => $user->user_code])
			->with('status', 'Avatar updated!');
	}

	protected function register(Request $request) {
	    $data = $request->all();

		if(! isset($data['name'])){
			return view('/auth/register');
		}else {
			$user = User::create([
				'name' => $data['name'],
				'status' => 'unapproved',
				'user_code' => $this->generateUserCode()
			]);

			return redirect('/tshirt/' . $user->user_code);
		}
	}

	protected function addShirt($userCode) {
		try {
			$user = User::where('user_code', strtolower($userCode))->firstOrFail();
		} catch (ModelNotFoundException $e){
			return redirect('/register');
		}

		$user->tshirt_count += 1;
		$user->save();

		return redirect('/tshirt/' . $user->user_code);
	}

	protected function removeShirt($userCode) {
		try {
			$user = User::where('user_code', strtolower($userCode))->firstOrFail();
		} catch (ModelNotFoundException $e){
			return redirect('/register');
		}

		if($user->tshirt_count > 0) {
			$user->tshirt_count -= 1;
		};

		$user->save();

		return redirect('/tshirt/' . $user->user_code);
	}

	protected function approve($adminCode, $userCode){

		try {
			$adminUser = User::where('user_code', strtolower($adminCode))->firstOrFail();
			if($adminUser->status =='moderator'){
				$user = User::where('user_code', strtolower($userCode))->firstOrFail();
				$user->status = 'active';
				$user->save();
				return redirect('/tshirt/' . $user->user_code);
			}
		} catch (ModelNotFoundException $e){
			return redirect('/');
		}
	}

	protected function codes(){
		$users = User::whereIn('status', ['active','moderator'])
			->orderBy('name')
			->get();
		return view('codes',['users' => $users]);
	}

	private function generateUserCode(){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$randstring = '';
		for ($i = 0; $i < 4; $i++) {
			$randstring .= $characters[rand(0, strlen($characters) -1)];
		}
		return $randstring;

	}
}
