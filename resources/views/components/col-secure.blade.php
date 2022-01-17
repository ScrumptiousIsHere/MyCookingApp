@props(['ingredient'])


<div class="container pb-0 mb-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <h2 class="card-title">
                    <a href="/ingrediente/{{$ingredient->id}}">
                        {{ $ingredient->nume }}
                    </a>
                </h2>

                <p class="card-text">
                    Scris de catre {{$ingredient->user->username}}
                </p>
                <p>Valori nutritionale per 100g:</p>

                <?php $continut=new App\Models\continutIngredient(); ?>
                <ul class="list-group">


                    @foreach($ingredient->continut as $continut)
                        <li class="list-group-item">{{$continut->nutrient->nume}}:{{$continut->cantitate}}{{$continut->nutrient->UM}}</li>
                    @endforeach
                </ul>






            </div>
        </div>
    </div>
</div>
