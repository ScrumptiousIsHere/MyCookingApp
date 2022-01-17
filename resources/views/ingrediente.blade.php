<x-layout>
    <title>Ingredientele mele</title>
    <div class="container min-vh-100">
        <div class="jumbotron border-dark bg-success border">
            <h1 class="text-white">Ingredientele mele</h1>
        </div>
        <div class="container border-success bg-success text-center">
            <h1 class=""><a href="/adaugaingredient">Adauga un ingredient nou</a></h1>
        </div>



        @for($i=0;$i<sizeof($ingrediente);$i++)
            @if($i %3==0)
                <x-col4L :ingredient="$ingrediente[$i]"/>
            @elseif($i%3==1)
                <x-col4M :ingredient="$ingrediente[$i]"/>
            @elseif($i%3==2)
                <x-col4R :ingredient="$ingrediente[$i]"/>

            @endif
        @endfor
        @if(sizeof($ingrediente)%3==1 || sizeof($ingrediente)%3==2)
            </div>
            </div>
        @endif

    </div>




</x-layout>








