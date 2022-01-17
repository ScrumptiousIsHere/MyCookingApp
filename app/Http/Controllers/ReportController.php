<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportCategorie;
use App\Models\Reteta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    function data(Request $req){
        if(! Report::where('user_id',Auth::id())->where('reteta_id',$req->reteta)->where('report_categories_id',$req->inputmotiv)->where('is_active',1)->first()) {
            if (   Reteta::where('id', $req->reteta)->pluck('user_id')[0] == Auth::id()) {
                abort(403, 'CEVA NU MERGE BINE');
            }
            else{
                $rep = new Report();
                $rep->user_id = Auth::id();
                $rep->reteta_id = $req->reteta;
                if(ReportCategorie::where('id',$req->inputmotiv)->first())
                    $rep->report_categories_id = $req->inputmotiv;
                else abort(403,'Nu avem categoria respectiva');
                $rep->is_active=true;
                $rep->motiv=$req->inputtext;
                $rep->save();
                return redirect()->route('viewreteta', ['reteta' => Reteta::where('id', $req->reteta)->first()]);
            }
        }
        else{
            return back();
        }
        return redirect()->route('dashboard');
    }

    function sterge(Request $req){
        if(User::where('id',Auth::id())->pluck('is_admin')[0]==1){
            DB::update('update Retetas set is_active=0 WHERE id=?', [$req->user]);
            DB::update('update reports set is_active=0 where id=?',[$req->report]);
            DB::update('update reviews set is_active=0 where reteta_id=?',[$req->user]);
            return redirect()->route('administrator',['report'=>Report::latest()->where('is_active',1)->get()]);
        }
        else abort(403);
        return redirect()->route('dashboard');
    }


    function sariPeste(Request $req){
        DB::update('update reports set is_active=0 where id=?',[$req->report]);
        return redirect()->route('administrator',['report'=>Report::latest()->where('is_active',1)->get()]);
    }
}
