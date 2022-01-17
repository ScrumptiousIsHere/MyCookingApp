<x-layout>
    <title>{!!$ingredient->nume!!}</title>

    <div class="container min-vh-100">
        <div class="jumbotron border-secondary bg-dark border min-vw-75">
            <h1 class="card-title text-white">{{ $ingredient->nume }}</h1>
        </div>

        <div class="container bg-dark border-secondary pb-3">
            <div class="row p-2">
                <div class="col-md-6 border border-secondary p-2 text-white">
                    <h3>Informatii nutritionale per 100 {!! $ingredient->UM !!}</h3>
                    <br>
                    @php($suma=0)
                    @foreach($ingredient->continut as $continut)
                        @if($continut->nutrient->nume=='Proteina' || $continut->nutrient->nume=='Carbohidrat' || $continut->nutrient->nume=='Grasime')
                        @php($suma=$suma+$continut->cantitate*$continut->nutrient->calorii)
                        @endif
                    @endforeach



                    <div class="container border-start border-end border-secondary">

                        <div class="row border-top border-secondary justify-content-between">
                            <p class="p-2 mb-0">Calorii:</p>
                            <p class="p-2 mb-0">{!!$suma!!} kcal</p>
                        </div>

                        @foreach($ingredient->continut as $continut)
                            @if($continut->nutrient->nume=='Proteina')
                                @php($proteina=$continut->cantitate)
                            @elseif($continut->nutrient->nume=='Carbohidrat')
                                @php($carbo=$continut->cantitate)
                            @elseif($continut->nutrient->nume=='Grasime')
                                @php($grasime=$continut->cantitate)
                            @endif
                            <div class="row border-top border-secondary justify-content-between">
                                <p class="p-2 mb-0">{!! $continut->nutrient->nume !!}:</p>
                                <p class="p-2 mb-0">{!! $continut->cantitate !!} {!! $continut->nutrient->UM !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6 border border-secondary text-white">
                    <div class="row">
                        <div class="h-100 w-100 m-2">
                            <div class="card-body text bg-secondary">
                                <canvas style="width:100%;height: 100%" id="procente"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="row m-2">
                        <p>Densitatea calorica: {!! $suma/100 !!} kcal/{!! $ingredient->UM !!}</p>
                        <p>Acest produs se incadreaza in categoria {!! \App\Models\categoriiIngredient::where('id',$ingredient->categorii_ingredient_id)->pluck('tip')[0] !!} si contine {!! $suma !!} calorii la 100{!! $ingredient->UM !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="{{url('/')}}/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", startchart({{$suma}},{{$proteina}},{{$grasime}},{{$carbo}}));
    </script>
</x-layout>
