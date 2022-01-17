<x-layout>
    <title>Adauga ingredient</title>
    <div class="container" style="min-width: 300px; max-width: 300px">
        <div class="text-center">
            <form class="form-signin " action="submitingredient" method="post">
                @csrf
                <h1 class="mb-3">Adauga un ingredient</h1>
                <label for="inputnume" class="sr-only">Introduceti numele</label>
                <input id="inputnume" name="nume" type="text" class="form-control mb-3" placeholder="Numele" required="">

                <div class="mb-5" id="ingrediente" >
                    <label for="ingredient1">Alegeti tipul:</label>
                    <select name="inputtip" class="form-control" required="">
                        <option >Bauturi</option>
                        <option >Branzeturi</option>
                        <option >Carne</option>
                        <option >Cereale</option>
                        <option >Condimente</option>
                        <option >Dulciuri</option>
                        <option >Gustari</option>
                        <option >Lactate</option>
                        <option >Legume/Fructe</option>
                        <option >Mezeluri</option>
                        <option >Paine</option>
                        <option >Peste</option>
                        <option >Ready-To-Eat</option>
                        <option >Sosuri</option>
                        <option >Seminte/Nuci</option>
                        <option >Semipreparate</option>
                        <option >Suplimente</option>
                        <option >Uleioase</option>
                        <option >Altele</option>

                    </select>
                </div>



                <div class="mb-5" id="UM" >
                    <label for="ingredient1">Alegeti unitatea de masura:</label>
                    <select name="inputum" class="form-control" required="">

                        <option >ml</option>
                        <option >g</option>

                    </select>
                </div>

                <label for="inputproteine" class="sr-only">Introduceti cantitatea de proteine per 100g</label>
                <input id="inputproteine" name="proteine" type="number" step="0.1" class="form-control mb-3"
                       placeholder="Proteine" required="">

                <label for="inputcarbohidrati" class="sr-only">Introduceti cantitatea de carbohidrati per 100g</label>
                <input id="inputcarbohidrati" name="carbo" type="number" step="0.1" class="form-control mb-3" placeholder="Carbohidrati"
                       required="" autofocus="">

                <label for="inputzaharuri" class="sr-only">Introduceti cantitatea de zaharuri per 100g</label>
                <input id="inputzaharuri" name="zahar" type="number" step="0.1" class="form-control mb-3" placeholder="Zaharuri"
                       required="" autofocus="">

                <label for="inputgrasimi" class="sr-only">Introduceti cantitatea de grasimi per 100g</label>
                <input id="inputgrasimi" name="grasimi" type="number" step="0.1" class="form-control mb-3" placeholder="Grasimi"
                       required="" autofocus="">

                <label for="inputgrasimisat" class="sr-only">Introduceti cantitatea de grasimi saturate per 100g</label>
                <input id="inputgrasimisat" name="grasimisat" type="number" step="0.1" class="form-control mb-3" placeholder="Grasimi saturate"
                       required="">

                <label for="inputsare" class="sr-only">Introduceti cantitatea de sare per 100g</label>
                <input id="inputsare" name="sare" type="number" step="0.1" class="form-control mb-3"
                       placeholder="Sare" required="">

                <label for="inputfibre" class="sr-only">Introduceti cantitatea de fibre per 100g</label>
                <input id="inputfibre" name="fibre" type="number" step="0.1" class="form-control mb-3" placeholder="Fibre" required>


                <label for="inputalcool" class="sr-only">Introduceti cantitatea de alcool per 100g</label>
                <input id="inputalcool" name="alcool" type="number" step="0.1" class="form-control mb-3" placeholder="Alcool" required>

                <button class="btn btn-lg btn-primary btn-block mb-3" type="submitingredient">Adauga ingredient</button>
            </form>



        </div>
    </div>
</x-layout>
