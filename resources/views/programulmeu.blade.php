<x-layout>
    <title>Programul meu</title>
    <div class="container  text-dark" style="min-width: 80%">

        <div class="jumbotron border-secondary bg-dark border">
            <h1 class="blog-post-title">Programul meu</h1>
        </div>

        <br>

        <div class="container-fluid bg-success text-center pb-2">
            <h2 class="p-2">Situatie generala</h2>
            @php($user=Auth::user())
            <div class="row p-2">
                <div class="col-md-6 bg-light border border-secondary">
                    <h2>Caracteristici personale</h2>

                    <div class="row border-top border-secondary justify-content-between">
                        <p class="p-2 mb-0">Gen:</p>
                        <div>
                            @if($user->sex==1)
                                <p class="p-2 mb-0">M</p>
                            @elseif($user->sex==0)
                                <p class="p-2 mb-0">F</p>
                            @endif
                        </div>
                    </div>

                    <div class="row border-top border-secondary justify-content-between">
                        <p class="p-2 mb-0">Inaltime:</p>
                        <p class="p-2 mb-0">{!! $user->inaltime !!} cm</p>
                    </div>

                    <div class="row border-top border-secondary justify-content-between">
                        <p class="p-2 mb-0">Greutate</p>
                        <p class="p-2 mb-0">{!! $user->greutate !!} kg</p>
                    </div>



                    <div class="row border-top border-secondary justify-content-between">
                        <p class="p-2 mb-0">Varsta:</p>
                        @php($datatest=new DateTime($user->data_nasterii))
                        @php($data1=DateTime::createFromFormat("Y-m-d",$user->data_nasterii))
                        @php($diff = date_diff($datatest, new DateTime('now'),1))

                        <p class="p-2 mb-0">{!!  $diff->format("%Y ani")!!}</p>
                    </div>

                    <div class="row border-top border-secondary justify-content-between">
                        <p class="p-2 mb-0">Nivel de activitate:</p>
                        @php($na=$user->grad_activitate)
                        @if($na==1)
                            <p class="p-2 mb-0">Sedentar</p>
                        @elseif($na==2)
                            <p class="p-2 mb-0">Putin activ(1-2 zile/sapt)</p>
                        @elseif($na==3)
                            <p class="p-2 mb-0">Moderat activ(3-5 zile/sapt)</p>
                        @elseif($na==4)
                            <p class="p-2 mb-0">Foarte activ(6-7 zile/sapt)</p>
                        @elseif($na==5)
                            <p class="p-2 mb-0">Extra activ(foarte activ si job solicitant fizic)</p>
                        @endif

                    </div>
                    @php($total=0)
                    <div class="row border-top border-secondary justify-content-between">
                        <p class="p-2 mb-0">Necesar caloric zilnic:</p>
                        @if($user->sex==1)
                            @php($bmr=$user->greutate*10+6.25*$user->inaltime-5*$diff->format("%Y")+5)
                            @if($na==1)
                                @php($total=$bmr*1.2)
                            @elseif($na==2)
                                @php($total=$bmr*1.4)
                            @elseif($na==3)
                                @php($total=$bmr*1.6)
                            @elseif($na==4)
                                @php($total=$bmr*1.75)
                            @elseif($na==5)
                                @php($total=$bmr*2)
                            @endif


                        @elseif($user->sex==0)
                            @php($bmr=$user->greutate*10+6.25*$user->inaltime-5*$diff->format("%Y")-161)
                            @if($na==1)
                                @php($total=$bmr*1.2)
                            @elseif($na==2)
                                @php($total=$bmr*1.4)
                            @elseif($na==3)
                                @php($total=$bmr*1.6)
                            @elseif($na==4)
                                @php($total=$bmr*1.75)
                            @elseif($na==5)
                                @php($total=$bmr*2)
                            @endif
                        @endif

                        <p class="pb-0 mb-0">{!! $total !!} kcal</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 bg-light">
                        <div class="card-body text">
                            <canvas class="text-dark" style="width:100%;height: 100%" id="procente"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    @if($user->sex==1)
                        @php($gen=0)
                    @elseif($user->sex==0)
                        @php($gen=1)
                    @endif
                    @php($const=-44.988)
                    @php($bmi=$user->greutate)
                    @php($powa=pow($user->inaltime/100,2))
                    @php($bmi=$bmi/$powa)
                    @php($bf=$const+0.503 * $diff->format("%Y")+10.689 * $gen)
                    @php($bf=$bf+(3.172) * $bmi)
                    @php($bf=$bf-(0.026) * pow($bmi,2))
                    @php($bf=$bf+(0.181) * $bmi*$gen)
                    @php($ceva1=-0.02)
                    @php($ceva2=-0.005)
                    @php($bf=$bf+$ceva1 * $bmi * $diff->format("%Y"))
                    @php($bf=$bf+$ceva2 * pow($bmi,2) * $gen+ (0.00021 * pow($bmi,2) * $diff->format("%Y")))
                        <p class="text-white" style="text-align: center; vertical-align: middle; line-height: 311px">Procentajul tau estimativ de grasime este: {{number_format((float)$bf, 2, '.', '')}}%</p>
                </div>

                <div class="col-md-6">
                    <ul class="list-group pb-3">

                        <li class="text-dark list-group-item"><b><i>Lista procentajelor de grasime pe categorii:</i></b></li>

                        @if($user->sex==1)
                            @if($bf<2)
                                <li class="text-dark list-group-item" style="background-color: coral">Nivel extrem de mic de grasime <2%</li>
                            @else
                                <li class="text-dark list-group-item">Nivel extrem de mic de grasime <2%</li>
                            @endif

                            @if($bf>=2 && $bf<6)
                                <li class="text-dark list-group-item" style="background-color: coral">Grasime esentiala: 2-5%</li>
                            @else
                                <li class="text-dark list-group-item">Grasime esentiala: 2-5%</li>
                            @endif


                            @if($bf>=6 && $bf<14)
                                <li class="text-dark list-group-item" style="background-color: coral">Atleti: 6-13%</li>
                            @else
                                <li class="text-dark list-group-item">Atleti: 6-13%</li>
                            @endif



                            @if($bf>=14 && $bf<18)
                                <li class="text-dark list-group-item" style="background-color: coral">Fitness: 14-17%</li>
                            @else
                                <li class="text-dark list-group-item">Fitness: 14-17%</li>
                            @endif


                            @if($bf>=18 && $bf<25)
                                <li class="text-dark list-group-item" style="background-color: coral">Medie: 18-24%</li>
                            @else
                                <li class="text-dark list-group-item">Medie: 18-24%</li>
                            @endif

                            @if($bf>25)
                                <li class="text-dark list-group-item" style="background-color: coral">Obez: 25%+</li>
                            @else
                                    <li class="text-dark list-group-item">Obez: 25%+</li>
                            @endif

                        @elseif($user->sex==0)
                            @if($bf<10)
                                <li class="text-dark list-group-item" style="background-color: coral">Nivel extrem de mic de grasime <10%</li>
                            @else
                                <li class="text-dark list-group-item">Nivel extrem de mic de grasime <10%</li>
                            @endif

                            @if($bf>10 && $bf<14)
                                <li class="text-dark list-group-item" style="background-color: coral">Grasime esentiala: 10-13%</li>
                            @else
                                <li class="text-dark list-group-item">Grasime esentiala: 10-13%</li>
                            @endif


                            @if($bf>=14 && $bf<21)
                                <li class="text-dark list-group-item" style="background-color: coral">Atleti: 14-20%</li>
                            @else
                                <li class="text-dark list-group-item">Atleti: 14-20%</li>
                            @endif



                            @if($bf>=21 && $bf<25)
                                <li class="text-dark list-group-item" style="background-color: coral">Fitness: 21-24%</li>
                            @else
                                <li class="text-dark list-group-item">Fitness: 21-24%</li>
                            @endif


                            @if($bf>=25 && $bf<32)
                                <li class="text-dark list-group-item" style="background-color: coral">Medie: 25-31%</li>
                            @else
                                <li class="text-dark list-group-item">Medie: 25-31%</li>
                            @endif

                            @if($bf>32)
                                <li class="text-dark list-group-item" style="background-color: coral">Obez: 32%+</li>
                            @else
                                <li class="text-dark list-group-item">Obez: 32%+</li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>


            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3 bg-light mb-1 ml-1 border rounded">
                    <h2 class="text-center"><u>Carbohidrati, zaharuri si fibre:</u></h2>
                    @php($min=$total*45/100)
                    @php($max=$total*65/100)
                    <p class="mb-0">Cantitatea totala de carbohidrati trebuie sa se incadreze intre 45 si 65% din energia totala:</p>
                    <p class="mb-4">{{number_format((float)$min/4, 2, '.', '')}} - {{number_format((float)$max/4, 2, '.', '')}} grame ({{number_format((float)$min, 2, '.', '')}} - {{number_format((float)$max, 2, '.', '')}} kcal)</p>
                    <p class="mb-0">Carbohidrati simpli(Zaharuri) - max. 10% din energia totala:</p>
                    <p class="mt-0 mb-5">Mai putin de {{number_format((float)$total/10/4, 0, '.', '')}} grame ({{$total/10}} kcal)</p>
                    <p>Fibre - {{number_format((float)14*$total/1000, 0, '.', '')." grame"}} (14 grame/1000 kcal consumate)</p>
                    <p></p>
                </div>

                <div class="col-md-4 bg-light mb-1 ml-1 border rounded">
                    <h2 class="mb-5 text-center"><u>Grasimi:</u></h2>
                    @php($min=$total*20/100)
                    @php($max=$total*35/100)
                    <p class="mb-0">Cantitatea totala de grasimi trebuie sa se incadreze intre 20 si 35% din energia totala:</p>
                    <p class="mb-5">{{number_format((float)$min/9, 0, '.', '')}} - {{number_format((float)$max/9, 0, '.', '')}} grame ({{number_format((float)$min, 2, '.', '')}} - {{number_format((float)$max, 2, '.', '')}} kcal)</p>
                    <p class="mb-0">Grasimi saturate - max. 10% din energia totala:</p>
                    <p class="mt-0 mb-5">Mai putin de {{number_format((float)$total/10/9, 0, '.', '')}} grame ({{$total/10}} kcal)</p>
                </div>

                <div class="col-md-3 bg-light mb-1 ml-1 border rounded" style="max-height: 400px; overflow-y: scroll">
                    <h2 class="mb-5 text-center"><u>Proteine:</u></h2>
                    <h5><u>Recomandari generale:</u></h5>
                    <p class="pb-0 pt-0">Organizatia Mondiala a Sanatatii recomanda consumul a 0.83 grame de proteine per kilogram al corpului: {{0.83*$user->greutate}} grame ({{0.83*$user->greutate*4}})</p>
                    <h5><u>Aportul de proteine in sport:</u></h5>
                    <p class="mb-0 pt-0">0.8 g per kg al corpului pentru persoanele care nu exercita activitate fizica:{{0.8*$user->greutate}} grame ({{0.8*4*$user->greutate}})</p>
                    <hr>
                    <p class="mb-0 pt-0">1 g per kg al corpului pentru persoanele care exercita putina activitate fizica:{{1*$user->greutate}} grame ({{1*4*$user->greutate}})</p>
                    <hr>
                    <p class="mb-0 pt-0">1.3 g per kg al corpului pentru persoanele care exercita activitate fizica moderata:{{1.3*$user->greutate}} grame ({{1.3*4*$user->greutate}})</p>
                    <hr>
                    <p class="mb-0 pt-0">1.6 g per kg al corpului pentru persoanele care exercita activitate fizca intensa:{{1.6*$user->greutate}} grame ({{1.6*4*$user->greutate}})</p>
                    <hr>
                    <p class="mb-0 pt-0">2 g per kg al corpului - limita superioara pentru activitatea fizica de forta/putere:{{2*$user->greutate}} grame ({{2*4*$user->greutate}})</p>
                    <hr>
                    <p><span class="text-danger">Atentie!!!</span> Consumul a mai mult de 2 grame per kilogram al corpului poate duce la abnormalitati digestive, renale si vasculare si este de preferinta de evitat.</p>
                </div>
            </div>
            <form method="get" action="/functie">
            <button class="form-control mb-5">Genereaza plan de alimentatie pentru o zi</button>
            </form>
        </div>

        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>
        <script src="{{url('/')}}/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", aratacalorii({{$total}},{{$total*12.5/100}},{{$total*27.5/100}},{{$total*60/100}}));
        </script>
    </div>
</x-layout>
