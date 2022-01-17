<x-layout>
    <title>Editeaza ingredient</title>
    <div class="container" style="min-width: 300px; max-width: 300px">
        <div class="text-center">
            <h1 class="mb-3">Edit ingredient</h1>


            <form method="post" class="form-signin " action="submitupdateingredient/{{ $ingredient->id }}">
                @csrf

                <label>Introduceti numele</label>
                <label for="inputnume" class="sr-only">Introduceti numele</label>
                <input id="inputnume" name="nume" type="text" class="form-control mb-3" placeholder="Numele" required="" value="{{$ingredient->nume}}">

                <label>Introduceti tipul</label>
                <label for="inputtip" class="sr-only">Introduceti tipul</label>
                <input id="inputtip" name="tip" type="text" class="form-control mb-3" placeholder="Tipul"
                       required="" value="{{$ingredient->categorii_ingredient_id}}">

                <label>Introduceti cantitatea de proteine</label>
                <label for="inputproteine" class="sr-only">Introduceti cantitatea de proteine per 100g</label>
                <input id="inputproteine" name="proteine" type="number" class="form-control mb-3"
                       placeholder="Proteine" required="" value="{{\App\Models\continutIngredient::where('ingredient_id',$ingredient->id)->where('nutrient_id',1)->pluck('cantitate')[0]}}">

                <label>Introduceti cantitatea de carbohidrati</label>
                <label for="inputcarbohidrati" class="sr-only">Introduceti cantitatea de carbohidrati per 100g</label>
                <input id="inputcarbohidrati" name="carbo" type="number" class="form-control mb-3" placeholder="Carbohidrati"
                       required="" autofocus="" value="{{\App\Models\continutIngredient::where('ingredient_id',$ingredient->id)->where('nutrient_id',2)->pluck('cantitate')[0]}}">

                <label>Introduceti cantitatea de zaharuri</label>
                <label for="inputzaharuri" class="sr-only">Introduceti cantitatea de zaharuri per 100g</label>
                <input id="inputzaharuri" name="zahar" type="number" class="form-control mb-3" placeholder="Zaharuri"
                       required="" autofocus="" value="{{\App\Models\continutIngredient::where('ingredient_id',$ingredient->id)->where('nutrient_id',7)->pluck('cantitate')[0]}}">

                <label>Introduceti cantitatea de grasimi</label>
                <label for="inputgrasimi" class="sr-only">Introduceti cantitatea de grasimi per 100g</label>
                <input id="inputgrasimi" name="grasimi" type="number" class="form-control mb-3" placeholder="Grasimi"
                       required="" autofocus="" value="{{\App\Models\continutIngredient::where('ingredient_id',$ingredient->id)->where('nutrient_id',3)->pluck('cantitate')[0]}}">

                <label>Introduceti cantitatea de grasimi saturate</label>
                <label for="inputgrasimisat" class="sr-only">Introduceti cantitatea de grasimi saturate per 100g</label>
                <input id="inputgrasimisat" name="grasimisat" type="number" class="form-control mb-3" placeholder="Grasimi saturate"
                       required="" value="{{\App\Models\continutIngredient::where('ingredient_id',$ingredient->id)->where('nutrient_id',6)->pluck('cantitate')[0]}}">

                <label>Introduceti cantitatea de sare</label>
                <label for="inputsare" class="sr-only">Introduceti cantitatea de sare per 100g</label>
                <input id="inputsare" name="sare" type="number" class="form-control mb-3"
                       placeholder="Sare" required="" value="{{\App\Models\continutIngredient::where('ingredient_id',$ingredient->id)->where('nutrient_id',5)->pluck('cantitate')[0]}}">

                <label>Introduceti cantitatea de fibre</label>
                <label for="inputfibre" class="sr-only">Introduceti cantitatea de fibre per 100g</label>
                <input id="inputfibre" name="fibre" type="number" class="form-control mb-3" placeholder="Fibre" required value="{{\App\Models\continutIngredient::where('ingredient_id',$ingredient->id)->where('nutrient_id',8)->pluck('cantitate')[0]}}">

                <button class="btn btn-lg btn-primary btn-block mb-3" type="submitupdateingredient/{{ $ingredient->id }}">Modifica ingredient</button>
            </form>



        </div>
    </div>
</x-layout>
