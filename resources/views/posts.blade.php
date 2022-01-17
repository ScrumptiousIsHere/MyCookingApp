<x-layout>

    <title>Descopera retete</title>
    <div class="container min-vh-100" style="min-width: 80%">
        <div class="jumbotron w-100 border-dark bg-success border">
            <h1 class="text-white">Descopera retete</h1>
        </div>

        @for($i=0;$i<sizeof($retete);$i++)
            @if($i %2==0)
                <x-col6L-secure :reteta="$retete[$i]"/>
            @else
                <x-col6R-secure :reteta="$retete[$i]"/>
            @endif
        @endfor

        @if(sizeof($retete)%2==1)
                </div>
            </div>
        @endif

    </div>

</x-layout>








