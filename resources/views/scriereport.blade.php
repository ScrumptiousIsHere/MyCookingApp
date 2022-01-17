<x-layout>
    <title>Report {!! $reteta->titlu !!}</title>
    <div class="container" style="min-width: 300px; max-width: 300px">
        <div class="text-center">
            <form class="form-signin" action="submitreport/{{$reteta->id}}" method="post">
                @csrf
                <h1 class="mb-3">Raporteaza reteta "{!!$reteta->titlu!!}"</h1>


                <div class="mb-5" id="ingrediente" >
                    <label for="inputcategorie">Alegeti motivul:</label>
                    <select name="inputmotiv" id="inputcategorie" class="form-control" required="">
                        <option value="1">Categorie incompatibila</option>
                        <option value="2">Ingrediente invalide</option>
                        <option value="3">Reteta necorespunzatoare</option>
                    </select>

                    <label for="inputtext">Descrieti problema raportata</label>
                    <textarea class="form-control" required="" id="inputtext" name="inputtext"></textarea>
                </div>

                <input type="hidden" id="inputreteta" name="reteta"  value="{{$reteta->id}}">
                <button class="btn btn-lg btn-primary btn-block mb-3" type="submitreport/{{$reteta->id}}">Submit report</button>
            </form>
        </div>
    </div>
</x-layout>
