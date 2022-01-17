@props(['reteta'])



    <div class="row">
        <div class="col-md-6 p-0 text-white">
            <div class="card mt-5 bg-success p-3 mr-5">
                @if(isset($reteta->imagine))
                    <img src="{{url('/images/'.$reteta->imagine)}}" class="card-img-top h-20 w-100 p-1" alt="Image"/>
                @else
                    <img src="{{url('/images/missing.jpg')}}" class="card-img-top h-20 w-100 p-1" alt="Image"/>
                @endif
                <div class="row">
                    <div class="col-md-10">
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


                    <div class="col-md-2">
                        <form action="deletereteta" method="post" onsubmit="return confirm('Esti sigur ca doresti sa stergi reteta?');">
                            @csrf
                            <input type="hidden" id="inputuser" name="user"  value="{{$reteta->id}}">
                            <button class="btn btn-danger mb-3 mt-3" type="deletereteta">Sterge reteta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
