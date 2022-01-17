@props(['ingredient'])



<div class="container pb-0 mb-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <h2 class="card-title"></h2>
                    <a href="/ingrediente/{{$ingredient->id}}">
                        {{ $ingredient->nume }}
                    </a>
                    <a href="/editingredient/{{$ingredient->id}}"><button class="btn btn-secondary">Edit</button></a>
                    <form class="form-signin " action="deleteingredient" method="post">
                        @csrf
                        <input type="hidden" id="inputuser" name="user"  value="{{$ingredient->id}}">
                        <button class="btn btn-danger" type="deleteingredient">Sterge</button>
                    </form>






                <p class="card-text">
                    Scris de catre {{$ingredient->user->username}}
                </p>
                <p>Valori nutritionale per 100g:</p>


                <ul class="list-group">


                @foreach($ingredient->continut as $continut)
                        <li class="list-group-item">{{$continut->nutrient->nume}}:{{$continut->cantitate}}{{$continut->nutrient->UM}}</li>
                @endforeach
                </ul>






            </div>
        </div>
    </div>
</div>
