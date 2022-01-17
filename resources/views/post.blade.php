<x-layout>
    <title>{!!  $reteta->titlu!!}</title>
    <div class="container min-vh-100">
        <div class="jumbotron border-secondary bg-success border min-vw-75">
            <h1 class="card-title">{{ $reteta->titlu }}</h1>
        </div>
        <div class="container bg-success border-secondary min-vh-100 pb-3">

            <div class="container pb-0 mb-0 mt-3 ">
                <br>
                <div class="jumbotron bg-secondary p-1" >
                    <div class="row border-bottom border-dark" style="max-height: 400px">
                        <div class="col-md-6 mb-3 mt-3">
                                @if(isset($reteta->imagine))
                                    <img src="{{url('/images/'.$reteta->imagine)}}" class="h-100 w-100 mb-3 bt-3 border-secondary" alt="Image"/>
                                @else
                                    <img src="{{url('/images/missing.jpg')}}" class=" h-100 w-100 border-secondary" alt="Image"/>
                                @endif
                        </div>
                        <div class="col-md-6 mt-3 border-left border-dark">
                            <div class="row">
                                <div class="col-md-6">
                                <h2 class="blog-title">{{ $reteta->titlu }}</h2>
                                <p class="">
                                    Scris de catre
                                    <a class="text-white" href="/autori/{{ $reteta->user->username}}"> {{ $reteta->user->username }}  </a>
                                    in categoria
                                    {{ \App\Models\categorieReteta::where('id',$reteta->tip_masa)->pluck('tip')[0] }}
                                </p>
                                <p class="mb-0 pb-0">
                                    @php($calorii=0)

                                    @foreach($reteta->continut as $continut)
                                        @foreach($continut->ingredient->continut as $ingredient)


                                                @if($ingredient->nutrient->nume=='Proteina')
                                                    @php($calorii=$calorii+($continut->cantitate/100)*$ingredient->cantitate*$ingredient->nutrient->calorii)
                                                @elseif($ingredient->nutrient->nume=='Grasime')
                                                    @php($calorii=$calorii+(($continut->cantitate*$ingredient->cantitate)/100)*$ingredient->nutrient->calorii)
                                                @elseif($ingredient->nutrient->nume=='Carbohidrat')
                                                    @php($calorii=$calorii+($continut->cantitate/100)*$ingredient->cantitate*$ingredient->nutrient->calorii)
                                                @endif

                                        @endforeach
                                    @endforeach
                                    Calorii:{{$calorii}}
                                </p>
                                <p class="mb-0 pb-0">
                                    @php($proteine=0)
                                    @foreach($reteta->continut as $continut)
                                        @foreach($continut->ingredient->continut as $ingredient)
                                            @if($ingredient->nutrient->nume=='Proteina')
                                                @php($proteine=$proteine+($continut->cantitate/100)*$ingredient->cantitate)
                                            @endif
                                        @endforeach
                                    @endforeach
                                    Proteine:{{$proteine}}
                                </p>
                                <p class="mb-0 pb-0">
                                    @php($grasimi=0)
                                    @foreach($reteta->continut as $continut)
                                        @foreach($continut->ingredient->continut as $ingredient)
                                            @if($ingredient->nutrient->nume=='Grasime')
                                                @php($grasimi=$grasimi+($continut->cantitate/100)*$ingredient->cantitate)
                                            @endif
                                        @endforeach
                                    @endforeach
                                    Grasimi:{{$grasimi}}
                                </p>
                                <p class="mb-0 pb-0">
                                    @php($carbo=0)
                                    @foreach($reteta->continut as $continut)
                                        @foreach($continut->ingredient->continut as $ingredient)
                                            @if($ingredient->nutrient->nume=='Carbohidrat')
                                                @php($carbo=$carbo+($continut->cantitate/100)*$ingredient->cantitate)
                                            @endif
                                        @endforeach
                                    @endforeach
                                    Carbohidrati:{{$carbo}}
                                </p>




                        </div>
                            <div class="col-md-6">
                                <div class="card h-100 bg-secondary">
                                    <div class="card-body text">
                                        <canvas class="text-dark" style="width:100%;height: 100%" id="procente"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-dark mr-1">
                            <div class="col-md">
                            <div class="row">
                                <div class="col-md">
                                <h5>Ingrediente:</h5>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md">
                                    @foreach($reteta->continut as $continut)
                                        <p class="mb-0 pb-0">{!! $continut->cantitate !!}{!! $continut->ingredient->UM !!} {!! $continut->ingredient->nume !!}</p>
                                    @endforeach

                                    <br>
                                        @php($minute=$reteta->durata_gatire%60)
                                        @php($ore=$reteta->durata_gatire/60)
                                        @if($reteta->durata_gatire==1)
                                            <p>Durata de gatire: {{$reteta->durata_gatire}} minut</p>
                                        @elseif($reteta->durata_gatire<60)
                                            <p>Durata de gatire:{{$minute}} minute</p>
                                        @elseif($reteta->durata_gatire>=60)
                                            @if($minute==0)
                                                <p>Durata de gatire:{{$ore}} ore</p>
                                            @elseif($minute==1)
                                                @if(floor($ore)==1)
                                                    <p>Durata de gatire:{{floor($ore)}} ora si {{$minute}} minut</p>
                                                @else
                                                    <p>Durata de gatire:{{floor($ore)}} ore si {{$minute}} minut</p>
                                                @endif
                                            @else
                                                @if(floor($ore)==1)
                                                    <p>Durata de gatire:{{floor($ore)}} ora si {{$minute}} minute</p>
                                                @else
                                                    <p>Durata de gatire:{{floor($ore)}} ore si {{$minute}} minute</p>
                                                @endif

                                            @endif

                                        @endif
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="row text-center" style="max-height: 400px">
                        <div class="col-md-10">
                            <h2 class="text-left">Descriere</h2>
                            <hr>
                            <p class="text-left">{{ $reteta->descriere }}</p>
                        </div>

                        <div class="col-md-2">
                            <form action="/addfavorite" method="get">
                                @csrf
                                <input type="hidden" value="{!!  $reteta->id  !!}" name="inputreteta">
                                @if($reteta->autor != Auth::id())
                                    @if(\App\Models\favorit::where('user_id',Auth::id())->where('reteta_id',$reteta->id)->where('is_active',1)->first())
                                        <button class="btn btn-light btn-outline-dark" type="/addfavorite">Sterge marcajul de favorit</button>
                                    @else
                                        <button class="btn btn-light btn-outline-dark" type="/addfavorite">Marcheaza ca favorit</button>
                                    @endif
                                @endif
                            </form>




                                @if($reteta->user->id != Auth::id())
                                    <button onclick="document.location='/scriereport/{{$reteta->id}}'" class="mb-3 btn btn-primary">Raporteaza</button>
                                @endif

                        </div>
                    </div>
                </div>

                @foreach($reteta->pas as $pasreteta)
                <div class="jumbotron bg-secondary mb-3">
                    <h2>Pasul {{$pasreteta->nr_pas}}</h2>
                    <hr>
                    {{$pasreteta->Descriere}}
                </div>
                @endforeach


                <div class="container pb-0 mb-5 mt-6 text-center bg-secondary">
                    <div class="row mt-5 mb-3"><h2>Recenzii ({{$reteta->review->count()}})</h2></div>

                    <div class="row mb-3 mt-3">
                        @php($medie=0)
                        @php($nrreview=0)
                        @foreach($reteta->review as $recenzie)
                            @php($medie=$medie+$recenzie->nota)
                            @php($nrreview=$nrreview+1)
                        @endforeach


                        @if($medie==0 && $nrreview==0)
                            @if($reteta->user->id==Auth::id())
                                <h3>Aceasta reteta nu are recenzii.</h3>
                            @else
                                <h3>Aceasta reteta nu are recenzii. Fii primul care ofera o evaluare!</h3>
                            @endif
                        @else
                            <h7>In urma review-urilor lasate de utilizatori, aceasta reteta are nota {{$medie/$nrreview}}/5</h7>
                        @endif

                    </div>
                    <hr>
                </div>

                @foreach($reteta->review as $recenzie)
                    <div class="jumbotron text-left bg-secondary p-2 mb-1">
                        <div class="row">
                            <div class="col-md-3 border-right border-dark">
                            <p>Evaluare scrisa de catre {{$recenzie->user->username}}</p>
                            <p>{{$recenzie->nota}}/5 stele</p>
                            </div>
                            <div class="col-md-9">
                            <p>{{$recenzie->continut}}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach

                @if(Auth::user())
                    @if(Auth::id()!=$reteta->user->id)
                    <button onclick="document.location='/scriereview/{{$reteta->id}}'" class="mb-3 btn btn-primary">Adauga o recenzie</button>
                    @endif
                @endif
            </div>
        </div>


        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>
        <script src="{{url('/')}}/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", startchart({{$calorii}},{{$proteine}},{{$grasimi}},{{$carbo}}));
        </script>

    </div>
</x-layout>
