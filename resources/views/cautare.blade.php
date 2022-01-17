<x-layout>
    <script src="filter.js"></script>
    <title>Cautare</title>
    <div class="container align-content-center">
            <h2>Rezultatele cautarii</h2>
<br><br>
        <div id="test"></div>
        @if($details=="[]")
            <p>Ne pare rau, nu am gasit nimic.</p>
        @else
            <label for="filtruingredient">Filtreaza dupa ingredient</label>
            <input type="text" id="filtruingredient" class="form-control">
{{--            <button id="butonfiltru" class="form-control bg-success text-white">Filtreaza</button>--}}
            <br>

            <label>Filtreaza dupa calorii</label>
            <div class="row">

                <div class="col-md-6">
                    <label for="dela">De la:</label>
                    <input type="text" id="dela" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="panala">Pana la:</label>
                    <input type="text" id="panala" class="form-control">
                </div>
            </div>
            <label id="mesaj"></label>
        <br>
            <a href="javascript:;" id="butonfiltru" >Filtreaza</a>
            <button class="form-control" id="butonfiltru" onclick="reseteazaFiltre()">Reseteaza filtrele</button>
            <div hidden id="token">{!! csrf_token() !!}</div>
            <div hidden id="detalii">{!! $details !!}</div>

            @foreach(json_decode($details) as $element)
                @if($element>0)
                    @php($reteta=App\Models\Reteta::where('id',$element)->first())
                    <div id="{!! $reteta->id !!}" class="card p-2 text center">
                        @if(isset($reteta->imagine))
                            <img src="{{url('/images/'.$reteta->imagine)}}" class=" card-img-top h-20 w-100 p-1" style="max-height: 300px; max-width: 500px" alt="Image"/>
                        @else
                            <img src="{{url('/images/missing.jpg')}}" class=" card-img-top h-20 w-100 p-1" style="max-height: 300px; max-width: 500px" alt="Image"/>
                        @endif
                        <h2 class="card-title">
                            <a href="/retete/{{$reteta->id}}">
                                {{ $reteta->titlu }}
                            </a>
                        </h2>

                        <p class="card-text">
                            Scris de catre
                            <a href="/autori/{{ $reteta->user->username}}"> {{ $reteta->user->username }}  </a>
                            in categoria
                            {{ \App\Models\categorieReteta::where('id',$reteta->tip_masa)->pluck('tip')[0] }}
                        </p>

                            <p class="form-control">@php($calorii=0)
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
                                Calorii:<span id="caloriireteta{{$reteta->id}}">{{$calorii}}</span></p>

                        <p>{{ $reteta->descriere }}</p>
                    </div>
                @endif
            @endforeach
       @endif



    </div>
</x-layout>
