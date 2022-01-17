<?php

namespace App\Http\Controllers;

use App\Models\Reteta;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ReviewController extends Controller
{
    function saveData(Request $req)
    {
        if(Review::where('user_id',Auth::id())->where('reteta_id',$req->reteta)->where('is_active',1)->first())
            abort(403,"EXISTA UN REVIEW DEJA");
//        .Review::where('user_id',Auth::id())->where('reteta_id',$req->reteta)->get());

        else{
            $recenzie=new Review();
            if($req->nota<1 || $req->nota>5)
                abort(403,'Nota invalida');
            $recenzie->nota=$req->nota;
            $recenzie->continut=$req->continut;
            $recenzie->user_id=Auth::id();
            $recenzie->reteta_id=$req->reteta;
            $recenzie->is_active=true;
            $recenzie->save();

        }

        $reteta=Reteta::where('id',$req->reteta)->first();
        return redirect()->route('viewreteta',['reteta'=>$reteta]);
    }





}
