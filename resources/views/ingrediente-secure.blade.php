<x-layout>
    <title>Descopera ingrediente</title>
    <div class="container min-vh-100 p-0" style=" min-width: 80%;">
        <div class="jumbotron border-success bg-success border">
            <h1 class="">Descopera ingrediente</h1>
        </div>

        <div class="container-fluid bg-white pb-5 mb-0" style="border-style: solid">

        @for($i=0;$i<sizeof($ingrediente);$i++)
            @if($i%3==0)
                <x-col4L-secure :ingredient="$ingrediente[$i]"/>

            @elseif($i%3==1)
                <x-col4M-secure :ingredient="$ingrediente[$i]"/>

            @elseif($i %3==2)
                <x-col4R-secure :ingredient="$ingrediente[$i]"/>

            @endif
        @endfor

        @if(sizeof($ingrediente)%3==1 || sizeof($ingrediente)%3==2)
            </div>

        @endif
    </div>
    </div>




</x-layout>








