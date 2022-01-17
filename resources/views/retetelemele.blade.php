<x-layout>
    <title>Retetele mele</title>
    <div class="container min-vh-100" style="min-width: 80%">
        <div class="jumbotron border-dark bg-success border">
            <h1 class="text-white">Retetele mele</h1>
        </div>
        <div class="container border-success bg-success text-center">
            <h1 class="text-white bg-success"><a href="/adaugareteta">Adauga o reteta noua</a></h1>
        </div>


        <div class="container-fluid bg-white p-5 mb-0" STYLE="border-style: solid">
        @for($i=0;$i<sizeof($retete);$i++)
            @if($i %2==0)
                <x-col6L :reteta="$retete[$i]"/>
            @else
                <x-col6R :reteta="$retete[$i]"/>
            @endif
        @endfor

        @if($numar%2==1)
    </div>

    @endif
    </div>
    </div>

</x-layout>








