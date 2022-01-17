<x-layout>
    <br><br>
    <div class="container" style="min-width: 80%">
        @if(isset($report) && $report !='')
            @php($rep=$report)
                <div class="row">

                    <div class="jumbotron w-100 text-center bg-success">
                        <div class="col-md">
                            <h5>Autorul raportului: {{App\Models\User::where('id',$rep->user_id)->pluck('name')[0]}} {{App\Models\User::where('id',$rep->user_id)->pluck('prenume')[0]}}</h5>
                            <h5>User persoana care a raportat: {{App\Models\User::where('id',$rep->user_id)->pluck('username')[0]}}</h5>
                            <h3>Motivul raportului: {!! \App\Models\ReportCategorie::where('id',$rep->report_categories_id)->pluck('tip')[0] !!}</h3>
                            <h3>Descrierea:</h3>
                            <textarea disabled="" class="bg-white">{{$rep->motiv}}</textarea>
                            <br><br>

                            <hr>

                            @php($reteta=App\Models\Reteta::where('id',$rep->reteta_id)->first())
                            <h2>Reteta "<a class="card-text" href="/retete/{!!$reteta->id!!}">{!!$reteta->titlu!!}</a>"</h2>
                            <h5>Autorul retetei:{!!$reteta->user->name!!} {!!$reteta->user->prenume!!}</h5>
                            <h5>Username autor:{!!$reteta->user->username!!}</h5>

                            <h5>Categoria: {!! $reteta->tip_masa !!}</h5>
                            <hr>
                            <h5>Ingrediente:</h5>
                            <br>
                            @foreach($reteta->continut as $continut)
                                <div class="card p-5 m-5">
                                <h5 class="card-title">{!! $continut->cantitate." ".$continut->ingredient->UM !!} {!!$continut->ingredient->nume!!}</h5>
                                <p>Valorile nutritionale per 100g</p>
                                @foreach($continut->ingredient->continut as $continutingredient)
                                    <p class="card-text" class="m-1 p-0">{!! $continutingredient->nutrient->nume !!} {!! $continutingredient->cantitate !!}{!! $continutingredient->nutrient->UM !!}</p>
                                @endforeach
                                <br><br>
                                </div>
                            @endforeach
                            <form action="deletereport" method="post" onsubmit="return confirm('Esti sigur ca doresti sa stergi reteta?');">
                                @csrf
                                <input type="hidden" id="inputuser" name="user"  value="{{$reteta->id}}">
                                <input type="hidden" id="inputrep" name="report" value="{{$report->id}}">
                                <button class="btn btn-danger mb-3 mt-3" type="deletereport">Sterge reteta</button>

                            </form>

                            <form action="ignorereport" method="post" onsubmit="return confirm('Esti sigur ca doresti sa treci peste ?');">
                                @csrf
                                <input type="hidden" id="inputrep" name="report" value="{{$report->id}}">
                                <button class="btn btn-secondary mb-3 mt-3" type="ignorereport">Ignora raportul</button>
                            </form>
                        </div>
                    </div>
                </div>

        @else
            <h1>Totul este in regula</h1>
        @endif
    </div>
</x-layout>
