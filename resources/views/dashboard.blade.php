<x-layout>
    <title>Acasa</title>

    <div class="container w-75">
        <div class="jumbotron p-3 p-md-5 mb-0 text-white bg-success">
            <div class="col-md-4 px-0">
                <h1 class="display-4 font-italic">Aplicatia pentru retete de gatit MyCookingApp</h1>
                <p class="lead my-3">Aplicatia perfecta pentru resuscitarea stilului tau de viata sanatos!</p>
            </div>
            <div class="col-md-8"></div>
        </div>


        <div class="jumbotron-fluid p-3 p-md-5 mb-0 bg-light">
            <div class="row">
                <div class="col-md-8 px-0">
                </div>
                <div class="col-md-4 px-0">
                    <h2 class="display-5 font-italic">Software de nutritie</h2>
                    <p class="lead my-3">Locul in care gasesti tot ce ai nevoie pentru a-ti stoca si organiza retetele
                        si pentru a descoperi retete noi.</p>
                </div>
            </div>
        </div>


        <div class="jumbotron-fluid p-3 p-md-5 mb-0 text-white bg-dark">
            <div class="row">
                <div class="col-md-4 px-0">
                    <h2 class="display-5 font-italic">Este la un click distanta oriunde te afli</h2>
                    <p class="lead my-3">Singurul lucru de care ai nevoie este un dispozitiv cu acces la internet.</p>
                </div>
                <div class="col-md-8 px-0">
                </div>
            </div>
        </div>


        <div class="jumbotron-fluid p-3 p-md-5 mb-0 border-light border-1 border bg-light">
            <div class="row">
                <div class="col-md-8 px-0">
                </div>
                <div class="col-md-4 px-0">
                    <h2 class="display-5 font-italic">Vei avea acces la instrumente</h2>
                    <p class="lead my-3">care iti usureaza exponential munca pe care o depui pentru a calcula caloriile
                        si macronutrientii necesari.</p>
                    <p class="lead mb-0"><a href="/register" class="text-white font-weight-bold">

                            @if(!Auth::user())
                            <button class="btn btn-danger">Inregistreaza-te</button>
                            @endif
                        </a></p>
                </div>
            </div>
        </div>


    </div>


</x-layout>
