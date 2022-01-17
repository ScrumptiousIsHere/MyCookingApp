<?php

namespace App\Http\Controllers;

use App\Models\continutReteta;
use App\Models\Reteta;
use Database\Factories\ContinutIngredientFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\continutIngredient;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Print_;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;


class IngredientController extends Controller
{
    function saveData(Request $req)
    {
        if (Ingredient::where('nume', $req->nume)->where('is_active',1)->first()) {
            abort(403,"Ingredientul exista deja");
        }
        elseif($req->carbo<($req->fibre+$req->zahar)){
            abort(403,"Eroare, cantitatea de carbohidrati este mai mica decat cantitatea de glucide si fibre!");
        }
        elseif($req->grasimi<$req->grasimisat){
            abort(403,"Eroare, cantitatea de grasimi saturate este mai mare decat cantitatea totala de grasimi!");
        }
        else {

            $ok=0;
            $ingredient = new Ingredient();
            $ingredient->nume = $req->nume;
            if(DB::select("SELECT id from categorii_ingredients WHERE LOWER(tip) LIKE ?",[$req->inputtip])) {
                if($req->inputum=="ml" || $req->inputum=="g")
                    $ingredient->UM = $req->inputum;
                else abort(403,'Unitatea de masura este invalida');
                $ingredient->user_id = Auth::id();
                $ingredient->is_active=true;
                $select=DB::select("SELECT id from categorii_ingredients WHERE LOWER(tip) LIKE ?",[$req->inputtip]);
                $ingredient->categorii_ingredient_id=$select[0]->id;
                $ingredient->save();
                $ceva = Ingredient::latest()->get();
                $id = $ceva[0]->id;


                $Proteine = new ContinutIngredient();
                $Proteine->nutrient_id = 1;
                $Proteine->cantitate = $req->proteine;
                $Proteine->ingredient_id = $id;
                $Proteine->save();

                $Carbo = new ContinutIngredient();
                $Carbo->nutrient_id = 2;
                $Carbo->cantitate = $req->carbo;
                $Carbo->ingredient_id = $id;
                $Carbo->save();

                $sare = new ContinutIngredient();
                $sare->nutrient_id = 5;
                $sare->cantitate = $req->sare;
                $sare->ingredient_id = $id;
                $sare->save();

                $Grasimi = new ContinutIngredient();
                $Grasimi->nutrient_id = 3;
                $Grasimi->cantitate = $req->grasimi;
                $Grasimi->ingredient_id = $id;
                $Grasimi->save();

                $Saturate = new ContinutIngredient();
                $Saturate->nutrient_id = 6;
                $Saturate->cantitate = $req->grasimisat;
                $Saturate->ingredient_id = $id;
                $Saturate->save();

                $Zaharuri = new ContinutIngredient();
                $Zaharuri->nutrient_id = 7;
                $Zaharuri->cantitate = $req->zahar;
                $Zaharuri->ingredient_id = $id;
                $Zaharuri->save();

                $Fibre = new ContinutIngredient();
                $Fibre->nutrient_id = 8;
                $Fibre->cantitate = $req->fibre;
                $Fibre->ingredient_id = $id;
                $Fibre->save();


                $Alc = new ContinutIngredient();
                $Alc->nutrient_id = 4;
                $Alc->cantitate = $req->alcool;
                $Alc->ingredient_id = $id;
                $Alc->save();
            }
            else {

                abort(403, 'Nu merge nu gasim categoria "'.$req->inputtip.'"').'"';
            }

        }
        return redirect()->route('ingredientelemele');
    }

    public function sterge(Request $req){

        $iduser=Ingredient::where('id',$req->user)->where('is_active',1)->first();
        if($iduser->user->id==strval(Auth::id())) {
            $iduser->is_active=false;
            $iduser->save();
            return redirect()->route('ingredientelemele');
        }
        else{
           print_r($iduser->user.'_____'.Auth::id());
        }
        return (route('dashboard'));
    }

    public function modifica(Request $req,$id){

    if($req->carbo<($req->fibre+$req->zahar)){
        print_r("Eroare, cantitatea de carbohidrati este mai mica decat cantitatea de glucide si fibre!");
        return route('ingredientelemele');
    }
    elseif($req->grasimi<$req->grasimisat){
        print_r("Eroare, cantitatea de grasimi saturate este mai mare decat cantitatea totala de grasimi!");
    }else {
        print_r('ceva');
        if(DB::select("SELECT id from categorii_ingredients WHERE id=?",[$req->tip])) {
            $ingredient = Ingredient::find($req->id);
            $ingredient->nume = $req->nume;
            $ingredient->categorii_ingredient_id = $req->tip;
            $ingredient->save();
        }

        else abort(403,'Categorie invalida');

        $Proteinel = ContinutIngredient::first()->where('nutrient_id', 1)->where('ingredient_id', $req->id)->pluck('id')[0];
        $Proteine = ContinutIngredient::find($Proteinel);
        $Proteine->cantitate = $req->proteine;
        $Proteine->save();

        $Carbol = ContinutIngredient::first()->where('nutrient_id', 2)->where('ingredient_id', $req->id)->pluck('id')[0];
        $Carbo = ContinutIngredient::find($Carbol);
        $Carbo->cantitate = $req->carbo;
        $Carbo->save();

        $Grasimil = ContinutIngredient::first()->where('nutrient_id', 3)->where('ingredient_id', $req->id)->pluck('id')[0];
        $Grasimi = ContinutIngredient::find($Grasimil);
        $Grasimi->cantitate = $req->grasimi;
        $Grasimi->save();

        $Saturatel = ContinutIngredient::first()->where('nutrient_id', 6)->where('ingredient_id', $req->id)->pluck('id')[0];
        $Saturate = ContinutIngredient::find($Saturatel);
        $Saturate->cantitate = $req->grasimisat;
        $Saturate->save();

        $Zaharuril = ContinutIngredient::first()->where('nutrient_id', 7)->where('ingredient_id', $req->id)->pluck('id')[0];
        $Zaharuri = ContinutIngredient::find($Zaharuril);
        $Zaharuri->cantitate = $req->zahar;
        $Zaharuri->save();

        $Fibrel = ContinutIngredient::first()->where('nutrient_id', 8)->where('ingredient_id', $req->id)->pluck('id')[0];
        $Fibre = ContinutIngredient::find($Fibrel);
        $Fibre->cantitate = $req->fibre;
        $Fibre->save();

        $Sareceva = ContinutIngredient::first()->where('nutrient_id', 5)->where('ingredient_id', $req->id)->pluck('id')[0];
        $Sare = ContinutIngredient::find($Sareceva);
        $Sare->cantitate = $req->sare;
        $Sare->save();
    }

        return redirect()->route('ingredientelemele');
//        return redirect('/ingredientelemele');
    }


    public function getContents(Ingredient $ingredient){
        $rez=array();
        continutIngredient::where('ingredient_id',$ingredient->id)->get();
        foreach(continutIngredient::where('ingredient_id',$ingredient->id)->get() as $element){
            array_push($rez,strval($element->nutrient->nume).','.strval($element->cantitate).','.strval($element->nutrient->calorii).','.strval($element->nutrient->UM));
        }

        return json_encode($rez);
    }

    public function filterIngredient(Request $req){
        {
            $lista = DB::select("SELECT id FROM Ingredients where UPPER(nume) LIKE '%".strtoupper($req->kw)."%'");
            $lista = array_column($lista, 'id');
            $listaretete = array();
            foreach ($lista as $element) {
                array_push($listaretete, continutReteta::where('ingredient_id',$element)->pluck('reteta_id'));
            }
            return $listaretete[0];
        }
    }

}
