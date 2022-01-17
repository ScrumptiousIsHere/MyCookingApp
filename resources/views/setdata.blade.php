<x-layout>
    <title>Caracteristici fizice</title>
    <div class="container bg-dark min-vh-100 text-center">

                <form method="post" action="submitdata">
                    @csrf
                    <h1 class="text-white mb-5">Introduceti caracteristicile fizice</h1>
                    <br><br>


                    <label class="text-white mb-3" for="customRange2" class="form-label">Selectati gradul de activitate</label><br>

                        <ol class="text-white mb-5">
                            <li>Sedentar<br></li>
                            <li>Putin activ(1-3 zile/sapt)</li>
                            <li>Moderat activ(3-5 zile/sapt)</li>
                            <li>Foarte activ(6-7 zile/sapt)</li>
                            <li>Extra activ(foarte activ si job solicitant fizic)</li>
                        </ol>
                    <label class="text-white mb-3">Sedentar --- Putin activ --- Moderat activ --- Foarte activ --- Extra activ</label><br>

                    <input type="range" name="grad_activ" class="form-range mb-3 w-50" min="1" max="5" id="customRange2" required="">


                    <br>
                    <label class="text-white">Data nasterii:</label><br>
                    <label for="inputzi" class="text-white">Ziua:</label>
                    <input id="inputzi" class="bg-secondary mb-3" type="number" name="zi" size="2" value="<?php echo date("d")?>" required="">

                    <label for="inputluna" class="text-white">Luna:</label>
                    <input id="inputluna" class="bg-secondary mb-3" type="number" name="luna" size="2" value="<?php echo date("m")?>" required="">

                    <label for="inputan" class="text-white">Anul:</label>
                    <input id="inputan" class="bg-secondary mb-3" type="number" name="an" size="4" value="<?php echo date("20"."y")?>" required="">


                    <br>
                    <label class="text-white" for="inputgreutate" class="form-label">Greutate(kg)</label><br>
                    <input class="bg-secondary mb-3" type="number" name="greutate" id="inputgreutate" required="">

                    <br>
                    <label class="text-white" for="inputinaltime" class="form-label">Inaltime(cm)</label><br>
                    <input class="bg-secondary mb-5" type="number" name="inaltime" id="inputinaltime" required="">
                    <br>


                    <label class="text-white">Gen:</label><br>
                    <input type="radio" id="masculin" name="sex" value="M" >
                    <label class="text-white" for="html">Masculin</label><br>
                    <input type="radio" id="feminin" name="sex" value="F">
                    <label class="text-white mb-5" for="css">Feminin</label><br>

                    <input type="hidden" id="inputuser" name="user"  value="{{Auth::user()->id}}">

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button class="btn btn-lg btn-primary btn-block mb-3" type="submitdata">Memoreaza datele</button>
                        </div>
                        <div class="col-md-4"></div>
                    </div>


                </form>

    </div>


</x-layout>
