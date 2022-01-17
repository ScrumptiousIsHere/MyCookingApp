@props(['ingredient'])


        <div class="col-md-4">
            <div class="card bg-success mt-5 p-2">
                <h2 class="card-title">
                    <div class="container">
                        <div class="row">
                            <a href="/ingredient/{{$ingredient->id}}">
                                {{ $ingredient->nume }}
                            </a>
                            <a href="/editingredient/{{$ingredient->id}}"><button class="btn btn-secondary">Edit</button></a>
                            <form action="deleteingredient" method="post" onsubmit="return confirm('Esti sigur ca doresti sa stergi ingredientul?');">
                                @csrf
                                <input type="hidden" id="inputuser" name="user"  value="{{$ingredient->id}}">
                                <button class="btn btn-danger" type="deleteingredient">Sterge</button>
                            </form>
                        </div>
                    </div>
                </h2>

                <p class="card-text">
                    Scris de catre {{$ingredient->user->username}}
                </p>

                <p class="card-text">Valori nutritionale per 100g:</p>

                <ul class="list-group">

                    @php($suma=0)
                    @foreach($ingredient->continut as $continut)
                        @if($continut->nutrient->id==1 || $continut->nutrient->id==2 || $continut->nutrient->id==3)
                            @php($suma=$suma+$continut->cantitate*$continut->nutrient->calorii)
                        @endif
                    @endforeach

                    <li class="list-group-item">{{'Calorii: '.$suma.'kcal/'.floor($suma*4.184).'kJ'}}</li>

                    @foreach($ingredient->continut as $continut)
                        <li class="list-group-item">{{$continut->nutrient->nume}}:{{$continut->cantitate}}{{$continut->nutrient->UM}}</li>
                    @endforeach
                </ul>






            </div>
        </div>
