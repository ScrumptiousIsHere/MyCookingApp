<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Auth;
use App\Models\favorit;
use App\Models\Reteta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritController extends Controller
{
    function data(Request $req)
    {
        $fav=\App\Models\favorit::where('user_id',Auth::id())->where('reteta_id', $req->inputreteta)->where('is_active',1)->first();
        if ($fav) {
            //Scoatem de la favorite
            $fav->is_active=false;
            $fav->save();
        } else {
            $fav=new favorit();
            $fav->reteta_id=intval($req->inputreteta);
            $fav->user_id=Auth::id();
            $fav->is_active=true;
            $fav->save();
        }

        return redirect()->route('viewreteta', ['reteta' => \App\Models\Reteta::where('id',$req->inputreteta)->first()]);
    }


    function show(){
        $user=Auth::id();
        $listafavorite=favorit::where('user_id',$user)->where('is_active',1)->pluck('reteta_id');
        return view('fav',['details'=>$listafavorite]);
    }
}
