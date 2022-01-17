<x-layout>
    <br><br>
    <div class="container" style="min-width:80%">
        <div class="row">
            <div class="col-md-6">
                <label for="ingredient1">Alegeti ingredientul:</label>
                <select id="ingredient1" name="ingredient1" class="w-50 form-control">
                    @foreach($ingredients as $ingredient => $value)
                        <option value="{{$ingredient}}">{{$value}}</option>
                    @endforeach
                    <div class="card">
                        <div class="card-text"></div>
                    </div>
                </select>
                <ul id="lista1" class="list-group">

                </ul>
            </div>
            <div class="col-md-6">
                <label for="ingredient2">Alegeti ingredientul:</label>
                <select id="ingredient2" name="ingredient2" class="w-50 form-control">
                    @foreach($ingredients as $ingredient => $value)
                        <option value="{{$ingredient}}">{{$value}}</option>
                    @endforeach
                </select>
                <ul id="lista2" class="list-group">

                </ul>
            </div>
        </div>
    </div>

    <p id="ingredient"></p>

    <script src="/compara.js"></script>
</x-layout>
