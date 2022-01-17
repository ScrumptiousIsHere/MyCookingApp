@props(['reteta'])


<div class="container-fluid p-5 mb-0">
    <div class="row">
        <div class="col-md-6 w-75 p-0 text-white">
            <div class="card mt-5 bg-success p-3 mr-5" >
                @if(isset($reteta->imagine))
                    <img src="{{url('/images/'.$reteta->imagine)}}" class="card-img-top h-20 w-100 p-1" alt="Image"/>
                @else
                    <img src="{{url('/images/missing.jpg')}}" class="card-img-top h-20 w-100 p-1" alt="Image"/>
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



                <p>{{ $reteta->descriere }}</p>


            </div>
        </div>
