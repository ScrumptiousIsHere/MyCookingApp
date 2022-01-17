<?php

namespace App\Http\Controllers;

use App\Models\categorieReteta;
use App\Models\continutReteta;
use App\Models\Ingredient;
use App\Models\RecipeStep;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Reteta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Integer;
use function GuzzleHttp\Psr7\str;

class RetetaController extends Controller
{

    public function create()

    {

        $retete = Reteta::all('id', 'titlu');
        return view('posts.create', compact('retete'));


    }

    function saveData(Request $req)
    {

        if ( Reteta::where('titlu', $req->titlu)->where('user_id',Auth::id())->where('is_active',1)->first()) {
            abort('403','Exista deja o reteta cu acest nume!');

        }else {

            if(categorieReteta::where('id',$req->inputtip)->first()) {



                $path=base_path().'\public\images';
                $poza=$_FILES['file'];
                $nume_poza = $poza['name'];
                $poza_tmp=$poza['tmp_name'];
                $poza_size=$poza['size'];
                $poza_error=$poza['error'];

                $extensie=explode('.',$nume_poza);
                $extensie=strtolower(end($extensie));

                $permise=array('jpg','png','jpeg');

                if(in_array($extensie,$permise)) {
                    if ($poza_error === 0)
                        $nume_nou = uniqid('', true) . '.' . $extensie;
                    $destinatie = base_path().'/public/images/'.$nume_nou;
                    move_uploaded_file($poza_tmp, $destinatie);
                }
                else abort(403,"Fisierul atasat nu este imagine");




                $reteta = new Reteta();
                $reteta->titlu = $req->titlu;
                $reteta->tip_masa = $req->inputtip;
                $reteta->descriere = $req->descriere;
                $reteta->durata_gatire = $req->durata;
                $reteta->user_id = Auth::id();
                $reteta->is_active = true;
                $reteta->imagine=$nume_nou;
                $reteta->save();

                $ceva = Reteta::latest()->get();
                $id = $ceva[0]->id;





                $ingrediente = array();
                $cantitati = array();
                for ($i = 1; $i <= $req->nring; $i++) {
                    $cant = $req->{'cantitatei' . strval($i)};
                    $ing = $req->{'ingredient' . strval($i)};
                    $cantitati[$i - 1] = $cant;
                    $ingrediente[$i - 1] = $ing;

                }

                for ($i = 1; $i <= $req->nring; $i++) {

                    $varing = new continutReteta();
                    $varing->reteta_id = $id;
                    $varing->cantitate = $cantitati[$i - 1];
                    $varing->ingredient_id = $ingrediente[$i - 1];
                    $varing->save();

                }
                $pasi = array();
                for ($i = 1; $i <= $req->nrpas; $i++) {
                    $pas = $req->{'pas' . strval($i)};
                    $pasi[$i - 1] = $pas;
                }

                for ($i = 1; $i <= $req->nrpas; $i++) {
                    $varpas = new RecipeStep();
                    $varpas->reteta_id = $id;
                    $varpas->nr_pas = $i;
                    $varpas->Descriere = $pasi[$i - 1];
                    $varpas->save();
                }

                return redirect()->route('retetelemele');

            }
            else abort(403,"Categoria nu exista");

        }
        return redirect()->route('retetelemele');
    }



    public function getIngredients()
    {
        $ingredients = DB::table('ingredients')->pluck("nume","id");
        return view('adaugareteta',compact('ingredients'));
    }

    public function getIngredientsComp()
    {
        $ingredients = DB::table('ingredients')->pluck("nume","id");
        return view('compara',compact('ingredients'));
    }


    public function cauta(Request $r){
        $kw=array();
        $kw=explode(' ',$r->q);
        $req=array();
        $nrret=Reteta::all()->last()->id;
        for($i=0;$i<intval(sizeof($kw));$i++) {
            $resultArray = Reteta::latest()->where('is_active',1)->where('is_visible',1)->where('titlu', 'LIKE', '%' . $kw[$i] . '%')->orWhere('is_active',1)->where('is_visible',1)->where('descriere', 'LIKE', '%' . $kw[$i] . '%')->pluck('id')->toArray();
            $req=array_merge($req, $resultArray);
        }

        $arr=array_fill(0,$nrret,0);
        for($i=0;$i<sizeof($arr);$i++) {
            $nr=0;
            for ($j = 0; $j < sizeof($req); $j++)
                if($req[$j]==$i+1)
                    $nr++;
            $arr[$i]=$nr;
            }

        $req=json_encode($arr);
        $ordine=array();
        for($i=0;$i<sizeof($arr);$i++) {
            $best = 0;
            foreach ($arr as $element){
                if ($element > $best)
                $best = array_search($element, $arr) + 1;
            }
                array_push($ordine, $best);
                $arr[$best - 1] = 0;
        }
        $req=json_encode($ordine);
        return view('cautare',['details'=>$req]);
    }



    public function sterge(Request $req){

        $iduser=Reteta::where('id',$req->user)->first();
        if($iduser->user_id==Auth::id() || User::where('id',Auth::id())->pluck('is_admin')[0]==1) {
            $iduser->is_active=false;
            $iduser->save();
            if(User::where('id',Auth::id())->pluck('is_admin')[0]==1)
                return redirect()->route('dashboard');
            return (view('retetelemele',['retete' => \App\Models\Reteta::latest('created_at')->where('user_id',Auth::id())->with('autor')->with('autor')->get(),'numar'=>Reteta::latest('created_at')->get()->count()]));
        }
        else{
            abort(403);
        }
        return (route('dashboard'));
    }






    public function startProgram()
    {

        $best=array();
        $user = Auth::id();
        $user = User::where('id', $user)->first();
        $datatest = new DateTime($user->data_nasterii);
        $data1 = DateTime::createFromFormat("Y-m-d", $user->data_nasterii);
        $diff = date_diff($datatest, new DateTime('now'), 1);


        $total = 0;
        if ($user->sex == 1) {
            $bmr = $user->greutate * 10 + 6.25 * $user->inaltime - 5 * $diff->format("%Y") + 5;
            $na = $user->grad_activitate;
            if ($na == 1)
                $total = $bmr * 1.2;
            elseif ($na == 2)
                $total = $bmr * 1.4;
            elseif ($na == 3)
                $total = $bmr * 1.6;
            elseif ($na == 4)
                $total = $bmr * 1.75;
            elseif ($na == 5)
                $total = $bmr * 2;
        } elseif ($user->sex == 0) {
            $bmr = $user->greutate * 10 + 6.25 * $user->inaltime - 5 * $diff->format("%Y") - 161;
            $na = $user->grad_activitate;
            if ($na == 1)
                $total = $bmr * 1.2;
            elseif ($na == 2)
                $total = $bmr * 1.4;
            elseif ($na == 3)
                $total = $bmr * 1.6;
            elseif ($na == 4)
                $total = $bmr * 1.75;
            elseif ($na == 5)
                $total = $bmr * 2;
        }
        $proteine = $total * 12.5 / 100;
        $grasimi = $total * 27.5 / 100;
        $carbohidrati = $total * 60 / 100;


        for ($p = 1; $p <= 3; $p++) {
            $listacrom = array();
            $max = 0;
            for ($i = 0; $i < 40; $i++) {

                //creem un cromozom nou
                $crom = array();
                //Adaugam la cromozom o reteta de mic dejun aleatoare
                $micdejun = json_decode(Reteta::latest()->where('tip_masa', '1')->pluck('id'));
                $lenmd = count($micdejun);
                array_push($crom, $micdejun[random_int(0, $lenmd - 1)]);


                //Adaugam la cromozom o reteta de pranz aleatoare
                $pranz = json_decode(Reteta::latest()->where('tip_masa', '2')->where('is_active', 1)->pluck('id'));
                $lenp = count($pranz);
                array_push($crom, $pranz[random_int(0, $lenp - 1)]);

                //Adaugam la cromozom o reteta de cina aleatoare
                $cina = json_decode(Reteta::latest()->where('tip_masa', '3')->pluck('id'));
                $lenc = count($cina);
                array_push($crom, $cina[rand(0, $lenc - 1)]);

                //Adaugam la cromozom doua retete de gustare
                $gustare = json_decode(Reteta::latest()->where('tip_masa', '4')->pluck('id'));
                $leng = count($gustare);
                array_push($crom, $gustare[rand(0, $leng - 1)]);
                array_push($crom, $gustare[rand(0, $leng - 1)]);
                $suma = $this->calculCarbo($crom, $carbohidrati) + $this->calculProt($crom, $proteine) + $this->calculGrasimi($crom, $grasimi) + $this->calculCalorii($crom, $total);
                array_push($crom, 9 + $suma);

                //adaugam cromozomul la lista
                array_push($listacrom, $crom);

            }
            for ($k = 0; $k < 40; $k++) {
                set_time_limit(20);

                //CALCULEAZA FITNESS
                for ($j = 0; $j < sizeof($listacrom); $j++) {
                    $suma = $this->calculCarbo($listacrom[$j], $carbohidrati) + $this->calculProt($listacrom[$j], $proteine) + $this->calculGrasimi($listacrom[$j], $grasimi) + $this->calculCalorii($listacrom[$j], $total);
                    $listacrom[$j][5] = 9 + $suma;
                }

                //selectia parintilor


                //calculam totalul functiilor fitness
                $totalfit = $this->calculTotalFitness($listacrom);
                //calculam pentru fiecare cromozom probabilitatea sa
                $listacrom = $this->calculProb($listacrom, $totalfit);
                //calculam probabilitatea cumulativa
                $listacrom = $this->calculProbCum($listacrom, $totalfit);
                //gasim primul element care are prob mai mare decat numarul random si o introducem in survivors
                //initializam lista cromozomilor care supravietuiesc si avanseaza in urmatoarea generatie
                $result = array();
                for ($i = 0; $i < sizeof($listacrom); $i++) {
                    $rand = rand(0, 1000) / 1000;
                    for ($j = 0; $j < sizeof($listacrom); $j++) {
                        if ($listacrom[$j][7] >= $rand) {
                            array_push($result, $listacrom[$j]);
                            break;
                        }
                    }
                }

                $listacrom = $result;


                //crossover
                $rataCross = 75;
                $parinti = array();
                for ($i = 0; $i < sizeof($listacrom); $i++) {
                    $rand = rand(0, 100);
                    if ($rand < $rataCross)
                        array_push($parinti, $i);
                }

                $nrparinti = sizeof($parinti) - 1;
                $j = 0;
                while ($j < $nrparinti) {
                    //selectam cate doi parinti
                    $parinte1 = $listacrom[$parinti[$j]];
                    $parinte2 = $listacrom[$parinti[$j + 1]];
                    //creem copiii
                    //luam o gena la intamplare
                    $punct = rand(0, 4);
                    //interschimbam
                    for ($i = 0; $i <= 7; $i++) {
                        if ($i == $punct) {
                            $copil1[$i] = $parinte2[$i];
                            $copil2[$i] = $parinte1[$i];
                        } else {
                            $copil1[$i] = $parinte1[$i];
                            $copil2[$i] = $parinte2[$i];
                        }
                    }


                    //inlocuim parintii cu copii
                    $listacrom[$parinti[$j]] = $copil1;
                    $listacrom[$parinti[$j + 1]] = $copil2;

                    $j = $j + 2;
                }

//mutatie
                $rata_mutatie = 0.05;
                //avem crossover-ul efectuat,mai trebuie mutatia(random la un element al array-ului)
                $total_gene = sizeof($listacrom) * 5;
                $num_mutatii = ceil($rata_mutatie * $total_gene);

                while ($num_mutatii > 0) {
                    $randNo = round(rand(1, $total_gene));
                    $n = ceil($randNo / 5) - 1; //alegem cromozomul
                    $masa = rand(0, 4);  //alegem gena
                    if ($masa == 0) {
                        $micdejun = json_decode(Reteta::latest()->where('tip_masa', '1')->pluck('id'));
                        $lenmd = count($micdejun);
                        $listacrom[$n][$masa] = $micdejun[rand(0, $lenmd - 1)];
                    } elseif ($masa == 1) {
                        $pranz = json_decode(Reteta::latest()->where('tip_masa', '2')->pluck('id'));
                        $lenmd = count($pranz);
                        $listacrom[$n][$masa] = $pranz[rand(0, $lenmd - 1)];
                    } elseif ($masa == 2) {
                        $pranz = json_decode(Reteta::latest()->where('tip_masa', '3')->pluck('id'));
                        $lenmd = count($pranz);
                        $listacrom[$n][$masa] = $pranz[rand(0, $lenmd - 1)];
                    } elseif ($masa == 3) {
                        $pranz = json_decode(Reteta::latest()->where('tip_masa', '4')->pluck('id'));
                        $lenmd = count($pranz);
                        $listacrom[$n][$masa] = $pranz[rand(0, $lenmd - 1)];
                    } elseif ($masa == 4) {
                        $pranz = json_decode(Reteta::latest()->where('tip_masa', '4')->pluck('id'));
                        $lenmd = count($pranz);
                        $listacrom[$n][$masa] = $pranz[rand(0, $lenmd - 1)];
                    }

                    $num_mutatii--;
                }


            }  //end for 100 iteratii
            $cromozom = array_column($listacrom, 0);
            $fit = array_column($cromozom, 5);
            foreach ($listacrom as $key => $row)
                $fit[$key] = $row[5];
            array_multisort($fit, SORT_DESC, $listacrom);
            array_push($best,$listacrom[0]);
        }
        $cromozom = array_column($best, 0);
        $fit = array_column($cromozom, 5);
        foreach ($best as $key => $row)
            $fit[$key] = $row[5];
        array_multisort($fit, SORT_DESC, $best);
        return view('generatie',['program'=>$best[0]]);

    }


    public function calculProbCum($listacrom,$total){
        for($i=0;$i<sizeof($listacrom);$i++){
            $listacrom[$i][7]=0;
            for ($j=0;$j<=$i;$j++)
                $listacrom[$i][7]=$listacrom[$i][7]+$listacrom[$j][6];
        }
        return $listacrom;
    }



    public function calculProb($listacrom,$totalfit){
        for($i=0;$i<sizeof($listacrom);$i++){
            $listacrom[$i][6]=$listacrom[$i][5]/$totalfit;
        }
        return $listacrom;
    }

    public function calculTotalFitness($listacrom){
        $totalprob=0;
        for($i=0;$i<sizeof($listacrom);$i++){
            $totalprob=$totalprob+$listacrom[$i][5];
        }
        return $totalprob;
    }


    public function calculFitness($id){
        $prot=0;
        $grasimi=0;
        $calorii=0;
        $carbo=0;
        $masa=Reteta::where('id',$id)->first();
            foreach($masa->continut as $continutReteta){
                foreach($continutReteta->ingredient->continut as $continutIngredient){
                    if($continutIngredient->nutrient->nume=="Carbohidrat")
                        $carbo=$carbo+$continutIngredient->cantitate*($continutReteta->cantitate/100);
                    elseif($continutIngredient->nutrient->nume=="Proteina")
                        $prot=$prot+$continutIngredient->cantitate*($continutReteta->cantitate/100);
                    elseif($continutIngredient->nutrient->nume=="Grasime")
                        $grasimi=$grasimi+$continutIngredient->cantitate*($continutReteta->cantitate/100);
                }
            }

        $nutrienti=array();
        array_push($nutrienti,$prot);
        array_push($nutrienti,$grasimi);
        array_push($nutrienti,$carbo);
        array_push($nutrienti,$prot+$carbo+$grasimi);
        return $nutrienti;
    }

    public function calculCarbo($crom,$carbo){
        $p=0.1;
        $total=0;
        for($i=0;$i<=4;$i++){
            $rezultat=$this->calculFitness($crom[$i]);
            $total=$total+$rezultat[2];
        }
        if($carbo*0.95<=$total && $total<=$carbo*1.05) {
            return 2;
        }
        elseif(($carbo*0.9<=$total && $total<$carbo*0.95) || ($carbo*1.05<$total && $total<=$carbo*1.1))
            return 0;
        elseif($carbo*0.9>$total || $total>$carbo*1.1)
            return -2;

    }

    public function calculProt($crom,$prot){
        $total=0;
        for($i=0;$i<=4;$i++){
            $rezultat=$this->calculFitness($crom[$i]);
            $total=$total+$rezultat[0];
        }
        if($prot*0.95<=$total && $total<=$prot*1.05)
            return 2;
        elseif(($prot*0.9<=$total && $total<$prot*0.95) || ($prot*1.05<$total && $total<=$prot*1.1))
            return 0;
        elseif($prot*0.9>$total || $total>$prot*1.1)
            return -2;

    }

    public function calculGrasimi($crom,$gr){
        $total=0;
        for($i=0;$i<=4;$i++){
            $rezultat=$this->calculFitness($crom[$i]);
            $total=$total+$rezultat[1];
        }
        if($gr*0.95<=$total && $total<=$gr*1.05)
            return 2;
        elseif(($gr*0.9<=$total && $total<$gr*0.95) || ($gr*1.05<$total && $total<=$gr*1.1))
            return 0;
        elseif($gr*0.9>$total || $total>$gr*1.1)
            return -2;

    }

    public function calculCalorii($crom,$cal){
        $total=0;
        for($i=0;$i<=4;$i++){
            $rezultat=$this->calculFitness($crom[$i]);
            $total=$total+$rezultat[3];
        }
        if($cal*0.95<=$total && $total<=$cal*1.05)
            return 2;
        elseif(($cal*0.9<=$total && $total<$cal*0.95) || ($cal*1.05<$total && $total<=$cal*1.1))
            return 0;
        elseif($cal*0.9>$total || $total>$cal*1.1)
            return -2;
    }
    //    public function startProgram(){
//        set_time_limit(30);
//
//        //cromozomul trebuie sa fie alcatuit din mic dejun, pranz, cina, gustare1 , gustare2, suma fct fitness, nr cal totale, nr prot, nr carbo, nr grasimi
//
//
//        $listacrom=array();
//        $max=0;
//        for($i=0;$i<60;$i++) {
//
//            //creem un cromozom nou
//            $crom = array();
//            //Adaugam la cromozom o reteta de mic dejun aleatoare
//            $micdejun = json_decode(Reteta::latest()->where('tip_masa', '1')->pluck('id'));
//            $lenmd = count($micdejun);
//            array_push($crom, $micdejun[random_int(0, $lenmd - 1)]);
//
//
//            //Adaugam la cromozom o reteta de pranz aleatoare
//            $pranz = json_decode(Reteta::latest()->where('tip_masa', '2')->where('is_active',1)->pluck('id'));
//            $lenp = count($pranz);
//            array_push($crom, $pranz[random_int(0, $lenp - 1)]);
//
//            //Adaugam la cromozom o reteta de cina aleatoare
//            $cina = json_decode(Reteta::latest()->where('tip_masa', '3')->pluck('id'));
//            $lenc = count($cina);
//            array_push($crom, $cina[rand(0, $lenc - 1)]);
//
//            //Adaugam la cromozom doua retete de gustare
//            $gustare = json_decode(Reteta::latest()->where('tip_masa', '4')->pluck('id'));
//            $leng = count($gustare);
//            array_push($crom, $gustare[rand(0, $leng - 1)]);
//            array_push($crom, $gustare[rand(0, $leng - 1)]);
//            $suma=$this->calculCarbo($crom)+$this->calculProt($crom)+$this->calculGrasimi($crom)+$this->calculCalorii($crom);
//            array_push($crom,9+$suma);
//
//            //adaugam cromozomul la lista
//            array_push($listacrom, $crom);
//
//        }
//
//
//
//        //selectia parintilor
//        $parinti=array();
//
//        for($j=0;$j<sizeof($listacrom);$j++) {
//            $rand = (float)rand(1, 100);
//            if ($rand < 75) {
//                array_push($listacrom[$j], $j);
//                array_push($parinti, $listacrom[$j]);
//            }
//        }
//
//
//        $nrparinti=sizeof($parinti);
//        $i=0;
//        while($i<$nrparinti-1) {
//            //selectam cate doi parinti
//            $parinte1=$parinti[$i];
//            $parinte2=$parinti[$i+1];
//            //creem copiii
//            $copil1=$parinte1;
//            $copil2=$parinte2;
//            //luam o gena la intamplare
//            $punct=rand(0,4);
//            //interschimbam genele
//            $aux=$copil1[$punct];
//            $copil1[$punct]=$copil2[$punct];
//            $copil2[$punct]=$aux;
//            $suma=$this->calculCarbo($copil1)+$this->calculProt($copil1)+$this->calculGrasimi($copil1)+$this->calculCalorii($copil1);
//            $copil1[5]=9+$suma;
//            $suma=$this->calculCarbo($copil2)+$this->calculProt($copil2)+$this->calculGrasimi($copil2)+$this->calculCalorii($copil2);
//            $copil2[5]=9+$suma;
//            //calculam din nou functia fitness
//
//            //inlocuim parintii cu copii
//            $parinti[$i]=$copil1;
//            $parinti[$i+1]=$copil2;
//
//            $listacrom[$parinti[$i][6]]=$parinti[$i];
//            array_pop($listacrom[$parinti[$i][6]]);
//
//            $listacrom[$parinti[$i+1][6]]=$parinti[$i+1];
//            array_pop($listacrom[$parinti[$i+1][6]]);
//
//            $i=$i+2;
//        }
//
//
//
//
//        //calculam totalul functiilor fitness
//        $totalprob = $this->calculTotalProb($listacrom);
//        //calculam pentru fiecare cromozom probabilitatea sa
//        $listacrom = $this->calculProb($listacrom, $totalprob);
//        //gasim primul element care are prob mai mare decat numarul random si o introducem in survivors
//        //initializam lista cromozomilor care supravietuiesc si avanseaza in urmatoarea generatie
//        $survivors=array();
//
//        for ($i = 0; $i < sizeof($listacrom); $i++) {
//            $rand = rand(0, 1000) / 1000;
//            $ok = 1;
//            for ($j = 0; $j < sizeof($listacrom); $j++)
//                if ($ok == 1) {
//                    if ($listacrom[$j][6] >= $rand) {
//                        array_push($survivors, $listacrom[$j]);
//                        $ok = 0;
//                    }
//
//                }
//        }
//
//
//
//        $rata_mutatie=0.05;
//        //avem crossover-ul efectuat,mai trebuie mutatia(random la un element al array-ului)
//            $total_gene=sizeof($survivors)*5;
//            $num_mutatii=ceil($rata_mutatie*$total_gene);
//
//            while($num_mutatii>0) {
//
//                $nr_rand = rand(0, sizeof($survivors) - 1);
//                $elementmutat = $survivors[$nr_rand];
//                $masa = rand(0, 4);
//
//                if ($masa == 0) {
//                    $micdejun = json_decode(Reteta::latest()->where('tip_masa', '1')->pluck('id'));
//                    $lenmd = count($micdejun);
//                    $elementmutat[0] = $micdejun[rand(0, $lenmd - 1)];
//                    $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                    $elementmutat[5]=9+$suma;
//                } elseif ($masa == 1) {
//                    $pranz = json_decode(Reteta::latest()->where('tip_masa', '2')->pluck('id'));
//                    $lenmd = count($pranz);
//                    $elementmutat[1] = $pranz[rand(0, $lenmd - 1)];
//                    $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                    $elementmutat[5]=9+$suma;
//                } elseif ($masa == 2) {
//                    $pranz = json_decode(Reteta::latest()->where('tip_masa', '3')->pluck('id'));
//                    $lenmd = count($pranz);
//                    $elementmutat[2] = $pranz[rand(0, $lenmd - 1)];
//                    $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                    $elementmutat[5]=9+$suma;
//                } elseif ($masa == 3) {
//                    $pranz = json_decode(Reteta::latest()->where('tip_masa', '4')->pluck('id'));
//                    $lenmd = count($pranz);
//                    $elementmutat[3] = $pranz[rand(0, $lenmd - 1)];
//                    $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                    $elementmutat[5]=9+$suma;
//                } elseif ($masa == 4) {
//                    $pranz = json_decode(Reteta::latest()->where('tip_masa', '4')->pluck('id'));
//                    $lenmd = count($pranz);
//                    $elementmutat[4] = $pranz[rand(0, $lenmd - 1)];
//                    $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                    $elementmutat[5]=9+$suma;
//                }
//
//                $survivors[$nr_rand] = $elementmutat;
//                $num_mutatii--;
//            }
//
//            for($i=0;$i<sizeof($survivors);$i++)
//                array_pop($survivors[$i]);
//
//        return $this->pas(2,$survivors);
//
//        //Trebuie sa afisam suma functiei fitness, caloriile totale, prot totale, carb totale si cromozomul
//    }
//
//
//    public function pas($nrpas,$listacrom){
//        set_time_limit(30);
//        $parinti=array();
//
//        for($j=0;$j<sizeof($listacrom);$j++) {
//            $rand = (float)rand(1, 100);
//            if ($rand < 75) {
//                array_push($listacrom[$j], $j);
//                array_push($parinti, $listacrom[$j]);
//            }
//        }
//
//
//        $nrparinti=sizeof($parinti);
//        $i=0;
//        while($i<$nrparinti-1) {
//            //selectam cate doi parinti
//            $parinte1=$parinti[$i];
//            $parinte2=$parinti[$i+1];
//            //creem copiii
//            $copil1=$parinte1;
//            $copil2=$parinte2;
//            //luam o gena la intamplare
//            $punct=rand(0,4);
//            //interschimbam genele
//            $aux=$copil1[$punct];
//            $copil1[$punct]=$copil2[$punct];
//            $copil2[$punct]=$aux;
//
//            //calculam din nou functia fitness
//            $suma=$this->calculCarbo($copil1)+$this->calculProt($copil1)+$this->calculGrasimi($copil1)+$this->calculCalorii($copil1);
//            $copil1[5]=9+$suma;
//            $suma=$this->calculCarbo($copil2)+$this->calculProt($copil2)+$this->calculGrasimi($copil2)+$this->calculCalorii($copil2);
//            $copil2[5]=9+$suma;
//
//            //inlocuim parintii cu copii
//            $parinti[$i]=$copil1;
//            $parinti[$i+1]=$copil2;
//
//
//
//
//
//            //ii punem in locul parintilor
//            $listacrom[$parinti[$i][6]]=$parinti[$i];
//            array_pop($listacrom[$parinti[$i][6]]);
//            $listacrom[$parinti[$i+1][6]]=$parinti[$i+1];
//            array_pop($listacrom[$parinti[$i+1][6]]);
//
//            $i=$i+2;
//        }
//
//
//
//
//        //calculam totalul functiilor fitness
//        $totalprob = $this->calculTotalProb($listacrom);
//        //calculam pentru fiecare cromozom probabilitatea sa
//        $listacrom = $this->calculProb($listacrom, $totalprob);
//        //gasim primul element care are prob mai mare decat numarul random si o introducem in survivors
//        //initializam lista cromozomilor care supravietuiesc si avanseaza in urmatoarea generatie
//        $survivors=array();
//
//        for ($i = 0; $i < sizeof($listacrom); $i++) {
//            $rand = rand(0, 1000) / 1000;
//            $ok = 1;
//            for ($j = 0; $j < sizeof($listacrom); $j++)
//                if ($ok == 1) {
//                    if ($listacrom[$j][6] >= $rand) {
//                        array_push($survivors, $listacrom[$j]);
//                        $ok = 0;
//                    }
//
//                }
//        }
//
//
//
//        $rata_mutatie=0.05;
//        //avem crossover-ul efectuat,mai trebuie mutatia(random la un element al array-ului)
//        $total_gene=sizeof($survivors)*5;
//        $num_mutatii=ceil($rata_mutatie*$total_gene);
//        while($num_mutatii>0) {
//
//            $nr_rand = rand(0, sizeof($survivors) - 1);
//            $elementmutat = $survivors[$nr_rand];
//            $masa = rand(0, 4);
//
//            if ($masa == 0) {
//                $micdejun = json_decode(Reteta::latest()->where('tip_masa', '1')->pluck('id'));
//                $lenmd = count($micdejun);
//                $elementmutat[0] = $micdejun[rand(0, $lenmd - 1)];
//                $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                $elementmutat[5]=9+$suma;
//            } elseif ($masa == 1) {
//                $pranz = json_decode(Reteta::latest()->where('tip_masa', '2')->pluck('id'));
//                $lenmd = count($pranz);
//                $elementmutat[1] = $pranz[rand(0, $lenmd - 1)];
//                $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                $elementmutat[5]=9+$suma;
//            } elseif ($masa == 2) {
//                $pranz = json_decode(Reteta::latest()->where('tip_masa', '3')->pluck('id'));
//                $lenmd = count($pranz);
//                $elementmutat[2] = $pranz[rand(0, $lenmd - 1)];
//                $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                $elementmutat[5]=9+$suma;
//            } elseif ($masa == 3) {
//                $pranz = json_decode(Reteta::latest()->where('tip_masa', '4')->pluck('id'));
//                $lenmd = count($pranz);
//                $elementmutat[3] = $pranz[rand(0, $lenmd - 1)];
//                $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                $elementmutat[5]=9+$suma;
//            } elseif ($masa == 4) {
//                $pranz = json_decode(Reteta::latest()->where('tip_masa', '4')->pluck('id'));
//                $lenmd = count($pranz);
//                $elementmutat[4] = $pranz[rand(0, $lenmd - 1)];
//                $suma=$this->calculCarbo($elementmutat)+$this->calculProt($elementmutat)+$this->calculGrasimi($elementmutat)+$this->calculCalorii($elementmutat);
//                $elementmutat[5]=9+$suma;
//            }
//
//            $survivors[$nr_rand] = $elementmutat;
//            $num_mutatii--;
//        }
//
//        for($i=0;$i<sizeof($survivors);$i++)
//            array_pop($survivors[$i]);
//
//        if($nrpas==100) {
//            return $survivors;
//        }
//        else {
//            if($nrpas==25 || $nrpas==50 || $nrpas==75){
//                print_r(time());
//            }
//            $nrpas++;
//            return $this->pas($nrpas, $survivors);
//        }
//
//    }


//    public function calculProb($listacrom,$total){
//        for($i=0;$i<sizeof($listacrom);$i++){
//            if($i==0)
//                $listacrom[$i][6]=round($listacrom[$i][5]/$total,6);
//            else $listacrom[$i][6]=round($listacrom[$i][5]/$total+$listacrom[$i-1][6],6);
//        }
//        return $listacrom;
//    }

}







