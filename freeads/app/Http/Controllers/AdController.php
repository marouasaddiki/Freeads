<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use App\Http\Requests\AdStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdController extends Controller
{
    use RegistersUsers;
    
    public function index(){
        $ads = DB::table('ads')->orderBy('created_at', 'DESC')->paginate(10);
        return view('ads', compact('ads'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(AdStore $request)
    {
        
        $validate = $request->validated();
      

        if(!Auth::check()){
            $request->validate([
        'name' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',

            ]);
         $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            $this->guard()->login($user);
        } 
        $ad = new Ad();
        $ad->title = $validate['title'];
        $ad->description = $validate['description'];
        $ad->price = $validate['price'];
        $ad->localisation = $validate['localisation'];
        $ad->user_id = auth()->user()->id;
        $ad->save();

        return redirect()->route('welcome')->with('success', 'Votre annonce a bien été enregistrée');

    }

    public function search(Request $request){

        $words = $request->words;


        $ads = DB::table('ads')
        ->where('title', 'LIKE', "%$words%")
        ->orWhere('description', 'LIKE', "%$words%")
        ->orderBy('created_at', 'DESC')
        ->get();

        return response()->json(['success'=> true, 'ads'=> $ads]);

}
    
   
}
