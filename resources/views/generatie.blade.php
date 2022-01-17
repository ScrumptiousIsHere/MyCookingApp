@prop

<x-layout>
    <div class="container-fluid bg-warning">
        @for($i=0;$i<5;$i++)
            @php($reteta=App\Models\Reteta::where('id',$program[$i])->first())
            <div class="row p-3 m-3 bg-success">
                <div class="card">
                    <h2 class="card-title">{!! \App\Models\categorieReteta::where('id',$reteta->tip_masa)->pluck('tip')[0] !!}</h2>
                    <a href="/retete/{!!$reteta->id!!}">{{$reteta->titlu}}</a>
                </div>
            </div>
        @endfor
    </div>
</x-layout>
