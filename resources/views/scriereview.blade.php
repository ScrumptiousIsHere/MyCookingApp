<x-layout>
    <title>Review {!! $reteta->titlu !!}</title>
    <div class="container" style="min-width: 300px; max-width: 300px">
        <div class="text-center">
            <form class="form-signin" action="submitreview/{{$reteta->id}}" method="post">
                @csrf
                <h1 class="mb-3">Adauga o evaluare pentru reteta "{!!$reteta->titlu!!}"</h1>
                <label for="inputnota" class="sr-only">Introduceti nota</label>
                <input id="inputnota" name="nota" type="text" class="form-control mb-3" placeholder="Nota" required="">

                <label for="inputcontinut" class="sr-only">Introduceti continutul</label>
                <textarea id="inputcontinu" name="continut" type="text" class="form-control mb-3" placeholder="Spuneti-va parerea aici..."
                       required=""></textarea>


                <label for="inputuser" class="sr-only">User_id</label>
                <input type="hidden" id="inputuser" name="user"  value="<?php echo Auth::user()->id ?>">
                <input type="hidden" id="inputreteta" name="reteta"  value="{{$reteta->id}}">
                <button class="btn btn-lg btn-primary btn-block mb-3" type="submitreview/{{$reteta->id}}">Adauga evaluare</button>
            </form>
        </div>
    </div>
</x-layout>
