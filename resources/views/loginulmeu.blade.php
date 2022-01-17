<x-layoutform>
    <div class="text-center">
        <form class="form-signin">
            <h1 class="mb-3">Bine ati venit!</h1>
            <label for="inputmail" class="sr-only">Introduceti adresa de mail</label>
            <input id="inputmail" type="email" class="form-control" placeholder="Adresa de mail" required="" autofocus="">
            <label for="inputparola" class="sr-only">Introduceti parola</label>
            <input id="inputparola" type="password" class="form-control" placeholder="Parola" required="">
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me">Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
</x-layoutform>
