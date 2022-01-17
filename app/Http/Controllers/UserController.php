<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function saveData(Request $req){

        if($req->parola == $req->confirmaparola) {
            if(User::where('email',$req->mail)->first()) {
                print_r('Exista deja un cont existent pe aceasta adresa de mail!');
            }
            elseif (User::where('username',$req->username)->first()){
                print_r('Acest nume de utilizator este deja folosit');
            }
            else {
                $user = new User;
                $user->name = $req->nume;
                $user->prenume = $req->prenume;
                $user->username = $req->username;
                $user->email = $req->mail;
                $user->parola = Hash::make($req->parola);
                echo $user->save();

            }
        }
        else print_r("Eroare parolele nu coincid!");
    }

    public function create()
    {

        $useri = User::all('id', 'prenume');
        return view('posts.create', compact('useri'));

    }

    function saveCaracteristici(Request $req){
        $user=User::where('id',Auth::id())->first();
        $user->greutate=$req->greutate;
        $user->inaltime=$req->inaltime;
        $data=strtotime($req->luna.'/'.$req->zi.'/'.$req->an);
        $user->data_nasterii=date('Y-m-d H:i:s',$data);
        $user->grad_activitate=$req->grad_activ;
        if($req->sex=='M')
            $user->sex=1;
        else $user->sex=0;
        $user->first_time=0;
        $user->save();

        return redirect()->route( 'programulmeu');
    }


}
