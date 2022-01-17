<x-layout>
    <title>Adauga reteta</title>
<div class="container" style="min-width: 300px; max-width:500px;">
    <div id="div" class="text-center bg-secondary p-4">
        <form enctype="multipart/form-data" id="test" class="form-signin" action="submitreteta" method="post">
            @csrf
            <h1 class="mb-3">Adauga o reteta</h1>
            <label for="inputtitlu" class="sr-only">Introduceti titlul</label>
            <input id="inputtitlu" name="titlu" type="text" class="form-control mb-3" placeholder="Titlul" required="">


            <label>Introduceti o fotografie(Optional)</label>



            <input type="file" name="file">

            <label for="inputtip" class="sr-only">Introduceti tipul</label>
            <select name="inputtip" class="form-control">

                @foreach(\App\Models\categorieReteta::all()->pluck('tip') as $categorie => $value)
                    <option value="{!!$categorie+1!!}">{{$value}}</option>
                @endforeach
            </select>

{{--            <input name="imagine" type="file" accept="image/*" required="">--}}

            <hr>

            <div id="ingrediente">
            <label for="ingredient1">Alegeti ingredientul:</label>
            <select name="ingredient1" class="form-control">
                @foreach($ingredients as $ingredient => $value)
                    <option value="{{$ingredient}}">{{$value}}</option>
                @endforeach
            </select>
            <label for="cantitatei1">Cantitatea ingredientului:</label>
            <input type="number" id="cantitatei1" name="cantitatei1" class="form-control " placeholder="Cantitate" required="">
                <br>
                <br>
            </div>


            <button class="btn btn-dark btn-outline-white mb-3" onclick="addIngredient()">Adauga inca un ingredient</button>

            <hr>
            <br><br>
            <label for="inputdescriere" class="sr-only">Introduceti descrierea</label>
            <textarea id="inputdescriere" name="descriere" rows="3" cols="40" class="form-control mb-3" placeholder="Descriere" required=""></textarea>



            <label for="durata">Durata de gatire(min.)</label>
            <input type="number" id="durata" name="durata" class="form-control mb-3" placeholder="Durata" required="">

            <br><hr>


            <h2>Pasii retetei</h2>
            <div id="pasi">
                <br>
                <label for="pas1">Pasul 1</label>
                <textarea name="pas1" rows="3" cols="40" class="form-control" placeholder="Pasul 1" required=""></textarea>
                <br>
            </div>

            <button class="btn btn-dark btn-outline-white mb-3" onclick="addPas()">Adauga pas</button>

            <br><br>

            <input type="hidden" id="nring" name="nring" value="1">
            <input type="hidden" id="nrpas" name="nrpas" value="1">

            <button class="btn btn-lg btn-primary btn-block mb-3" type="submitreteta">Adauga reteta</button>
        </form>

        <script src="formreteta.js"></script>


    </div>
</div>
</x-layout>
