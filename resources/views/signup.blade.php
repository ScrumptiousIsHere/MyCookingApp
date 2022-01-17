<x-layoutform>
    <title>Signup</title>
    <div class="text-center">
        <form class="form-signin" action="submitsignup" method="post">
            @csrf
            <h1 class="mb-3">Bine ai venit!</h1>

            <label for="inputnume" class="sr-only">Introduceti numele</label>
            <input id="inputnume" name="nume" type="text" class="form-control mb-3" placeholder="Numele" required="">

            <label for="inputprenume" class="sr-only">Introduceti prenumele</label>
            <input id="inputprenume" name="prenume" type="text" class="form-control mb-3" placeholder="Prenumele"
                   required="">

            <label for="inputusername" class="sr-only">Introduceti numele de utilizator</label>
            <input id="inputusername" name="username" type="text" class="form-control mb-3"
                   placeholder="Numele de utilizator" required="">

            <label for="inputmail" class="sr-only">Introduceti adresa de mail</label>
            <input id="inputmail" name="mail" type="email" class="form-control mb-3" placeholder="Adresa de mail"
                   required="" autofocus="">

            <label for="inputparola" class="sr-only">Introduceti parola</label>
            <input id="inputparola" name="parola" type="password" class="form-control mb-3" placeholder="Parola"
                   required="">

            <label for="inputconfirm" class="sr-only">Confirmati parola</label>
            <input id="inputconfirm" name="confirmaparola" type="password" class="form-control mb-3"
                   placeholder="Cofirmare parola" required="">

            <button class="btn btn-lg btn-primary btn-block" type="submitsignup">Inregistreaza-te</button>
        </form>
    </div>
</x-layoutform>

